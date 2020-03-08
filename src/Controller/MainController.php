<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

//        die("hello");
        return $this->render('@FOSUser/Security/login.html.twig');
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/welcome/{name?}", name="custom")
     * @param Request $request
     * @return Response
     */
    public function custom(Request $request)
    {
        $data = $request->get('name');
        return $this->render('main/test.html.twig', [
            'data' => $data,
        ]);
    }
}