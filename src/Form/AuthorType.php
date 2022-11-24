<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'required' => true,

            ])
            ->add('lastName', TextType::class,[
                'required' => true
            ])
            ->add('nationality', TextType::class, [
                'required' => true
            ])
            ->add('wikiPage', TextType::class, [
                "required" => true
            ])
//            ->add('books', CollectionType::class, [
//                "empty_data" => null
//                //                "required" => false
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
//            'data_class' => null,
        ]);
    }
}
