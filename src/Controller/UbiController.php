<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UbiController extends AbstractController
{
    /**
     * @Route("/ubi", name="ubi")
     */
    public function index()
    {
        return $this->render('ubi/index.html.twig', [
            'controller_name' => 'UbiController',
        ]);
    }
}

