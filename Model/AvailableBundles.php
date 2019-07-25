<?php

namespace HugoSoltys\FitzBundle\Model;

use HugoSoltys\FitzBundle\Installer\FOSUserInstaller;

/**
 * @author Hugo Soltys <hugo.soltys@gmail.com>
 */
class AvailableBundles
{
    const QUEUE_FILE = 'bundle_queue.log';

    const BUNDLES = [
        'WebProfilerBundle' => [
            'composer' => ['symfony/web-profiler-bundle'],
            'documentation' => 'https://symfony.com/doc/current/reference/configuration/web_profiler.html',
            'composer_name' => 'symfony/web-profiler-bundle',
        ],
        'TwigBundle' => [
            'composer' => ['symfony/twig-bundle'],
            'documentation' => 'https://symfony.com/doc/current/reference/configuration/twig.html',
            'composer_name' => 'symfony/twig-bundle',
        ],
        'SwiftmailerBundle' => [
            'composer' => ['symfony/swiftmailer-bundle'],
            'documentation' => 'https://symfony.com/doc/current/email.html',
            'composer_name' => 'symfony/swiftmailer-bundle',
        ],
        'SecurityBundle' => [
            'composer' => ['symfony/security-bundle'],
            'documentation' => 'https://symfony.com/doc/current/reference/configuration/security.html',
            'composer_name' => 'symfony/security-bundle',
        ],
        'MonologBundle' => [
            'composer' => ['symfony/monolog-bundle'],
            'documentation' => 'https://symfony.com/doc/current/logging.html',
            'composer_name' => 'symfony/monolog-bundle',
        ],
        'MakerBundle' => [
            'composer' => ['symfony/maker-bundle'],
            'documentation' => 'https://symfony.com/doc/current/bundles/SymfonyMakerBundle/index.html',
            'composer_name' => 'symfony/maker-bundle',
        ],
        'DoctrineBundle' => [
            'composer' => ['doctrine/doctrine-bundle', 'doctrine/orm'],
            'documentation' => 'https://symfony.com/doc/current/bundles/DoctrineBundle/index.html',
            'composer_name' => 'doctrine/doctrine-bundle',
        ],
        'FOSUserBundle' => [
            'composer' => ['friendsofsymfony/user-bundle', 'swiftmailer-bundle', 'symfony/translation', 'doctrine/doctrine-bundle', 'doctrine/orm'],
            'documentation' => 'https://symfony.com/doc/master/bundles/FOSUserBundle/index.html',
            'service' => 'fitz.fos_user_installer',
            'installer_class' => FOSUserInstaller::class,
            'composer_name' => 'friendsofsymfony/user-bundle',
        ],
        'EasyAdminBundle' => [
            'composer' => ['admin'],
            'documentation' => 'https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html',
            'composer_name' => 'easycorp/easyadmin-bundle',
        ],
        'ApiPlatformBundle' => [
            'composer' => ['api-platform/api-pack'],
            'documentation' => 'https://api-platform.com/docs/',
            'composer_name' => 'api-platform/api-pack',
        ],
        'FOSJsRoutingBundle' => [
            'composer' => ['friendsofsymfony/jsrouting-bundle'],
            'documentation' => 'https://symfony.com/doc/master/bundles/FOSJsRoutingBundle/index.html',
            'composer_name' => 'friendsofsymfony/jsrouting-bundle',
        ],
        'WhiteOctoberPagerfantaBundle' => [
            'composer' => ['white-october/pagerfanta-bundle'],
            'documentation' => 'https://github.com/whiteoctober/WhiteOctoberPagerfantaBundle',
            'composer_name' => 'white-october/pagerfanta-bundle',
        ],
        'KnpMenuBundle' => [
            'composer' => ['knplabs/knp-menu-bundle'],
            'documentation' => 'https://symfony.com/doc/master/bundles/KnpMenuBundle/index.html',
            'composer_name' => 'knplabs/knp-menu-bundle',
        ],
        'StofDoctrineExtensionsBundle' => [
            'composer' => ['stof/doctrine-extensions-bundle'],
            'documentation' => 'https://symfony.com/doc/master/bundles/StofDoctrineExtensionsBundle/index.html',
            'composer_name' => 'stof/doctrine-extensions-bundle',
        ],
        'NelmioCorsBundle' => [
            'composer' => ['nelmio/cors-bundle'],
            'documentation' => 'https://github.com/nelmio/NelmioCorsBundle',
            'composer_name' => 'nelmio/cors-bundle',
        ],
        'DoctrineMigrationsBundle' => [
            'composer' => ['doctrine/doctrine-migrations-bundle'],
            'documentation' => 'https://symfony.com/doc/current/bundles/DoctrineMigrationsBundle/index.html',
            'composer_name' => 'doctrine/doctrine-migrations-bundle',
        ],
        'NelmioApiDocBundle' => [
            'composer' => ['nelmio/api-doc-bundle'],
            'documentation' => 'https://symfony.com/doc/current/bundles/NelmioApiDocBundle/index.html',
            'composer_name' => 'nelmio/api-doc-bundle',
        ],
        'HautelookAliceBundle' => [
            'composer' => ['hautelook/alice-bundle'],
            'documentation' => 'https://github.com/hautelook/AliceBundle',
            'composer_name' => 'hautelook/alice-bundle',
        ],
        'LexikJWTAuthenticationBundle' => [
            'composer' => ['lexik/jwt-authentication-bundle'],
            'documentation' => 'https://github.com/lexik/LexikJWTAuthenticationBundle',
            'composer_name' => 'lexik/jwt-authentication-bundle',
        ],
        'BazingaJsTranslationBundle' => [
            'composer' => ['willdurand/js-translation-bundle'],
            'documentation' => 'https://github.com/willdurand/BazingaJsTranslationBundle/blob/master/Resources/doc/index.md',
            'composer_name' => 'willdurand/js-translation-bundle',
        ],
    ];
}