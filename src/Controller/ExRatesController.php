<?php

namespace App\Controller;

use App\Entity\ExRates;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ExRatesController extends AbstractController
{
    /**
     * @Route("/exrates", name="ex_rates")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $exrates = $em->getRepository(ExRates::class)->findAll();

        return $this->render('ex_rates/index.html.twig', [
            'exrates' => $exrates,
        ]);
    }

    /**
     * @Route("/exrates/{id}", name="ex_rates_show")
     */
    public function showAction($id)
    {
        $exrates = $this->getDoctrine()
            ->getRepository(ExRates::class)
            ->find($id);

        if (!$exrates) {
            throw $this->createNotFoundException(
                'Не известный идентификатор ' . $id
            );
        }

        return new Response($exrates->getScale() . ' ' . $exrates->getName() . ' => ' . $exrates->getRate() . ' Белорусских рублей.  По состоянию на ' . $exrates->getDate()->format('d-m-Y') . '.');
    }

    /**
     * @Route("/api/exrates", name="api_ex_rates")
     */
    public function apiAction()
    {
        $em = $this->getDoctrine()->getManager();

        $exrates = $em->getRepository(ExRates::class)->findAll();
        $serializer = $this->container->get('serializer');
        $reports = $serializer->serialize( $exrates, 'json');
        return new Response($reports);
    }
}
