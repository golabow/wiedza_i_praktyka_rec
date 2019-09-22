<?php


namespace App\Controller\API;


use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;

class Position extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/api/position")
     * @return View
     */
    public function getPosition()
    {
        $em = $this->getDoctrine()->getManager();
        $positions = $em->getRepository(\App\Entity\Position::class)->findAll();
        return View::create($positions, Response::HTTP_OK);
    }
}