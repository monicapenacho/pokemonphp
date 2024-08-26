<?php

namespace App\Controller;

use App\Form\PokemonType;
use App\Form\UsuarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route("/new/usuario", name: "newUsuario")]
    public function newusuario(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(UsuarioType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();

            $oldPassword = $user->getPassword();
            $newPassword = $hasher->hashPassword($user, $oldPassword);
            $user->setPassword($newPassword);

            $doctrine->persist($user);
            $doctrine->flush();
            $this->addFlash("éxito", "Usuario insertado correctamente :)");
            return $this->redirectToRoute("getAllpokemon");
        }
        return $this->renderForm("pokemons/newpokemon.html.twig", ["pokemonForm" => $form]);
    }

    #[Route("/new/admin", name: "newAdmin")]
    public function newadmin(EntityManagerInterface $doctrine, Request $request, UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(UsuarioType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setRoles(["ROLE_ADMIN", "ROLE_USER"]);

            $oldPassword = $user->getPassword();
            $newPassword = $hasher->hashPassword($user, $oldPassword);
            $user->setPassword($newPassword);

            $doctrine->persist($user);
            $doctrine->flush();
            $this->addFlash("éxito", "Usuario insertado correctamente :)");
            return $this->redirectToRoute("getAllpokemon");
        }
        return $this->renderForm("pokemons/newpokemon.html.twig", ["pokemonForm" => $form]);
    }
}