<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\User;
use App\Entity\Video;
use App\Form\GameType;
use App\Form\RegisterType;
use App\Form\ProfileRankType;
use App\Form\VideoType;
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
        return $this->render('Connected/profile.html.twig');
    }

    /**
     * @Route("/Memberspage", name="members")
     */
    public function membersPage()
    {
        return $this->render('team.html.twig');
    }

    /**
     * @Route("/profilerankpage", name="profile_rank_page")
     */
    public function profileRankPage()
    {
        $user = new User();
        $form = $this->createForm(ProfileRankType::class, $user);
        return $this->render('Connected/profile_rank.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/profilepasswordpage", name="profile_password_page")
     */
    public function profilePasswordPage()
    {
        return $this->render('Connected/profile_password.html.twig');
    }

    /**
     * @Route("/videospage", name="videos_page")
     */
    public function videosPage()
    {
        $videos = $this->getDoctrine()->getRepository(Video::class)->findAll();
        if (!$videos) {
            return $this->render('videos.html.twig', ['videos' => 0]);
        }
        return $this->render('videos.html.twig', ['videos'=> $videos] );
    }

    /**
     * @Route("/newvideopage", name="new_video_page")
     */
    public function newVideoPage()
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        return $this->render('Member/video_new.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/gamespage", name="games_page")
     */
    public function gamesPage()
    {
        return $this->render('games.html.twig');
    }

    /**
     * @Route("/newgamepage", name="new_game_page")
     */
    public function newGamePage()
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        return $this->render('Member/game_new.html.twig',array('form' => $form->createView()));
    }
}
