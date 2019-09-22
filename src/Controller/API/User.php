<?php


namespace App\Controller\API;


use App\Entity\Developer;
use App\Entity\ProjectManager;
use App\Entity\Tester;
use App\Services\Mailer;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class User extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/user")
     * @Rest\Get("/api/user/{id}")
     * @param null $id
     * @return View|mixed
     */
    public function getUser($id = null)
    {
        $repo = $this->getDoctrine()->getManager()->getRepository(\App\Entity\User::class);
        $users = $id !== null ? $repo->find($id) : $repo->findAll();
        return View::create(
            $users,
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Post("/api/user")
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return View
     */
    public function postUser(Request $request, Mailer $mailer)
    {
        $em = $this->getDoctrine()->getManager();
        $rc = Response::HTTP_OK;
        $position = $request->request->get('position');

        $ur = $em->getRepository(\App\Entity\User::class);
        $user = $ur->createUser($position);
        $user = $ur->setUpFromRequestUser($user, $request);
        $errors = $ur->validateUser($user);

        if (count($errors) > 0) {
            $rc = Response::HTTP_INTERNAL_SERVER_ERROR;
        } else {
            $ur->saveUser($user);
            $mailer->sendUserInfo($user);
        }

        return View::create(
            [
                'code' => $rc,
                'errors' => $errors
            ]
        );
    }

    /**
     * @Rest\Put("/api/user/{id}")
     * @param $id
     * @return View
     */
    public function putUser($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rc = Response::HTTP_OK;

        $ur = $em->getRepository(\App\Entity\User::class);
        $user = $ur->getUser($id);
        $user = $ur->setUpFromRequestUser($user, $request);
        $errors = $ur->validateUser($user);

        if (count($errors) > 0) {
            $rc = Response::HTTP_INTERNAL_SERVER_ERROR;
        } else {
            $ur->saveUser($user);
        }

        return View::create(
            [
                'code' => $rc,
                'errors' => $errors
            ]
        );
    }

    /**
     * @Rest\Delete("/api/user/{id}")
     * @param int $id
     * @return View
     */
    public function deleteUser(int $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(\App\Entity\User::class)->find($id);
        $em->remove($user);
        $em->flush();

        return View::create(
            [
                'code' => Response::HTTP_OK,
                'errors' => []
            ]
        );
    }
}