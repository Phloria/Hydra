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
     * @Route("/Games", name="games")
     */
    public function games()
    {
        return $this->render('games.html.twig');
    }

    /**
     * @Route("/Members", name="members")
     */
    public function members()
    {
        return $this->render('members.html.twig');
    }
}
