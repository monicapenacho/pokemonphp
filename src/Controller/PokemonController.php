<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PokemonController extends AbstractController
{
    #[Route("/pokemon")]
    public function getPokemon()    //Devuleve resultado de renderizar plantilla twig
    {
        $pokemon = [
            "nombre" => "Emolga",
            "descripcion" => "Planea por el aire, casi como si danzara, mientras desprende electricidad. Resulta adorable, pero puede causar bastantes problemas.",
            "imagen" => "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/587.png",
            "codigo" => 587,
        ];

        return $this->render("pokemons/getpokemon.html.twig", ["pokemon" => $pokemon]);
    }

    #[Route("/allpokemon")]
    public function getAllPokemon()    //Devuleve resultado de renderizar plantilla twig
    {
        $allpokemon = [
            [
                "nombre" => "Emolga",
                "descripcion" => "Planea por el aire, casi como si danzara, mientras desprende electricidad. Resulta adorable, pero puede causar bastantes problemas.",
                "imagen" => "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/587.png",
                "codigo" => 587,
            ],
            [
                "nombre" => "Pikachu",
                "descripcion" => "Planea por el aire, casi como si danzara, mientras desprende electricidad. Resulta adorable, pero puede causar bastantes problemas.",
                "imagen" => "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/125.png",
                "codigo" => 587,
            ],
            [
                "nombre" => "Bulbasur",
                "descripcion" => "Planea por el aire, casi como si danzara, mientras desprende electricidad. Resulta adorable, pero puede causar bastantes problemas.",
                "imagen" => "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/345.png",
                "codigo" => 587,
            ],
            [
                "nombre" => "Charmander",
                "descripcion" => "Planea por el aire, casi como si danzara, mientras desprende electricidad. Resulta adorable, pero puede causar bastantes problemas.",
                "imagen" => "https://www.pokemon.com/static-assets/content-assets/cms2/img/pokedex/full/666.png",
                "codigo" => 587,
            ]
        ];

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
