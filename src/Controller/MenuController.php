<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Entity\Fournisseur;
use App\Entity\Marque;

class MenuController extends AbstractController
{
    /**
     * @Route("/gestion", name="gestion")
     */
    public function gestion()
    {
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    

        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();

        return $this->render('menu/gestion.html.twig', [
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererProduit',
        ]);
    }
}
