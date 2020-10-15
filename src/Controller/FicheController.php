<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FicheController extends AbstractController
{
    /**
     * @Route("/fiche/{id}", name="fiche")
     */
    public function fiche($id, SessionInterface $session)
    {
        $vehicule = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id);
        return $this->render('fiche/index.html.twig', [
            'vehicule' => $vehicule,
            'erreur' => "",
            'clientConnecte' => $session->get('client'),
        ]);
    }
}
