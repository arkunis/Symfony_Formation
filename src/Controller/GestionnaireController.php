<?php

namespace App\Controller;

use App\Entity\CompteRegister;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\GestionnaireType;
use App\Form\UpdateCompteType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionnaireController extends AbstractController
{
    #[Route('/gestionnaire', name: 'app_gestionnaire')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new CompteRegister();
        $form = $this->createForm(GestionnaireType::class, $user);
        $form->handleRequest($request);
        $users = $this->getUser()->getId();
        $message = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword($form->get('plainPassword')->getData());
            $user->setCategorie("0");
            $user->setUsersId($this->getUser(), $users);

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute("app_gestionnaire");
        }

        if (isset($_POST['supprimer'])) {
            $del = $entityManager->getRepository(CompteRegister::class)->find($_POST['supprimer']);
            if ($del->getUsersId()->getId() === $users) {
                $entityManager->remove($del);
                $entityManager->flush();
            }
        } 
        
        if (isset($_POST['modifier'])) {
            $update = $entityManager->getRepository(CompteRegister::class)->find($_POST['modifier']);
            if ($update->getUsersId()->getId() === $users && htmlentities(stripslashes($_POST['password'])) != "") {
                if(htmlentities(stripslashes($_POST['identifiant'])) != ""){
                    if(htmlentities(stripslashes($_POST['NomUrl'])) != ""){
                $update->setNomUrl(htmlentities(stripslashes($_POST['NomUrl'])));
                $update->setIdentifiant(htmlentities(stripslashes($_POST['identifiant'])));
                $update->setPassword(htmlentities(stripslashes($_POST['password'])));
                $entityManager->flush();
                    }else $this->addFlash("message", "Le champ Nom / Url ne peut être vide");
                }else $this->addFlash("message", "Le champ identifiant ne peut être vide");
            }else $this->addFlash("message", "Le champ mot de passe ne peut être vide");
        }

       

        $events = $entityManager->getRepository(CompteRegister::class)->findBy(["users_id" => $users]);

        return $this->render('gestionnaire/gestion.html.twig', [
            'controller_name' => 'GestionnaireController',
            'gestionForm' => $form->createView(),
            'events' => $events,
        ]);
    }
}
