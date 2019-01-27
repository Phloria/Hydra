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
    public function profileRank(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $userfake = new User();
        $user = $this->getUser();
        $form = $this->createForm(ProfileRankType::class, $userfake);
        $form->handleRequest($request);

        //Si il n'y a eu aucun changement
        if ((!$userfake->getCsgoActualRank() || $user->getCsgoActualRank() == $userfake->getCsgoActualRank()) &&
            (!$userfake->getCsgoBestRank() || $user->getCsgoBestRank() == $userfake->getCsgoBestRank()) &&
            (!$userfake->getOwActualRank() || $user->getOwActualRank() == $userfake->getOwActualRank()) &&
            (!$userfake->getOwBestRank() || $user->getOwBestRank() == $userfake->getOwBestRank()) &&
            !$userfake->getPubgLink() || $user->getPubgLink() == $userfake->getPubgLink())
        {
            $this->addFlash('notice',"Nothing to change!");
            return $this->render('Connected/profile.html.twig');
        }

        //Si le choix etait a "--" alors rien a changer
        if ($userfake->getCsgoActualRank())
            $user->setCsgoActualRank($userfake->getCsgoActualRank());
        if ($userfake->getCsgoBestRank())
            $user->setCsgoBestRank($userfake->getCsgoBestRank());
        if ($userfake->getOwActualRank())
            $user->setOwActualRank($userfake->getOwActualRank());
        if ($userfake->getOwBestRank())
            $user->setOwBestRank($userfake->getOwBestRank());
        if ($userfake->getPubgLink())
            $user->setPubgLink($userfake->getPubgLink());

        //Si le niveau actuel est > au Best rank, ce n'est pas normal
        if ($user->getCsgoActualRank() > $user->getCsgoBestRank()){
            $this->addFlash('notice',"CSGO: Your best rank cannot be lower than your actual rank (or be None)!");
            return $this->render('Connected/profile_rank.html.twig', array('form' => $form->createView(),'error' => 1));
        }
        if ($user->getOwActualRank() > $user->getOwBestRank()){
            $this->addFlash('notice',"Overwatch: Your best rank cannot be lower than your actual rank (or be None)");
            return $this->render('Connected/profile_rank.html.twig', array('form' => $form->createView(),'error' => 2));
        }

        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($user);
            $entityManager->flush();
            $session = $request->getSession();
            $session->set('user', $user);
            $this->addFlash('notice', 'Your changes were saved!');
            return $this->render('Connected/profile.html.twig');
        }
        $this->addFlash('notice', 'An unknown error has occurred!');
        return $this->render('Connected/profile_rank.html.twig', array('form' => $form->createView(),'error' => 3));
    }
}