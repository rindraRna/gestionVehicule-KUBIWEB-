<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Produit;
use App\Entity\Fournisseur;
use App\Entity\Marque;
use App\Entity\Client;
use App\Entity\Administrateur;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // ajout fournisseur
        for($i = 1; $i < 6; $i++){
            $fournisseur = new Fournisseur();
            $fournisseur->setNom("Fournisseur ".$i);
            $manager->persist($fournisseur);
        }
        $manager->flush();
        
        // ajout marque
        for($i = 1; $i < 6; $i++){
            $marque = new Marque();
            $marque->setNom("Marque ".$i);
            $fournisseur = $manager
                ->getRepository(Fournisseur::class)
                ->findOneBy([
                    'nom' => "Fournisseur ".$i
                ]);
            $marque->setIdFournisseur($fournisseur);
            $manager->persist($marque);
        }
        $manager->flush();

        // ajout produit
        $produit1 = new Produit();
        $produit1->setTitre("Dodge JQ 4");
        $produit1->setDescription("Description Dodge JQ 4");
        $produit1->setQuantiteEnStock(7);
        $marque1 = $manager
            ->getRepository(Marque::class)
            ->findOneBy([
                'nom' => "Marque 1"
            ]);
        $produit1->setIdMarque($marque1);
        $produit1->setPrix(31000);
        $produit1->setType("BMW");
        $produit1->setGenre("Genre 1");
        $produit1->setPhoto("Dodge JQ 4.jpg");
        $manager->persist($produit1);

        $produit2 = new Produit();
        $produit2->setTitre("Dodge X 5");
        $produit2->setDescription("Description Dodge X 5");
        $produit2->setQuantiteEnStock(9);
        $marque2 = $manager
            ->getRepository(Marque::class)
            ->findOneBy([
                'nom' => "Marque 1"
            ]);
        $produit2->setIdMarque($marque2);
        $produit2->setPrix(35000);
        $produit2->setType("BMW");
        $produit2->setGenre("Genre 2");
        $produit2->setPhoto("Dodge X 5.jpg");
        $manager->persist($produit2);

        $produit3 = new Produit();
        $produit3->setTitre("Arona");
        $produit3->setDescription("Description Arona");
        $produit3->setQuantiteEnStock(12);
        $marque3 = $manager
            ->getRepository(Marque::class)
            ->findOneBy([
                'nom' => "Marque 3"
            ]);
        $produit3->setIdMarque($marque3);
        $produit3->setPrix(27000);
        $produit3->setType("Seat");
        $produit3->setGenre("Genre 3");
        $produit3->setPhoto("Arona.jpg");
        $manager->persist($produit3);

        $produit4 = new Produit();
        $produit4->setTitre("Ibiza");
        $produit4->setDescription("Description Ibiza");
        $produit4->setQuantiteEnStock(10);
        $produit4->setIdMarque($marque2);
        $produit4->setPrix(22500);
        $produit4->setType("Seat");
        $produit4->setGenre("Genre 3");
        $produit4->setPhoto("Ibiza.jpg");
        $manager->persist($produit4);

        $produit5 = new Produit();
        $produit5->setTitre("Audi A1");
        $produit5->setDescription("Description Audi A1");
        $produit5->setQuantiteEnStock(15);
        $marque4 = $manager
            ->getRepository(Marque::class)
            ->findOneBy([
                'nom' => "Marque 4"
            ]);
        $produit5->setIdMarque($marque4);
        $produit5->setPrix(26500);
        $produit5->setType("Audi");
        $produit5->setGenre("Genre 5");
        $produit5->setPhoto("Audi A1.jpg");
        $manager->persist($produit5);

        $manager->flush();

        // ajout client
        $client = new Client();
        $client->setNom("DOMINIQUE");
        $client->setPrenom("Jean Pierre");
        $client->setAdresse("Viry, 96007");
        $client->setTelephone("+33 1 23 45 67 89");
        $client->setEmail("jpierre@gmail.com");
        $client->setMotDePasse("motdepasse");
        $manager->persist($client);
        $manager->flush();

        // ajout administrateur
        $administrateur = new Administrateur();
        $administrateur->setPseudo("Rindra");
        $administrateur->setMotDePasse("motdepasse");
        $manager->persist($administrateur);
        $manager->flush();

    }
}
