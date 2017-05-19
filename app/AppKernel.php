<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            //Sonata
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Sonata\UserBundle\SonataUserBundle('FOSUserBundle'),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),   
            new Sonata\AdminBundle\SonataAdminBundle(),
            new Application\Sonata\UserBundle\ApplicationSonataUserBundle(),
            new JS\FosAuthBundle\FosAuthBundle(),
            new JS\SonataExtendsBundle\JSSonataExtendsBundle(),

            //bundles utiles
            // new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(), // Bundle de paginacion  KnpPaginator(Activar en vendor.yml) (https://github.com/KnpLabs/KnpPaginatorBundle)
             new Ivory\CKEditorBundle\IvoryCKEditorBundle(), // Bundle de what's you see and get (Activar en App/autoload.php y vendor.yml) ()
             new FM\ElfinderBundle\FMElfinderBundle(), //Bundle complemeto del de arriba para las imagenes (activar en vendor.yml, routing.yml y tambien si gusta security.yml) (https://github.com/helios-ag/FMElfinderBundle)
            // new Hpatoio\DeployBundle\DeployBundle(), //Bundle de deploy (activar descomentar en vendor.yml) (https://github.com/hpatoio/DeployBundle)
            // new Prezent\Doctrine\TranslatableBundle\PrezentDoctrineTranslatableBundle(), //Bundle de traduciion (vendor.yml) (https://github.com/Prezent/doctrine-translatable/blob/master/doc/index.md)
            // new A2lix\TranslationFormBundle\A2lixTranslationFormBundle(), //Bundle para fomrmulario traducciones (Nada que hacer) (http://a2lix.fr/bundles/translation-form/)
            // new Liip\ImagineBundle\LiipImagineBundle(), // Bundle para crear thumbsnails (habilitarlo en routing.yml y vendor.yml) (https://github.com/liip/LiipImagineBundle)
            new FOS\OAuthServerBundle\FOSOAuthServerBundle(), // Bundle Authetificacion de api //   // http://stackoverflow.com/questions/21390844/fosoauthserverbundle-with-fosuserbundle-how-to-make-it-works // https://github.com/FriendsOfSymfony/FOSOAuthServerBundle/blob/master/Resources/doc/index.md
            new FOS\RestBundle\FOSRestBundle(),
            new JMS\SerializerBundle\JMSSerializerBundle(),
            
            new JS\AppBundle\JSAppBundle()

        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
    public function init()
    {
        date_default_timezone_set('America/Costa_Rica');
        parent::init();
    }

    public function getCacheDir()
    {
        if (in_array($this->environment, array('dev', 'test'))) {
            return '/var/trash/cache/' .  $this->environment;
        }

        return parent::getCacheDir();
    }

    public function getLogDir()
    {
        if (in_array($this->environment, array('dev', 'test'))) {
            return '/dev/shm/logs';
        }

        return parent::getLogDir();
    }
}