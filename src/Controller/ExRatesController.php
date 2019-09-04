<?php

namespace App\Controller;

use App\Entity\ExRates;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

class ExRatesController extends AbstractController
{
    /**
     * @Route("/exrates", name="ex_rates")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();


        $exrates = $em->getRepository(ExRates::class)->findAll();

        return $this->render('ex_rates/index.html.twig',[
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
                'No product found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$exrates->getName());
    }
}
