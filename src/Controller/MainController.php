<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Sales;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use App\Repository\SalesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class MainController extends AbstractController{


/**
* @Route("/Myservices", name="myservices", methods={"GET"})
*/
public function myservices(ServiceRepository $serviceRepository): Response
{

       $user = $this->get('security.token_storage')->getToken()->getUser();
       $id = $user->getId();
       return $this->render('main/services.html.twig', [
       'services' => $serviceRepository->findServicesByUser($id),
   ]);
}

/**
* @Route("/homepage", name="homepage", methods={"GET"})
*/
public function homepage(ServiceRepository $serviceRepository): Response
{
        $TODO = "TODO";
      
       return $this->render('main/home.html.twig', [
       'services' => $serviceRepository->findServicesByStatus($TODO),
   ]);
}


}