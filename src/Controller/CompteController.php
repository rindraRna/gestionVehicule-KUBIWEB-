<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use App\Entity\Client;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;

class CompteController extends AbstractController
{
    /**
    * @Route("/ajoutClient", name="ajoutClient")
    */
    public function ajoutClient(Request $request, SessionInterface $session)
    {
        // recuperation données
        $nom =  $request->request->get('nom');
        $prenom =  $request->request->get('prenom');
        $adresse =  $request->request->get('adresse');
        $telephone =  $request->request->get('telephone');
        $email =  $request->request->get('email');
        $motDePasse =  $request->request->get('motDePasse');
        $motDePasseConfirmation =  $request->request->get('motDePasseConfirmation');

        if($motDePasse == $motDePasseConfirmation){
            // creer client    
            $entityManager = $this->getDoctrine()->getManager();
            $client = new Client();
            $client->setNom($nom);
            $client->setPrenom($prenom);
            $client->setAdresse($adresse);
            $client->setTelephone($telephone);
            $client->setEmail($email);
            $client->setMotDePasse($motDePasse);
            // tell Doctrine you want to (eventually) save the personne (no queries yet)
            $entityManager->persist($client);
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

            // session client et panier
            $session->set('client', $client);
            $session->set('pannier', null);

            // redirection vers index
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
                'message' => '',
            ]);
        }
        else{
            return $this->render('compte/inscription.html.twig', [
                'erreur' => "Erreur: les mots de passes ne sont pas identiques",
                'nom' =>  $nom,
                'prenom' =>  $prenom,
                'adresse' =>  $adresse,
                'telephone' =>  $telephone,
                'email' =>  $email,
                'motDePasse' =>  $motDePasse,
                'motDePasseConfirmation' =>  $motDePasseConfirmation,
                'etat' => 'erreur',
            ]);
        }
    }

    /**
    * @Route("/login", name="login")
    */
    public function login(Request $request, SessionInterface $session)
    {
        // verification login
        $email =  $request->request->get('email');
        $motDePasse =  $request->request->get('motDePasse');
        $client = $this->getDoctrine()
            ->getRepository(Client::class)
            ->login($email,$motDePasse);

        if($client!=null){
            // session
            $session->set('client', $client);

            // redirection vers index
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
                'message' => '',
            ]);
        }
        else{
            return $this->render('compte/connexion.html.twig', [
                'erreur' => "Erreur: email / mot de passe incorrect",
            ]);
        }
        
    }

    /**
    * @Route("/deconnexion", name="deconnexion")
    */
    public function deconnexion(SessionInterface $session)
    {
        // redirection vers index
        $types = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->getType();

        $produits = $this->getDoctrine()
            ->getRepository(Produit::class)
            ->findAll();
            
        return $this->render('index/index.html.twig', [
            'types' => $types,
            'produits' => $produits,
            'clientConnecte' => $session->set('client', null),
            'panier' => $session->set('panier', null),
            'message' => '',
        ]);
        
    }

    /**
     * @Route("/inscription", name="inscription")
     */
     public function inscription()
     {
        return $this->render('compte/inscription.html.twig', [
            'erreur' => "",
            'etat' => 'normal',
        ]);
     }

    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion()
    {
        return $this->render('compte/connexion.html.twig', [
            'erreur' => "",
        ]);
    }
}
