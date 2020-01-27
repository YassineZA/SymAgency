<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * @Route("/biens", name="property_index")
     */
    public function index()
    {
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties'
        ]);
    }

    /**
     * @Route("/biens/{id}", name="preperty_show")
     */
    public function show(Property $property) {
        return $this->render('property/show.html.twig', [
            'property' => $property
        ]);
    }
}
