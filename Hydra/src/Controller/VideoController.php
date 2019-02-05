<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 04/02/2019
 * Time: 02:30
 */

namespace App\Controller;


use App\Entity\Video;
use App\Form\VideoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class VideoController extends AbstractController
{
    /**
     * @Route("/postvideo", name="post_video")
     */
    public function postVideo(Request $request)
    {
        $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);
        $user = $this->getUser();
        $video->setUsername($user->getUsername());
        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('videos_page');
        }
        $this->addFlash('error', 'The video was not upload!');
        return $this->render('Member/video_new.html.twig');
    }
}