<?php

namespace HugoSoltys\FitzBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class Controller extends AbstractController
{
    public function index(Request $request)
    {
        $bundles = $request->request->all();

        foreach ($bundles as $bundle) {

        }

        return $this->render('index.html.twig');
    }
}