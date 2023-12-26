<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                "attr"=>["placeholder"=>"Email", "class"=>"w-full"],
                'required'=>false
            ])
            ->add('pseudo', TextType::class , [
                "attr"=>["placeholder"=>"Pseudo", "class"=>"w-full"],
                'required'=>false
            ])
            ->add('nom', TextType::class , [
                "attr"=>["placeholder"=>"Nom", "class"=>"mr-5"],
                'required'=>false
            ])
            ->add('prenom', TextType::class , [
                "attr"=>["placeholder"=>"Prénom"],
                'required'=>false
            ])
            ->add('adresse', TextType::class , [
                "attr"=>["placeholder"=>"Adresse", "class"=>"mr-5"],
                'required'=>false
            ])
            ->add('adresse_2', TextType::class , [
                "attr"=>["placeholder"=>"Complément adresse"],
                'required'=>false
            ])
            ->add('postal_code', NumberType::class, [
                "attr"=>["placeholder"=>"Code postal", "class"=>"mr-5"],
                'required'=>false
            ])
            ->add('ville', TextType::class , [
                "attr"=>["placeholder"=>"Ville"],
                'required'=>false
            ])
            ->add('agreeTerms', CheckboxType::class, [
                                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'first_options'  => ['attr' => ['placeholder' => 'Mot de passe', "class"=>"mr-5", 'autocomplete' => 'new-password']],
                'second_options' =>['attr' => ['placeholder' => 'Répéter mot de passe', 'autocomplete' => 'new-password']],
                'mapped' => false,
                'required'=>false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Ce champs ne peut être vide.',
                    ]),
                    new Length(min: 5,
                    minMessage: "Le mot de passe doit contenir {{ limit }} caractères !",
                    max: 4096)
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
