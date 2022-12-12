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

/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="app_service_index", methods={"GET"})
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }
    /**
     * @Route("/customer/{id}", name="service_customer", methods={"GET"})
     */
    public function customerindex(int $id,ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/index.html.twig', [
            'services' => $serviceRepository->findServicesByCustomer($id),
        ]);
    }

    /**
     * @Route("/new", name="app_service_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ServiceRepository $serviceRepository): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceRepository->add($service, true);

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }
    /**
     * @Route("/create/{id}", name="service_by_sales", methods={"GET", "POST"})
     */
    public function create(Request $request, int $id, ServiceRepository $serviceRepository,SalesRepository $salesrepository,EntityManagerInterface $entityManager): Response
    {
        
       

            $service = new Service();

            // $sales = $salesrepository->find($id);
            // $salesid = $sales->getId();
            $time = new \DateTime('now');
            $service->setCreatedAt($time);
            $service->addSale($salesrepository->find($id));
            $service->addCustomer($salesrepository->find($id)->getCustomer());
           
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_service_edit', ['id'=> $service->getId()], Response::HTTP_SEE_OTHER);
        

       
    }



    /**
     * @Route("/{id}", name="app_service_show", methods={"GET"})
     */
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_service_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Service $service, ServiceRepository $serviceRepository): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $serviceRepository->add($service, true);

            return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_service_delete", methods={"POST"})
     */
    public function delete(Request $request, Service $service, ServiceRepository $serviceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $serviceRepository->remove($service, true);
        }

        return $this->redirectToRoute('app_service_index', [], Response::HTTP_SEE_OTHER);
    }




}
