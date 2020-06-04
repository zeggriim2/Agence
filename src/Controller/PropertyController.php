<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    private $repository;
    private $entityManager;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/biens", name="property.index")
     * @param PropertyRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $properties = $this->repository->findAllVisible();

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties
        ]);
    }


    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @param Property $property
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function show(Property $property, $slug) {

        if ($property->getSlug() !== $slug){
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ],301);
        }
        return $this->render("property/show.html.twig", [
            'property' => $property,
            'current_menu' => 'properties'
        ]);
    }
}
