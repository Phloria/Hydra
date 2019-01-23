<?php

namespace App\Controller;

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
     * @Route("/registerpage", name="register")
     */
    public function registerPage()
    {
        return $this->render('register.html.twig');
    }
}
