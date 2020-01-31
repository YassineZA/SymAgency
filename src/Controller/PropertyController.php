<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(PaginatorInterface $paginator, Request $request)
    {   
        $search = new PropertySearch();

        $form = $this->createForm(PropertySearchType::class, $search);

        $form->handleRequest($request);
           
        $properties = $paginator->paginate(
            $this->repository->findAllVisibleQuery($search),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties',
            'properties' => $properties,
            'form' => $form->createView()
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
