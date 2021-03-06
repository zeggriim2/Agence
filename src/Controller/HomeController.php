<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findLastest();
        $i = 2;

        return $this->render('home/index.html.twig', [
            'properties' => $properties
        ]);
    }
}
