<?php
/**
 * Created by PhpStorm.
 * User: Tu Justin
 * Date: 05/02/2019
 * Time: 16:54
 */

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Video;
use App\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class GameController extends AbstractController
{
    /**
     * @Route("/addgame", name="add_game")
     */
    public function addGame(Request $request)
    {
        $game = new Game();
        $form = $this->createForm(VideoType::class, $game);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('videos_page');
        }
        $this->addFlash('error', 'The video was not upload!');
        return $this->render('Member/video_new.html.twig');
    }
}