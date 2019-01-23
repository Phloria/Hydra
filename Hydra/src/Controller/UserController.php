<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 23/01/2019
 * Time: 18:17
 */

namespace App\Controller;


use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request)
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $user2 = $entityManager->getRepository(User::class)->findBy(array('email'=>$user->getEmail()));
        if ($user2)
            return $this->render('Disconnected/register.html.twig', array('form' => $form->createView(),'error' => 1));

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('user', $user);

            return $this->render('Connected/connected.html.twig');
        }

        return $this->render('Disconnected/register.html.twig', array('form' => $form->createView(),'error' => 1));
    }
}