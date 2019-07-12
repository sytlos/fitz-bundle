<?php

namespace HugoSoltys\FitzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Controller extends AbstractController
{
    public function index()
    {
        return $this->render('index.html.twig');
    }
}