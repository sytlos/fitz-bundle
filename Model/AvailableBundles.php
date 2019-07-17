<?php

namespace HugoSoltys\FitzBundle\Model;

use HugoSoltys\FitzBundle\Installer\DoctrineInstaller;
use HugoSoltys\FitzBundle\Installer\FOSUserInstaller;

class AvailableBundles
{
    const QUEUE_FILE = 'bundle_queue.log';

    const BUNDLES = [
        'DoctrineBundle' => [
            'composer' => ['doctrine/doctrine-bundle', 'doctrine/orm'],
            'documentation' => 'https://symfony.com/doc/current/bundles/DoctrineBundle/index.html',
            'service' => 'fitz.doctrine_installer',
            'installer_class' => DoctrineInstaller::class,
        ],
        'FOSUserBundle' => [
            'composer' => ['friendsofsymfony/user-bundle', 'swiftmailer-bundle', 'symfony/translation'],
            'documentation' => 'https://symfony.com/doc/master/bundles/FOSUserBundle/index.html',
            'service' => 'fitz.fos_user_installer',
            'installer_class' => FOSUserInstaller::class,
        ],
        'EasyAdminBundle' => [
            'composer' => ['admin'],
            'documentation' => 'https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html',
            'service' => 'fitz.easy_admin_installer',
//            'installer_class' => EasyAd::class,
        ],
    ];

    public static function installingBundles()
    {
        if (!\file_exists(self::QUEUE_FILE)) {
            return [];
        }

        return \explode(';', \file_get_contents(self::QUEUE_FILE));
    }
}