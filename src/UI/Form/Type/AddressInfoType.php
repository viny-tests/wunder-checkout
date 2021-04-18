<?php
declare(strict_types=1);

namespace App\UI\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class AddressInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('customerId', HiddenType::class)
            ->add('street', TextType::class)
            ->add('houseNumber', TextType::class)
            ->add('zipCode', TextType::class)
            ->add('city', TextType::class)
            ->add('next', SubmitType::class);
    }
}
