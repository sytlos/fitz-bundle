<?php

namespace HugoSoltys\FitzBundle\Model;

use HugoSoltys\FitzBundle\Installer\DefaultInstaller;
use HugoSoltys\FitzBundle\Installer\FOSUserInstaller;

class AvailableBundles
{
    const QUEUE_FILE = 'bundle_queue.log';

    const BUNDLES = [
        'DoctrineBundle' => [
            'composer' => ['doctrine/doctrine-bundle', 'doctrine/orm'],
            'documentation' => 'https://symfony.com/doc/current/bundles/DoctrineBundle/index.html',
            'service' => 'fitz.default_installer',
            'installer_class' => DefaultInstaller::class,
            'composer_name' => 'doctrine/doctrine-bundle',
        ],
        'FOSUserBundle' => [
            'composer' => ['friendsofsymfony/user-bundle', 'swiftmailer-bundle', 'symfony/translation'],
            'documentation' => 'https://symfony.com/doc/master/bundles/FOSUserBundle/index.html',
            'service' => 'fitz.fos_user_installer',
            'installer_class' => FOSUserInstaller::class,
            'composer_name' => 'friendsofsymfony/user-bundle',
        ],
        'EasyAdminBundle' => [
            'composer' => ['admin'],
            'documentation' => 'https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html',
            'service' => 'fitz.default_installer',
            'installer_class' => DefaultInstaller::class,
            'composer_name' => 'doctrine/doctrine-bundle',
        ],
        'ApiPlatformBundle' => [
            'composer' => ['api-platform/api-pack'],
            'documentation' => 'https://api-platform.com/docs/',
            'service' => 'fitz.default_installer',
            'installer_class' => DefaultInstaller::class,
            'composer_name' => 'api-platform/api-pack',
        ],
        'FOSJsRoutingBundle' => [
            'composer' => ['friendsofsymfony/jsrouting-bundle'],
            'documentation' => 'https://symfony.com/doc/master/bundles/FOSJsRoutingBundle/index.html',
            'service' => 'fitz.default_installer',
            'installer_class' => DefaultInstaller::class,
            'composer_name' => 'friendsofsymfony/jsrouting-bundle',
        ],
        'WhiteOctoberPagerfantaBundle' => [
            'composer' => ['white-october/pagerfanta-bundle'],
            'documentation' => 'https://github.com/whiteoctober/WhiteOctoberPagerfantaBundle',
            'service' => 'fitz.default_installer',
            'installer_class' => DefaultInstaller::class,
            'composer_name' => 'white-october/pagerfanta-bundle',
        ],
    ];
}