<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private $repository;

    public function __construct(PropertyRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $properties = $this->repository->findLatest();

        return $this->render('home/index.html.twig',[
            'properties' => $properties
        ]);
    }
}
