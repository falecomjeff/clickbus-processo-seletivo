<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Github\Client;
use Github\ResultPager;

use App\Form\DefaultType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function index(Request $request)
    {
        // Create form for search.
        $form = $this->createForm(DefaultType::class, null, array(
            'method' => 'POST',
        ));

        $resultsPerPage = 5;

        $form->handleRequest($request);

        // If send form, do validate and get search parameter.
        if ($form->isSubmitted() && $form->isValid()) {
            $searchParameters = $form->getData();

            $search = $this->gitHubSearch(
                $searchParameters['q'],
                $resultsPerPage,
                1,
                'created',
                'asc'
            );

            $results       = $search['results'];
            $getPagination = $search['getPagination'];

        } elseif ($request->query->get('q')) {
            $searchParameters = $request->query->all();

            $search = $this->gitHubSearch(
                $searchParameters['q'],
                $resultsPerPage,
                $searchParameters['page'],
                $searchParameters['sort'],
                $searchParameters['order']
            );

            $results       = $search['results'];
            $getPagination = $search['getPagination'];
        }

        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'form'            => $form->createView(),
            'results'         => $results,
            'getPagination'   => $getPagination,
        ]);
    }

    public function gitHubSearch($q, $resultsPerPage, $page, $sort = null, $order = null)
    {
        $githubClient  = new Client();
        $paginator     = new ResultPager($githubClient);
        $search        = array();
        $getPagination = null;

        $searchApi  = $githubClient->api('search')->setPerPage($resultsPerPage)->setPage($page);
        $parameters = array($q, $sort, $order);
        $results    = $paginator->fetch($searchApi, 'repositories', $parameters);

        // Prepare variable for use paginate in twig.
        if ($paginator->getPagination()) {
            foreach ($paginator->getPagination() as $key => $pagination) {
                $getPagination[$key] = str_replace(
                    'https://api.github.com/search/repositories',
                    '',
                    $getPagination
                );
            }
        }

        // Set actual page.
        $getPagination['actual'] = $searchApi->getPage();

        $search['results']       = $results;
        $search['getPagination'] = $getPagination;

        return $search;
    }
}
