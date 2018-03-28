<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Github\Client;

use App\Form\DefaultType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index()
    {
        $form = $this->createForm(DefaultType::class);

        $githubClient = new Client();
        $repositories = $githubClient->api('search')->repositories('ornicar');

        // echo "<pre>";
        // var_dump($repositories);
        // die();

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'form'            => $form->createView(),
        ]);
    }
}
