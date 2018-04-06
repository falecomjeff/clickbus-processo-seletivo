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
     * Initial page, form search and result of search
     *
     * @Route("/", name="default")
     */
    public function index(Request $request)
    {
        // Create search form.
        $form = $this->createForm(DefaultType::class, null, array(
            'action' => $this->generateUrl('default'),
            'method' => 'POST',
        ));

        // Number of results per page.
        $resultsPerPage = 5;
        $getPagination  = null;
        $results        = null;


        $form->handleRequest($request);

        // If send form, does a validate and get search parameter.
        if ($form->isSubmitted() && $form->isValid()) {
            // Paramters of search.
            $searchParameters = $form->getData();

            // Execute the search.
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
            // Paramters of search.
            $searchParameters = $request->query->all();

            // Execute the search.
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

    /**
     * Execute a search in Github
     *
     * @param string     $q                 the search parameter.
     * @param integer    $resultsPerPage    the number of results per page.
     * @param integer    $page              the number of current page.
     * @param string     $sort              the method of ordination.
     * @param string     $order             the order of ordination.
     *
     * @return array returns the result of search.
     */
    public function gitHubSearch($q, $resultsPerPage, $page, $sort = null, $order = null)
    {
        $githubClient  = new Client();
        $paginator     = new ResultPager($githubClient);
        $search        = array();
        $getPagination = array();

        $searchApi  = $githubClient->api('search')->setPerPage($resultsPerPage)->setPage($page);
        $parameters = array($q, $sort, $order);
        $results    = $paginator->fetch($searchApi, 'repositories', $parameters);

        // Prepare variable for use paginate in twig.
        if ($paginator->getPagination()) {
            foreach ($paginator->getPagination() as $key => $pagination) {
                $getPagination[$key] = str_replace(
                    'https://api.github.com/search/repositories',
                    '',
                    $pagination
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
