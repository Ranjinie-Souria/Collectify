<?php
/**
 * Created by PhpStorm.
 * User: ranji
 * Date: 22/01/2020
 * Time: 09:57
 */

namespace AppBundle\FormType;

use AppBundle\Entity\VideoSheet;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class VideoType extends SheetType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('foo', SheetType::class, ['data_class' => VideoSheet::class,
                'label' => ' '])
            ->add('type', TextType::class, array('label' => 'Type :'))
            ->add('creator', TextType::class, array('label' => 'Créateur :'))
            ->add('idcategory', HiddenType::class, array('attr' => array('value' => 2)));
    }
}