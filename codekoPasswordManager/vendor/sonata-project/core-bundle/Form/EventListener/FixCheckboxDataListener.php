<?php

/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\CoreBundle\Form\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\DataTransformer\BooleanToStringTransformer;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Using BooleanToStringTransform in a checkbox form type
 * will set false value to '0' instead of null which will end up
 * returning true value when the form is bind
 *
 * Class FixCheckboxDataListener
 *
 * @author  Sylvain Rascar <rascar.sylvain@gmail.com>
 *
 * @package Sonata\CoreBundle\Form\EventListener
 */
class FixCheckboxDataListener implements EventSubscriberInterface
{
    /**
     * @param FormEvent $event
     */
    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $transformers = $event->getForm()->getConfig()->getViewTransformers();

        if (count($transformers) === 1 && $transformers[0] instanceof BooleanToStringTransformer && $data === '0') {
            $event->setData(null);
        }
    }

    /**
     * Alias of {@link preSubmit()}.
     *
     * @deprecated Deprecated since version 2.3, to be removed in 3.0. Use
     *             {@link preSubmit()} instead.
     *
     * @param FormEvent $event
     */
    public function preBind(FormEvent $event)
    {
        $this->preSubmit($event);
    }

    public static function getSubscribedEvents()
    {
        return array(FormEvents::PRE_SUBMIT => 'preSubmit');
    }
}
