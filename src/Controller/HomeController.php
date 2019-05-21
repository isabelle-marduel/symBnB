<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller {

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