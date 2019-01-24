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
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Egulias\EmailValidator\Validation\MultipleValidationWithAnd;
use Egulias\EmailValidator\Validation\RFCValidation;

class UserController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
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
    public function register(Request $request, \Swift_Mailer $mailer)
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
            $entityManager->persist($user);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('user', $user);

            return $this->render('index.html.twig');
        }
        return $this->render('Disconnected/register.html.twig', array('form' => $form->createView(),'error' => 1));
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request)
    {
        $pseudo = $request->get('_pseudo');
        $password = $request->get('_password');
        $entityManager = $this->getDoctrine()->getManager();
        $user_mail = $entityManager->getRepository(User::class)->findBy(array('email'=>$pseudo, 'password'=>$password));
        $user_pseudo = $entityManager->getRepository(User::class)->findBy(array('pseudo'=>$pseudo, 'password'=>$password));
        $user = null;
        if ($user_mail)
            $user = $user_mail;
        else if ($user_pseudo)
            $user = $user_pseudo;
        if ($user)
        {
            $session = $request->getSession();
            $session->set('user', $user[0]);
            if ($user[0]->getEmail() == "admin")
                return $this->render('index.html.twig');
            return $this->render('index.html.twig');
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
     * @Route("/forgetpassword", name="forget_password")
     */
    public function forgetPassword(Request $request, \Swift_Mailer $mailer)
    {
        $pseudo = $request->get('_pseudo');
        $entityManager = $this->getDoctrine()->getManager();
        $user_pseudo = $entityManager->getRepository(User::class)->findBy(array('pseudo'=>$pseudo));
        $user_mail = $entityManager->getRepository(User::class)->findBy(array('email'=>$pseudo));
        $user = null;
        if ($user_pseudo)
            $user = $user_pseudo;
        else if ($user_mail)
            $user = $user_mail;
        if ($user)
        {
            $newpassword = $this->generateRandomString();
            $user[0]->setPassword($newpassword);
            $entityManager->persist($user[0]);
            $entityManager->flush();
            $this->mailRandomPassword($mailer, $user[0]->getEmail(), $user[0]->getFirstName(), $user[0]->getPassword());
            return $this->render('index.html.twig');
        } else {
            return $this->render('Disconnected/forget_password.html.twig', array('error' => 1));
        }

    }
}