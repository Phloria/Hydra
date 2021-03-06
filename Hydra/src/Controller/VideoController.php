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
     * Post a video or Edit
     * @Route("/postvideo", name="post_video")
     */
    public function postVideo(Request $request)
    {
        $videoid = $request->get('videoid');
        $entityManager = $this->getDoctrine()->getManager();
        if ($videoid)
            $video = $entityManager->getRepository(Video::class)->findOneBy(['id' => $videoid]);
        else
            $video = new Video();
        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);
        $user = $this->getUser();
        $video->setUsername($user->getUsername());
        if ($form->isSubmitted() && $form->isValid())
        {
            $video->setCreatedate(new \DateTime());
            $entityManager->persist($video);
            $entityManager->flush();

            return $this->redirectToRoute('videos_page');
        }
        $this->addFlash('error', 'The video was not upload!');
        return $this->render('Member/video_new.html.twig');
    }

    /**
     * @Route("/deletevideo", name="delete_video")
     */
    public function deleteVideo(Request $request)
    {
        $videoid = $request->get('videoid');
        $entityManager = $this->getDoctrine()->getManager();
        $video = $entityManager->getRepository(Video::class)->findOneBy(['id' => $videoid]);
        $entityManager->remove($video);
        $entityManager->flush();
        return $this->redirectToRoute('videos_page');
    }
}