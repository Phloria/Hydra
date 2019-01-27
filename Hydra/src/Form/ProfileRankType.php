<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileRankType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('csgoActualRank',ChoiceType::class, [
                'choices'  => [
                    'Never Played' => 0,
                    'Unranked' => 1,
                    'Silver 1' => 2,
                    'Silver 2' => 3,
                ],
            ])
            ->add('csgoBestRank',ChoiceType::class, [
                'choices'  => [
                    'Never Played' => 0,
                    'Silver 1' => 2,
                    'Silver 2' => 3,
                ],
            ])
            ->add('owActualRank',ChoiceType::class, [
                'choices'  => [
                    'Never Played' => 0,
                    'Unranked' => 1,
                    'Bronze' => 2,
                    'Silver' => 3,
                ],
            ])
            ->add('owBestRank',ChoiceType::class, [
                'choices'  => [
                    'Never Played' => 0,
                    'Bronze' => 2,
                    'Silver' => 3,
                ],
            ])
            ->add('pubgLink',TextType::class, array('required'   => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
