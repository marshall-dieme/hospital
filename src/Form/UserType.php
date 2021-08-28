<?php

namespace App\Form;

use App\Entity\Profil;
use App\Entity\Specialite;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Nom d\'utilisateur',
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('profil', EntityType::class, [
                'class' => Profil::class,
                'choice_label' => 'libelle',
                'label' => 'Type de compte',
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('specialiteMedecin', EntityType::class, [
                'class' => Specialite::class,
                'choice_label' => 'nomSpecialite',
                'row_attr' => ['class' => 'form-group', 'hidden' => true, 'id' => 'specialite_div'],
                'attr' => ['class' => 'form-control']
            ])
            // ->add('roles')
            // ->add('password')
            ->add('nom', TextType::class, [
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('prenom', TextType::class, [
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('telephone', TextType::class, [
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateNaissance', DateType::class, [
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control'],
                'widget' => 'single_text'
            ])
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Choisir' => true,
                    'Masculin' => false,
                    'Feminin' => false
                ],
                'label' => 'Genre',
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('adresse', TextareaType::class, [
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('situationFamiliale', TextType::class, [
                'label' => 'Situation Matrimoniale',
                'required' => true,
                'row_attr' => ['class' => 'form-group'],
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
