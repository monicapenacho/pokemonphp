<?php

namespace App\Controller;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use App\Form\PokemonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

        $debilidad = new Debilidad();
        $debilidad->setNombre("fuego");
        $debilidad2 = new Debilidad();
        $debilidad2->setNombre("electrico");
        $debilidad3 = new Debilidad();
        $debilidad3->setNombre("agua");

        $pokemon->addDebilidade($debilidad);
        $pokemon2->addDebilidade($debilidad3);
        $pokemon2->addDebilidade($debilidad2);
        $pokemon3->addDebilidade($debilidad2);

        $doctrine->persist($debilidad);
        $doctrine->persist($debilidad2);
        $doctrine->persist($debilidad3);
        $doctrine->flush();
        return new Response("Pokemons insertados");
    }

    #[Route("/new/pokemon", name: "newPokemon")]
    public function newpokemon(EntityManagerInterface $doctrine, Request $request)
    {
        $form = $this->createForm(PokemonType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this->addFlash("éxito", "Pokemon insertado correctamente :)");
            return $this->redirectToRoute("getpokemon", ["id" => $pokemon->getId()]);
        }
        return $this->renderForm("pokemons/newpokemon.html.twig", ["pokemonForm" => $form]);
    }
    #[Route("/edit/pokemon/{id}", name: "editPokemon")]
    public function editpokemon($id, EntityManagerInterface $doctrine, Request $request)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);
        $form = $this->createForm(PokemonType::class, $pokemon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pokemon = $form->getData();
            $doctrine->persist($pokemon);
            $doctrine->flush();
            $this->addFlash("éxito", "Pokemon insertado correctamente :)");
            return $this->redirectToRoute("getpokemon", ["id" => $pokemon->getId()]);
        }
        return $this->renderForm("pokemons/newpokemon.html.twig", ["pokemonForm" => $form]);
    }
    #[Route("/delete/pokemon/{id}", name: "deletePokemon")]
    public function deletepokemon($id, EntityManagerInterface $doctrine, Request $request)
    {
        $repository = $doctrine->getRepository(Pokemon::class);
        $pokemon = $repository->find($id);
        $doctrine->remove($pokemon);
        $doctrine->flush();
        return $this->redirectToRoute("getAllpokemon");
    }
}
