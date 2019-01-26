<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use App\Form\ProfileRankType;
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
     * @Route("/Gamespage", name="games_page")
     */
    public function gamesPage()
    {
        return $this->render('games.html.twig');
    }

    /**
     * @Route("/Teampage", name="team_page")
     */
    public function teamPage()
    {
        return $this->render('team.html.twig');
    }

    /**
     * @Route("/registerpage", name="register_page")
     */
    public function registerPage()
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        return $this->render('Disconnected/register.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/loginpage", name="login_page")
     */
    public function loginPage()
    {
        return $this->render('Disconnected/login.html.twig', array('error'=> 0, 'last_username' => ''));
    }

    /**
     * @Route("/forgetpasswordpage", name="forget_password_page")
     */
    public function forgetPasswordPage()
    {
        return $this->render('Disconnected/forget_password.html.twig', array('error' => 0));
    }

    /**
     * @Route("/profilepage", name="profile_page")
     */
    public function profilePage()
    {
        return $this->render('Connected/profile.html.twig', array('error' => 0));
    }

    /**
     * @Route("/Videospage", name="videos_page")
     */
    public function videosPage()
    {
        return $this->render('videos.html.twig');
    }

    /**
     * @Route("/Memberspage", name="members")
     */
    public function membersPage()
    {
        return $this->render('team.html.twig');
    }

    /**
     * @Route("/profile_rank", name="profile_rank")
     */
    public function profileRank()
    {
        $user = new User();
        $form = $this->createForm(ProfileRankType::class, $user);
        return $this->render('Connected/profile_rank.html.twig',array('form' => $form->createView()));
    }
}
