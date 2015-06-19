<?php

namespace Application\Sonata\AdminBundle\Search;

use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Sonata\AdminBundle\Admin\Pool;
use Sonata\BlockBundle\Block\BaseBlockService;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class AdminSearchBlockService
 *
 * @package Sonata\AdminBundle\Block
 * @author Thomas Rabaix <thomas.rabaix@sonata-project.org>
 */
class AdminSearchBlockService extends BaseBlockService {

    protected $pool;
    protected $searchHandler;

    /**
     * @param string $name
     * @param EngineInterface $templating
     * @param Pool $pool
     * @param SearchHandler $searchHandler
     */
    public function __construct($name, EngineInterface $templating, Pool $pool, SearchHandler $searchHandler) {
        parent::__construct($name, $templating);
        $this->pool = $pool;
        $this->searchHandler = $searchHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null) {
        try {
            $admin = $this->pool->getAdminByAdminCode($blockContext->getSetting('admin_code'));
        } catch (ServiceNotFoundException $e) {
            throw new \RuntimeException('Unable to find the Admin instance', $e->getCode(), $e);
        }
        if (!$admin instanceof AdminInterface) {
            throw new \RuntimeException('The requested service is not an Admin instance');
        }
        if (!$admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }
        $pager = $this->searchHandler->search(
                $admin, $blockContext->getSetting('query'), $blockContext->getSetting('page'), $blockContext->getSetting('per_page')
        );
        return $this->renderPrivateResponse($admin->getTemplate('search_result_block'), array(
                    'block' => $blockContext->getBlock(),
                    'settings' => $blockContext->getSettings(),
                    'admin_pool' => $this->pool,
                    'pager' => $pager,
                    'admin' => $admin,
                        ), $response);
    }

    /**
     * {@inheritdoc}
     */
    public function getName() {
        return 'Admin Search Result';
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultSettings(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'admin_code' => false,
            'query' => '',
            'page' => 0,
            'per_page' => 10,
        ));
    }

}
