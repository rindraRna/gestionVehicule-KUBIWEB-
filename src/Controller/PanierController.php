<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Produit;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\DetailsCommande;

class PanierController extends AbstractController
{
    /**
    * @Route("/validerCommande}", name="validerCommande")
    */
    public function validerCommande(SessionInterface $session)
    {
        // creer commande  
        $entityManager = $this->getDoctrine()->getManager();
        $commande = new Commande();
        $commande->setIdClient($session->get('client'));
        $dateTime = new \DateTime();
        $dateTime->setTimezone(new \DateTimeZone('Europe/Paris'));
        $commande->setDateCommande($dateTime);
        $commande->setMontantTotal(0);
        $entityManager->merge($commande);
        $entityManager->flush();

        // ajouter details_commande dans commande
        $panier = $session->get('panier');
        $dernierCommande = $this->getDoctrine()
            ->getRepository(Commande::class)
            ->derniereCommandeCree();
        $montantTotal = 0;
        foreach($panier as $produit){
            // creer detailsCommande
            $detailsCommande = new DetailsCommande();
            $detailsCommande->setQuantite($produit->getQuantiteEnStock());
            $detailsCommande->setIdProduit($produit);
            $detailsCommande->setIdCommande($dernierCommande);
            $entityManager->merge($detailsCommande);
            $montantTotal += ($produit->getQuantiteEnStock() * $produit->getPrix());
        }
        $entityManager->flush();

        // mis a jour montant total
        $dernierCommande->setMontantTotal($montantTotal);
        $entityManager->flush();

        // mis a jour quantite produit
        foreach($panier as $produitDansPanier){
            $quantiteCommande = $produitDansPanier->getQuantiteEnStock();
            $produitConcerne = $this->getDoctrine()
                ->getRepository(Produit::class)
                ->find($produitDansPanier->getId());
            $quantiteEnStock = $produitConcerne->getQuantiteEnStock(); 
            $produitConcerne->setQuantiteEnStock($quantiteEnStock - $quantiteCommande);
        }
        $entityManager->flush();

        //redirection vers index
        $types = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->getType();

        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();

        return $this->render('index/index.html.twig', [
            'types' => $types,
            'produits' => $produits,
            'clientConnecte' => $session->get('client'),
            'message' => 'Votre commande est enregistrée',
        ]);
    }

    /**
    * @Route("/misAJourProduitPanier/{id}/{idProduit}", name="misAJourProduitPanier")
    */
    public function misAJourProduitPanier($id, $idProduit, SessionInterface $session, Request $request)
    {
        $panier = $session->get('panier');
        $quantiteCommande = intval($request->request->get('quantiteCommande'));

        // recuperer le produit
        $produit = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($idProduit);

        // gerer les erreurs de quantite
        if($quantiteCommande > $produit->getQuantiteEnStock()){
            // redirection vers panier
            return $this->render('panier/index.html.twig', [
                'clientConnecte' => $session->get('client'),
                'panier' => $session->get('panier'),
                'erreur' => "Erreur: la quantité commandée est supérieure au stock",
            ]);
        }    
        else if($quantiteCommande < 1){
            // redirection vers panier
            return $this->render('panier/index.html.twig', [
                'clientConnecte' => $session->get('client'),
                'panier' => $session->get('panier'),
                'erreur' => "Erreur: la quantité commandée doit être supérieur à 0",
            ]);
        }    
        else{
            // supprimer le produit avec l indice
            unset($panier[$id]);
    
            // mis a jour quantite
            $produit->setQuantiteEnStock($quantiteCommande);
    
            // supprimer le panier actuel
            $session->set('panier', null);
    
            // créer nouveau panier et ajouter dans panier
            $nouveauPanier = array();
            array_push($nouveauPanier,$produit);
            foreach($panier as $produit){
                array_push($nouveauPanier, $produit);
            }
            $session->set('panier', $nouveauPanier);
    
            // redirection vers panier
            return $this->render('panier/index.html.twig', [
                'clientConnecte' => $session->get('client'),
                'panier' => $session->get('panier'),
                'erreur' => "Quantité mis à jour",
            ]);
        }
     }

    /**
    * @Route("/supprimerProduitPanier/{id}", name="supprimerProduitPanier")
    */
    public function supprimerProduitPanier($id, SessionInterface $session)
    {
        $panier = $session->get('panier');

        // supprimer le produit avec l indice
        unset($panier[$id]);

        // mis a jour valeur panier
        $panier = $session->set('panier', $panier);

        // redirection vers panier
        return $this->render('panier/index.html.twig', [
            'clientConnecte' => $session->get('client'),
            'panier' => $session->get('panier'),
            'erreur' => "Le produit a été supprimé du panier",
        ]);
     }

    /**
     * @Route("/ajoutpanier/{id}", name="ajoutpanier")
     */
    public function ajoutpanier($id, Request $request, SessionInterface $session)
    {
        // recupérer quantite et le produit
        $quantiteCommande= intval($request->request->get('quantite'));
        $produit = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id);

        // gerer l erreur de quantite
        if($quantiteCommande > $produit->getQuantiteEnStock()){
            $vehicule = $this->getDoctrine()
                ->getRepository(Produit::class)
                ->find($id);
            return $this->render('fiche/index.html.twig', [
                'vehicule' => $vehicule,
                'erreur' => "Erreur: la quantité commandée est supérieure au stock",
                'clientConnecte' => $session->get('client'),
            ]);
        }    
        else{
            // initialiser panier
            $panier = $session->get('panier');
            if(!isset($panier)){    
                $panier = array();
            }
    
            // mis a jour quantite
            $produit->setQuantiteEnStock($quantiteCommande); //pas encore validé donc la quantite ne change pas dans la base de données
            array_push($panier,$produit);
            $session->set('panier',$panier);
    
            // redirection vers panier
            return $this->render('panier/index.html.twig', [
                'clientConnecte' => $session->get('client'),
                'panier' => $session->get('panier'),
                'erreur' => "",
            ]);
        }
    }

    /**
     * @Route("/panier", name="panier")
     */
     public function panier(SessionInterface $session)
     {
        return $this->render('panier/index.html.twig', [
            'clientConnecte' => $session->get('client'),
            'panier' => $session->get('panier'),
            'erreur' => "",
        ]);
     }

    /**
    * @Route("/viderPanier", name="viderPanier")
    */
    public function viderPanier(SessionInterface $session)
    {
        $session->set('panier', null);
        return $this->render('panier/index.html.twig', [
            'clientConnecte' => $session->get('client'),
            'panier' => $session->get('panier'),
            'erreur' => "",
        ]);
    }
}
