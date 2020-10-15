<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Commande;
use App\Entity\DetailsCommande;

class GestionCommandeController extends AbstractController
{
    /**
     * @Route("/detailsCommande/{id}", name="detailsCommande")
     */
     public function detailsCommande($id)
     {
         $detailsCommandeProduits = $this->getDoctrine()
             ->getRepository(DetailsCommande::class)
             ->getDetailsCommandeProduit($id);
 
         return $this->render('gestion_commande/details.html.twig', [
             'detailsCommandeProduits' => $detailsCommandeProduits,
         ]);
     }

    /**
     * @Route("/gestionCommandes", name="gestionCommandes")
     */
    public function gestionCommandes()
    {
        $commandeClient = $this->getDoctrine()
            ->getRepository(Commande::class)
            ->getCommandeClient();

        return $this->render('gestion_commande/index.html.twig', [
            'commandeClients' => $commandeClient,
            'vide' => count($commandeClient),
        ]);
    }
}
