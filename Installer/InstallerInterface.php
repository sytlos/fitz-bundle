<?php

namespace HugoSoltys\FitzBundle\Installer;

interface InstallerInterface
{
    public function install();

    public function isInstalled();

    public function configure();

    public function cacheClear();
}