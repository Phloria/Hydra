<?php
/**
 * Created by PhpStorm.
 * User: Tu Justin
 * Date: 02/02/2019
 * Time: 22:03
 */

namespace App\Form;


use App\Entity\Video;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VideoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('description', TextType::class)
            ->add('url', TextType::class)
            ->add('category', TextType::class)
            ->add('gender',ChoiceType::class, [
                'choices'  => [
                    '--' => 'Unknown',
                    'Man' => 'Man',
                    'Woman' => 'Woman',
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