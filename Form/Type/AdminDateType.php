<?php

namespace Disjfa\MozaicBundle\Form\Type;

use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;

class AdminDateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateType::class, [
            'data' => new DateTime(),
            'format' => 'yyyyMMdd',
            'days'            => array(1),
        ]);
    }
}