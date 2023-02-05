<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TodoController extends AbstractController
{
    #[Route('/todo', name: 'todo')]
    public function index(Request $request): Response
    {
        $session = $request->getSession();
        //Afficher notre tableau todo
        //sinon je l'initialise puis j'affiche
        if (!$session->has('todos')) {
            $todos = [
                'nom' => 'Paul',
                'prenom' => 'Verne',
                'allergie' => 'gluten',
                'regime' => 'san gluten'
            ];
            $session->set('todos', $todos);
            $this->addFlash('info', "La liste vient d'être initialisée");
        }
        // si j ai mon tab todo dans ma session je ne fais que l'afficher
        //
        return $this->render('todo/index.html.twig');
    }
    #[Route('/todo/add/{name}/{content}', name: 'todo.add')]
    public function addTodo(Request $request, $name, $content) {
        $session = $request->getSession();
// verifier si j ai mon tableau de todo dans la session
        if ($session->has('todos')){
            // si oui
            //verifier si on a deja un todo avec le meme name
            $todos = $session->get('todos');
            if (isset($todos[$name])) {
                // si oui aff erreur
                $this->addFlash('error', "Le todo d'id $name existe déjà dans la liste");

            } else {
                // si non on l'ajoute et message de succes
                $todos[$name] = $content;
                $this->addFlash('success', "Le todo d'id $name a été ajouté avec succes");
                $session->set('todos', $todos);

            }


        } else {
            //si non
            //afficher une erreur et on va rediriger vers le controlleur initial index
            $this->addFlash('error', "La liste des todo n'est pas encore initialisée");
        }
        return $this->redirectToRoute('todo');


    }


}
