<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    #[Route("/pokemon/{id}", name: "getpokemon")]
    public function getPokemon(EntityManagerInterface $doctrine, $id)    //Devuleve resultado de renderizar plantilla twig
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);

        return $this->render("pokemons/getpokemon.html.twig", ["pokemon" => $pokemon]);
    }

    #[Route("/allpokemon", name: "getAllpokemon")]
    public function getAllPokemon(EntityManagerInterface $doctrine)    //Devuleve resultado de renderizar plantilla twig
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $allpokemon = $repository->findAll();

        return $this->render("pokemons/getallpokemon.html.twig", ["allpokemon" => $allpokemon]);
    }
    #[Route("/insert/pokemon")]
    public function insertpokemons(EntityManagerInterface $doctrine)
    {
        $pokemon = new Pokemon();
        $pokemon->setNombre("Emolga");
        $pokemon->setDescripcion("Planea por el aire, casi como si danzara");
        $pokemon->setImagen("https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/587.png");
        $pokemon->setCodigo(587);

        $doctrine->persist($pokemon);


        $pokemon2 = new Pokemon();
        $pokemon2->setNombre("Pikachu");
        $pokemon2->setDescripcion("Planea por el aire, casi como si danzara");
        $pokemon2->setImagen("https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/125.png");
        $pokemon2->setCodigo(587);

        $doctrine->persist($pokemon2);


        $pokemon3 = new Pokemon();
        $pokemon3->setNombre("Charmander");
        $pokemon3->setDescripcion("Planea por el aire, casi como si danzara");
        $pokemon3->setImagen("https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/666.png");
        $pokemon3->setCodigo(587);

        $doctrine->persist($pokemon3);
        $doctrine->flush();
        return new Response("Pokemons insertados");
    }
}
