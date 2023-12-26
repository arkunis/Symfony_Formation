<?php

namespace App\Form;

use App\Entity\CompteRegister;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom_url', TextType::class, [
                "attr"=>["placeholder"=>"Nom ou url du site"]
            ])
            ->add('identifiant', TextType::class, [
                "attr"=>["placeholder"=>"Identifiant de connexion"]
            ])
            ->add('plainPassword', PasswordType::class, [
                "attr"=>["placeholder"=>"Mot de passe"],
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompteRegister::class,
        ]);
    }
}
