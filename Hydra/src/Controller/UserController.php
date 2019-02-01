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
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('Disconnected/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    public function mailRegistration(\Swift_Mailer $mailer, $email, $firstName)
    {
        $message = (new \Swift_Message('You\'ve successfully created an account on HydraMind Gaming Site!'))
            ->setFrom('tulisac1@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                // templates/Email/registration.html.twig
                    'Email/registration.html.twig',
                    array('name' => $firstName)
                ),
                'text/html'
            );
        $mailer->send($message);
    }

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $encoder)
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
            $this->mailRegistration($mailer, $user->getEmail(), $user->getFirstName());
            $user->setJoindate(new \DateTime());
            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('Disconnected/login.html.twig');
        }
        return $this->render('Disconnected/register.html.twig', array('form' => $form->createView(),'error' => 1));
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function mailRandomPassword(\Swift_Mailer $mailer, $email, $firstName, $password)
    {
        $message = (new \Swift_Message('You\'ve successfully reset your password !'))
            ->setFrom('tulisac1@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                // templates/Email/registration.html.twig
                    'Email/forget_password.html.twig',
                    array('name' => $firstName, 'password' => $password)
                ),
                'text/html'
            );
        $mailer->send($message);
    }

    /**
     * @Route("/forget_password", name="forget_password")
     */
    public function forgetPassword(Request $request, \Swift_Mailer $mailer, UserPasswordEncoderInterface $encoder)
    {
        $username = $request->get('_username');
        $entityManager = $this->getDoctrine()->getManager();
        $user_username = $entityManager->getRepository(User::class)->findBy(array('username'=>$username));
        $user_mail = $entityManager->getRepository(User::class)->findBy(array('email'=>$username));
        $user = null;
        if ($user_username)
            $user = $user_username;
        else if ($user_mail)
            $user = $user_mail;
        if ($user)
        {
            $password = $this->generateRandomString();
            $encoded = $encoder->encodePassword($user[0], $password);
            $user[0]->setPassword($encoded);
            $entityManager->persist($user[0]);
            $entityManager->flush();
            $this->mailRandomPassword($mailer, $user[0]->getEmail(), $user[0]->getFirstName(), $password);
            $this->addFlash('notice', 'A mail has been sent with a new password!');
            return $this->render('Disconnected/login.html.twig', array("last_username" => $user[0]->getUsername(), 'error' => 0));
        } else {
            $this->addFlash('error', 'This Username or Email doesn\'t exist!');
            return $this->render('Disconnected/forget_password.html.twig');
        }
    }
}