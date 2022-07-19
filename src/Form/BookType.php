<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('nbPages')
            ->add('author',EntityType::class,
                [
                    "class"=> Author::class,
                    "choice_label"=> function ($author)
                    {
                        return $author->getlastName() . " " . $author->getfirstName();
                    },
                    "placeholder"=>"Nom de l'auteur"
                ])
            ->add('publishedAt', )
            ->add('publishedAt', DateType::class,
                [
                'widget' => 'single_text',
                'years' => range(date('Y'), date('Y')-300),
                'months' => range(date('m'), 12),
                'days' => range(date('d'),31)
                 ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
