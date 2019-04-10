<?php

namespace Disjfa\MozaicBundle\Form\Type;

use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class AdminDateType.
 */
class AdminDateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateType::class, [
            'data' => new DateTime(),
            'format' => 'yyyyMMdd',
            'days' => [1],
        ]);
    }
}
