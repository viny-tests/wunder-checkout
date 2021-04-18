<?php
declare(strict_types=1);

namespace App\UI\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonalInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('telephone', TextType::class)
            ->add('next', SubmitType::class);
    }
}
