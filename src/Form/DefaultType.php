<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('type', ChoiceType::class, array(
                'choices'  => array(
                    'Repositórios' => 'repositorios',
                    'Códigos'      => 'codigos',
                    'Issues'       => 'issues',
                    'Usuários'     => 'usuarios',
                    'Commits'      => 'commits',
                ),
                'placeholder'  => 'Pesquisar por...',
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
