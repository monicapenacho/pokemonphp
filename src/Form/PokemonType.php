<?php

namespace App\Form;

use App\Entity\Debilidad;
use App\Entity\Pokemon;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PokemonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, ["attr" => ["placeholder" => "introduce el nombre del pokemon"]])
            ->add('descripcion', TextareaType::class, ["label" => "Descripción"])
            ->add('imagen')
            ->add('codigo', NumberType::class, ["label" => "Código"])
            ->add('debilidades', EntityType::class, [
                'class' => Debilidad::class,              //clase con la que está relacionada
                'choice_label' => 'nombre',             //Campo de la clase Debilidad que lo representa
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('enviar', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pokemon::class,
        ]);
    }
}
