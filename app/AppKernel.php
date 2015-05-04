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
            // FOS USER 
            new FOS\UserBundle\FOSUserBundle(),
            // Sonata User     
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            // Sonata Timeline
            new Spy\TimelineBundle\SpyTimelineBundle(),
            new Sonata\TimelineBundle\SonataTimelineBundle(),
            // Sonata Intl
            new Sonata\IntlBundle\SonataIntlBundle(),
            // JMS EXTRAS SEGURIDAD
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SerializerBundle\JMSSerializerBundle($this),
            // Sonata Classification
            // new Sonata\ClassificationBundle\SonataClassificationBundle(),
            // BUNDLES PROPIOS
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new Application\Sonata\TimelineBundle\ApplicationSonataTimelineBundle(), // easy extends integration
            // new Application\Sonata\ClassificationBundle\ApplicationSonataClassificationBundle()
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
