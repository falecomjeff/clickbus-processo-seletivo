<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultControllerPhpController extends Controller
{
    /**
     * @Route("/", name="default_controller_php")
     */
    public function index()
    {
        return $this->render('default_controller_php/index.html.twig', [
            'controller_name' => 'DefaultControllerPhpController',
        ]);
    }
}
