<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
