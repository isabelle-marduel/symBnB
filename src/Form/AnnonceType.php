<?php

namespace App\Form;

use App\Entity\Ad;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AnnonceType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
                TextType::class,
                $this->getConfiguration(
                    "Titre",
                    "Tapez le titre de votre annonce"
            ))
            ->add(
                'slug',
                TextType::class,
                $this->getConfiguration(
                    "Chaîne URL",
                    "Tapez l'adresse web de votre annonce ( ou automatique)",
                    [
                        'required' => false
                    ]
            ))
            ->add(
                'coverImage',
                UrlType::class,
                $this->getConfiguration(
                    "Image principale",
                    "Donnez l'adresse URL de votre plus belle photo"
            ))
            ->add(
                'introduction',
                TextType::class,
                $this->getConfiguration(
                    "Introduction",
                    "Donnez une description rapide de l'annonce"
            ))
            ->add(
                'content',
                TextareaType::class,
                $this->getConfiguration(
                    "Contenu de l'annonce",
                    "Faites une description plus détaillée de votre annonce"
            ))
            ->add(
                'rooms',
                IntegerType::class,
                $this->getConfiguration(
                    "Nombre de chambres",
                    "Le nombre de chambres disponibles à la location"
            ))
            ->add(
                'price',
                MoneyType::class,
                $this-> getConfiguration(
                    "Prix par nuit",
                    "Indiquez le prix que vous souhaitez pour une nuit"))
            ->add(
                'images',
                CollectionType::class,
                [
                    'entry_type' => ImageType::class,
                    'allow_add' => true,
                    'allow_delete' => true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
