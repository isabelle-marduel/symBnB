<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

    /**
     * Montre la page qui dit bonjour
     * @Route("/hello/{prenom}/age/{age}", name="hello")
     * @Route("/salut", name="hello_base")
     * @Route("/hello/{prenom}", name="hello_prenom")
     *
     * @return void
     */
    public function hello($prenom = "anonyme", $age = 0) {
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom,
                'age' => $age
            ]
        );
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home(){
        $prenoms = ['Lior' => 31, 'Camille' => 12, 'Isabelle' => 55];

        return $this->render(
            'home.html.twig',
            [
                'title' => "bonjour à tous",
                'age' => 10,
                'tableau' => $prenoms
            ]
        );
    }

}

?>