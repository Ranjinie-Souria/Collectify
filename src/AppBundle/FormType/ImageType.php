<?php
/**
 * Created by PhpStorm.
 * User: ranji
 * Date: 22/01/2020
 * Time: 09:57
 */

namespace AppBundle\FormType;


use AppBundle\Entity\ImageSheet;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ImageType extends SheetType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foo', SheetType::class, ['data_class' => ImageSheet::class,
                'label' => ' '])
            ->add('author', TextType::class, array('label' => 'Auteur :'))
            ->add('idcategory', HiddenType::class, array('attr' => array('value' => 3)));
    }
}