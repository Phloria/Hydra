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
                    '-----' => 0,
                    'Never Played' => 1,
                    'Unranked' => 2,
                    'Silver 1' => 3,
                    'Silver 2' => 4,
                    'Silver 3' => 5,
                    'Silver 4' => 6,
                    'Silver Silver Elite' => 7,
                    'Silver Elite Master' => 8,
                    'Nova 1' => 9,
                    'Nova 2' => 10,
                    'Nova 3' => 11,
                    'Nova Master' => 12,
                    'Master Guardian' => 13,
                    'Master Guardian 2' => 14,
                    'Master Guardian Elite' => 15,
                    'Distinguished Master Guardian' => 16,
                    'Legendary Eagle' => 17,
                    'Legendary Eagle Master' => 18,
                    'Supreme Master First Class' => 19,
                    'The Global Elite' => 20
                ],
            ])
            ->add('csgoBestRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'None' => 2,
                    'Silver 1' => 3,
                    'Silver 2' => 4,
                    'Silver 3' => 5,
                    'Silver 4' => 6,
                    'Silver Silver Elite' => 7,
                    'Silver Elite Master' => 8,
                    'Nova 1' => 9,
                    'Nova 2' => 10,
                    'Nova 3' => 11,
                    'Nova Master' => 12,
                    'Master Guardian' => 13,
                    'Master Guardian 2' => 14,
                    'Master Guardian Elite' => 15,
                    'Distinguished Master Guardian' => 16,
                    'Legendary Eagle' => 17,
                    'Legendary Eagle Master' => 18,
                    'Supreme Master First Class' => 19,
                    'The Global Elite' => 20
                ],
            ])
            ->add('owActualRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'Never Played' => 1,
                    'Unranked' => 2,
                    'Bronze' => 3,
                    'Silver' => 4,
                    'Gold' => 5,
                    'Platinum' => 6,
                    'Diamond' => 7,
                    'Master' => 8,
                    'GrandMaster' => 9,
                    'Top 500' => 10
                ],
            ])
            ->add('owBestRank',ChoiceType::class, [
                'choices'  => [
                    '-----' => 0,
                    'None' => 2,
                    'Bronze' => 3,
                    'Silver' => 4,
                    'Gold' => 5,
                    'Platinum' => 6,
                    'Diamond' => 7,
                    'Master' => 8,
                    'GrandMaster' => 9,
                    'Top 500' => 10
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
