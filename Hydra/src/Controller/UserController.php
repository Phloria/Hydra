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
use Psr\Log\LoggerInterface;

class UserController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, LoggerInterface $logger)
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $logger->info('I just got the logger');
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();
        $user2 = $entityManager->getRepository(User::class)->findBy(array('email'=>$user->getEmail()));
        if ($user2)
            return $this->render('Disconnected/register.html.twig', array('form' => $form->createView(),'error' => 1));
        $logger->info('I just got the logger');
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('user', $user);

            return $this->render('index.html.twig');
        }

        return $this->render('Disconnected/register.html.twig', array('form' => $form->createView(),'error' => 1));
    }

    /**
     * @Route("/login", name="user_login")
     */
    public function login(Request $request)
    {
        $email = $request->get('_mail');
        $password = $request->get('_password');
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->findBy(array('email'=>$email, 'password'=>$password));
        if ($user)
        {
            $session = $request->getSession();
            $session->set('user', $user[0]);
            if ($user[0]->getEmail() == "admin")
                return $this->render('Admin/connected.html.twig');
            return $this->render('Connected/connected.html.twig');
        }
        return $this->render('Disconnected/login.html.twig', array('error' => 1));
    }

    /**
     * @Route("/disconnect", name="disconnect")
     */
    public function disconnect(Request $request)
    {
        $session = $request->getSession();
        $session->set('user', "");
        return $this->render('index.html.twig');
    }
}