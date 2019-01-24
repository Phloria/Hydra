<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/homepage", name="homepage")
     */
    public function index()
    {
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/Gamespage", name="games")
     */
    public function gamesPage()
    {
        return $this->render('games.html.twig');
    }

    /**
     * @Route("/Memberspage", name="members")
     */
    public function membersPage()
    {
        return $this->render('members.html.twig');
    }

    /**
     * @Route("/registerpage", name="registerpage")
     */
    public function registerPage()
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        return $this->render('Disconnected/register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/loginpage", name="loginpage")
     */
    public function loginPage()
    {
        return $this->render('Disconnected/login.html.twig');
    }
}
