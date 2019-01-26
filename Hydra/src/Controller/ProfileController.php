<?php
/**
 * Created by PhpStorm.
 * User: Lisac1
 * Date: 26/01/2019
 * Time: 17:54
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileRankType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile_rank", name="profile_rank")
     */
    public function register(Request $request)
    {
        //$user = new User();
        $form = $this->createForm(ProfileRankType::class, $user);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('user', $user);

            return $this->render('Connected/profile.html.twig');
        }
        return $this->render('Connected/profile_rank.html.twig', array('form' => $form->createView(),'error' => 1));
    }
}