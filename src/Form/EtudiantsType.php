<?php

namespace App\Form;

use App\Entity\Matieres;
use App\Entity\Etudiants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class EtudiantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_ins',TextType::class,[
                'label'=>'Code Inscrit',
                'attr'=>[
                    'placeholder'=>'Le Code de Etudiant ',
                    'class'=>'form-control'
                ]
            ])
            ->add('nom',TextType::class,[
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=>'Nom de Etudiant ',
                    'class'=>'form-control'
                ]
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prénom',
                'attr'=>[
                    'placeholder'=>'Prénom de Etudiant ',
                    'class'=>'form-control'
                ]
            ])
            ->add('cin',NumberType::class,[
                'label'=>'Carte identité nationale',
                'attr'=>[
                    'placeholder'=>'CIN de Etudiant ',
                    'class'=>'form-control',
            ]])
            ->add('email',TextType::class,[
                'label'=>'Émail',
                'attr'=>[
                    'placeholder'=>'Émail de Etudiant ',
                    'class'=>'form-control'
                ]
            ])
            ->add('mdp',PasswordType::class,[
                'label'=>'Mot de passe',
                'attr'=>[
                    'placeholder'=>'Mot de passe de Etudiant ',
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiants::class,
        ]);
    }
}
