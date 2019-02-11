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
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/teampage", name="team_page")
     */
    public function teamPage()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        if (!$users) {
            return $this->render('team.html.twig', ['users' => 0]);
        }
        return $this->render('team.html.twig', ['users' => $users]);
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
     * @Route("/games", name="games_page")
     */
    public function gamesPage()
    {
        return $this->render('games.html.twig');
    }

    /**
     * @Route("/games/new", name="new_game_page")
     */
    public function newGamePage()
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        return $this->render('Member/game_new.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/videos", name="videos_page")
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
     * @Route("/videos/new", name="new_video_page")
     */
    public function newVideoPage()
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        return $this->render('Member/video_new.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/videos/edit", name="edit_video_page")
     */
    public function editVideoPage(Request $request)
    {
        $videoid = $request->get('videoid');
        if ($videoid) {
            $entityManager = $this->getDoctrine()->getManager();
            $video = $entityManager->getRepository(Video::class)->findOneBy(['id' => $videoid]);
            $form = $this->createForm(VideoType::class, $video);
            return $this->render('Member/video_new.html.twig', array('video' => $video, 'form' => $form->createView()));
        }
        return $this->render('index.html.twig');
    }

    /**
     * @Route("/videos/{videoId}", name="video_page")
     */
    public function videoPage($videoId)
    {
        $array_info = preg_split("/\:/", $videoId);
        $urlId = $array_info[1];
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository(Video::class)->findOneBy(['urlId' => $urlId]);
        if ($video)
            return $this->render('video.html.twig', array('video' => $video));
        else
            return $this->render('index.html.twig');
    }
}
