<?php

namespace HugoSoltys\FitzBundle\Model;

class AvailableBundles
{
    const BUNDLES = [
        'DoctrineBundle' => [
            'composer' => 'doctrine/doctrine-bundle',
            'documentation' => 'https://symfony.com/doc/current/bundles/DoctrineBundle/index.html',
            'service' => 'fitz.doctrine_installer',
        ],
        'FOSUserBundle' => [
            'composer' => 'friendsofsymfony/user-bundle',
            'documentation' => 'https://symfony.com/doc/master/bundles/FOSUserBundle/index.html',
            'service' => 'fitz.fos_user_installer',
        ],
        'EasyAdminBundle' => [
            'composer' => 'admin',
            'documentation' => 'https://symfony.com/doc/master/bundles/EasyAdminBundle/index.html',
            'service' => 'fitz.easy_admin_installer',
        ],
    ];
}