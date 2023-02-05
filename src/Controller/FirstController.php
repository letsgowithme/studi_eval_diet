<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    #[Route('/first', name: 'app_first')]
    public function index(): Response
    {

        return $this->render('first/index.html.twig', [
            'name' => 'Gor',
            'firstname' => 'Ira'
        ]);
    }
    #[Route('/hello/{name}/{firstname}', name: 'app_sayHello')]
    public function sayHello(Request $request, $name, $firstname): Response
    {
        dd($request);
        return $this->render('first/hello.html.twig', ['nom' => $name,
        'prenom' => $firstname]
        );
    }
}
