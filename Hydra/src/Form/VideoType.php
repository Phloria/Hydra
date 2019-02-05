<?php
/**
 * Created by PhpStorm.
 * User: Tu Justin
 * Date: 02/02/2019
 * Time: 22:03
 */

namespace App\Form;


use App\Entity\Category;
use App\Entity\Game;
use App\Entity\Video;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('urlId', TextType::class)
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => function ($game) {
                    return $game->getShortName();
                }
            ])
            ->add('type',ChoiceType::class, [
                'choices'  => [
                    'Youtube' => 'Youtube',
                    'Twitch' => 'Twitch',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}