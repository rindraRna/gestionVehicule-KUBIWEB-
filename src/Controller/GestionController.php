<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Entity\Fournisseur;
use App\Entity\Marque;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;

class GestionController extends AbstractController
{
    /**
    * @Route("/misAJourStockProduit/{id}", name="misAJourStockProduit")
    */
    public function misAJourStockProduit($id, Request $request)
    {
        $quantiteEnStock = intval($request->request->get('quantiteEnStock'));
        $entityManager = $this->getDoctrine()->getManager();
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        $produit->setQuantiteEnStock($quantiteEnStock);

        // actually executes the queries (i.e. the DELETE query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererFournisseur',
        ]);
    }

    /**
    * @Route("/supprimerFournisseur/{id}", name="supprimerFournisseur")
    */
    public function supprimerFournisseur($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($id);
        // tell Doctrine you want to (eventually) remove the produit (no queries yet)
        $entityManager->remove($fournisseur);
        // actually executes the queries (i.e. the DELETE query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererFournisseur',
        ]);
    }

    /**
    * @Route("/modifierFournisseur/{id}", name="modifierFournisseur")
    */
    public function modifierFournisseur($id, Request $request)
    {
        $nom = $request->request->get('nom');
        // modifier fournisseur    
        $entityManager = $this->getDoctrine()->getManager();
        $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($id);
        $fournisseur->setNom($nom);
        
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererFournisseur',
        ]);
    }

    /**
    * @Route("/modifierFormFournisseur/{id}", name="modifierFormFournisseur")
    */
    public function modifierFormFournisseur($id)
    {
        $fournisseur = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->find($id);
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();

        return $this->render('menu/gestion.html.twig',[
            'fournisseur' => $fournisseur,
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'modifierFournisseur',
        ]);
    }


    /**
    * @Route("/ajouterFournisseur", name="ajouterFournisseur")
    */
    public function ajouterFournisseur(Request $request)
    {
        $nom = $request->request->get('nom');

        // creer fournisseur    
        $entityManager = $this->getDoctrine()->getManager();
        $fournisseur = new Fournisseur();
        $fournisseur->setNom($nom);
        // tell Doctrine you want to (eventually) save the personne (no queries yet)
        $entityManager->persist($fournisseur);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererFournisseur',
        ]);
    }

    /**
    * @Route("/supprimerProduit/{id}", name="supprimerProduit")
    */
    public function supprimerProduit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        // tell Doctrine you want to (eventually) remove the produit (no queries yet)
        $entityManager->remove($produit);
        // actually executes the queries (i.e. the DELETE query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererProduit',
        ]);
    }

    /**
    * @Route("/modifierProduit/{id}", name="modifierProduit")
    */
    public function modifierProduit($id, Request $request, FileUploader $fileUploader, string $uploadDir)
    {
        $titre = $request->request->get('titre');
        $description = $request->request->get('description');
        $quantiteEnStock = intval($request->request->get('quantiteEnStock'));
        $idMarque = intval($request->request->get('idMarque'));
        $prix = intval($request->request->get('prix'));
        $type = $request->request->get('type');
        $genre = $request->request->get('genre');
        $photo = $request->files->get('photo');
        // upload photo
        $filename = $photo->getClientOriginalName();
        $fileUploader->upload($uploadDir, $photo, $filename);
        // recupérer la marque
        $marque = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->find($idMarque);    
        // modifier produit    
        $entityManager = $this->getDoctrine()->getManager();
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        $produit->setTitre($titre);
        $produit->setDescription($description);
        $produit->setQuantiteEnStock($quantiteEnStock);
        $produit->setIdMarque($marque);
        $produit->setPrix($prix);
        $produit->setType($type);
        $produit->setGenre($genre);
        $produit->setPhoto($filename);
        
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererProduit',
        ]);
    }

    /**
    * @Route("/modifierForm/{id}", name="modifierForm")
    */
    public function modifierForm($id)
    {
        $produit = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->find($id);
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();

        return $this->render('menu/gestion.html.twig',[
            'produit' => $produit,
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'modifierProduit',
        ]);
    }

    /**
    * @Route("/creerProduit", name="creerProduit")
    */
    public function creerProduit(Request $request, FileUploader $fileUploader, string $uploadDir)
    {
        $titre = $request->request->get('titre');
        $description = $request->request->get('description');
        $quantiteEnStock = intval($request->request->get('quantiteEnStock'));
        $idMarque = intval($request->request->get('idMarque'));
        $prix = intval($request->request->get('prix'));
        $type = $request->request->get('type');
        $genre = $request->request->get('genre');
        $photo = $request->files->get('photo');
        // upload photo
        $filename = $photo->getClientOriginalName();
        $fileUploader->upload($uploadDir, $photo, $filename);
        // recupérer la marque
        $marque = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->find($idMarque);    
        // creer produit    
        $entityManager = $this->getDoctrine()->getManager();
        $produit = new Produit();
        $produit->setTitre($titre);
        $produit->setDescription($description);
        $produit->setQuantiteEnStock($quantiteEnStock);
        $produit->setIdMarque($marque);
        $produit->setPrix($prix);
        $produit->setType($type);
        $produit->setGenre($genre);
        $produit->setPhoto($filename);
        // tell Doctrine you want to (eventually) save the personne (no queries yet)
        $entityManager->persist($produit);
        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        
        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
        $marques = $this->getDoctrine()
            ->getRepository(Marque::class)
            ->findAll();    
        $fournisseurs = $this->getDoctrine()
            ->getRepository(Fournisseur::class)
            ->findAll();
        return $this->render('menu/gestion.html.twig',[
            'produits' => $produits,
            'fournisseurs' => $fournisseurs,
            'marques' => $marques,
            'action' => 'insererProduit',
        ]);
    }
}
