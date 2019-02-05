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
use App\Form\GameType;
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
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('games_page');
        }
        $this->addFlash('error', 'The game was not added!');
        return $this->render('Member/game_new.html.twig');
    }
}