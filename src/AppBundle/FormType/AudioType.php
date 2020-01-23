<?php
/**
 * Created by PhpStorm.
 * User: ranji
 * Date: 22/01/2020
 * Time: 09:57
 */

namespace AppBundle\FormType;

use AppBundle\Entity\AudioSheet;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AudioType extends SheetType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foo', SheetType::class, ['data_class' => AudioSheet::class, 'label' => ' '])
            ->add('genre', TextType::class, array('label' => 'Type :'))
            ->add('artist', TextType::class, array('label' => 'Artiste :'))
            ->add('duration', TextType::class, array('label' => 'Durée :'))
            ->add('idcategory', HiddenType::class, array('attr' => array('value' => 1)));
    }
}