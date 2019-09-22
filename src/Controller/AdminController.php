<?php


namespace App\Controller;


use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     * @return Response
     */
    public function index()
    {
        return $this->render(
            'admin.html.twig',
            [
                'view_mode' => 'list'
            ]
        );
    }

    /**
     * @Route("/admin/edit/user/{id}", name="app_admin_edit_user")
     * @param $id
     * @return Response
     */
    public function editUser($id, SerializerInterface $serializer)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);
        return $this->render(
            'admin.html.twig',
            [
                'view_mode' => 'edit_user',
                'user' => $serializer->serialize($user, 'json')
            ]
        );
    }
}