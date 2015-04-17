<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel {

    public function registerBundles() {
        $bundles = array(
            
            //BUNDLES SYMFONY POR DEFECTO
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            
            // SONATA
            
            // ORM Doctrine Admin
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            
            // KNP MENU
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            
            // Sonata Core y Block
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            
            // Sonata Admin y EasyExtends
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Sonata\EasyExtendsBundle\SonataEasyExtendsBundle(),
            
            // Sonata Page
            // new Sonata\PageBundle\SonataPageBundle(),
            
            // FOS USER 
            new FOS\UserBundle\FOSUserBundle(),
            
            // Sonata User
            // You have 2 options to initialize the SonataUserBundle in your AppKernel,
            // you can select which bundle SonataUserBundle extends
            // Most of the cases, you'll want to extend FOSUserBundle though ;)
            // extend the ``FOSUserBundle``     
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            
            // JMS EXTRAS SEGURIDAD
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            
            // BUNDLES PROPIOS
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),           
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader) {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }

}
