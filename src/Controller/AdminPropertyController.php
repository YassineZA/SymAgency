<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminPropertyController extends AbstractController
{  
    /**
     * @Route("/admin", name="admin_property_index")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Property::class);
        
        $properties = $repository->findAll();

        return $this->render('admin_property/index.html.twig', [
            'properties' => $properties
        ]);
    }

    /**
     * @Route("/admin/property/create", name="admin_property_new")
     */
    public function new(Request $request) {
        $property = new Property();

        $form = $this->createForm(PropertyType::class, $property);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($property);
            
            $manager->flush();

            $this->addFlash('success', 'Bien ajouté avec succes');

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin_property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/admin/property/{id}", name="admin_property_edit", methods="GET|POST")
     */
    public function edit(Property $property, Request $request) {
        $form = $this->createForm(PropertyType::class, $property);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->flush();

            $this->addFlash('success', 'Bien modifié avec succes');

            return $this->redirectToRoute('admin_property_index');
        }

        return $this->render('admin_property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/{id}", name="admin_property_delete", methods="DELETE")
     */
    public function delete(Property $property) {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($property);

        $manager->flush();

        return $this->redirectToRoute('admin_property_index');
    }
}
