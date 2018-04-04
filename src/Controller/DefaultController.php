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
        $form   = $this->createForm(DefaultType::class);
        $results = null;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $githubClient     = new Client();
            $searchParameters = $form->getData();

            $results = $githubClient->api('search')->repositories($searchParameters['name']);
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'form'            => $form->createView(),
            'results'         => $results,
        ]);
    }
}
