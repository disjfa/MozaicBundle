<?php

namespace Disjfa\MozaicBundle\Form\Type;

use DateTime;
use Disjfa\MozaicBundle\Entity\UnsplashSeason;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class AdminSeasonType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, [
            'label' => 'form.admin.season.label.title',
            'constraints' => new NotBlank(),
        ]);

        $builder->add('description', TextareaType::class, [
            'label' => 'form.admin.season.label.description',
            'required' => false,
        ]);

        $builder->add('dateSeason', DateTimeType::class, [
            'label' => 'form.admin.season.label.description',
            'empty_data' => new DateTime()
        ]);

        $builder->add('public', CheckboxType::class, [
            'label' => 'form.admin.season.label.public',
            'required' => false,
        ]);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UnsplashSeason::class,
            'translation_domain' => 'mozaic',
        ]);
    }
}