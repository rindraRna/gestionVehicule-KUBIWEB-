<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Produit;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session)
    {
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
}
