<?php

namespace App\Form;

use App\Entity\Matieres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class MatieresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code_mat',IntegerType::class,[
                'label'=>'Code Matiere',
                'attr'=>[
                    'placeholder'=>'Code matière ',
                    'class'=>'form-control',
            ]
            ])
            ->add('designation',TextType::class,[
                'label'=>'Designation',
                'attr'=>[
                    'placeholder'=>'Designation matière',
                    'class'=>'form-control',
            ]
            ])
            ->add('coefficient',NumberType::class,[
                'label'=>'Coefficient',
                'attr'=>[
                    'placeholder'=>'Coefficient matière',
                    'class'=>'form-control',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Matieres::class,
        ]);
    }
}
