<?php

namespace HugoSoltys\FitzBundle\Installer;

interface InstallerInterface
{
    public function install();

    public function isInstalled();
}