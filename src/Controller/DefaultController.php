<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Github\Client;

use App\Form\DefaultType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(DefaultType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $githubClient     = new Client();
            $searchParameters = $form->getData();

            switch ($searchParameters["type"]) {
                case 'repositorios':
                    $result = $githubClient->api('search')->repositories($searchParameters['name']);
                    break;

                case 'codigos':
                    $result = $githubClient->api('search')->code($searchParameters['name']);
                    break;

                case 'issues':
                    $result = $githubClient->api('search')->issues($searchParameters['name']);
                    break;

                case 'usuarios':
                    $result = $githubClient->api('search')->users($searchParameters['name']);
                    break;

                case 'commits':
                    $result = $githubClient->api('search')->commits($searchParameters['name']);
                    break;
            }

            echo "<pre>";
            var_dump($result);
            die();
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'form'            => $form->createView(),
        ]);
    }
}
