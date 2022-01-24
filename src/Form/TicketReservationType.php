<?php

namespace App\Form;

use App\Entity\Ticket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class TicketReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity', IntegerType::class, array(
                'label' => 'Quantité',
                'mapped' => false,
                'attr' => array('value' => 1, 'min' => 1, 'max' => 50)
            ))
            ->add('promoCode', TextType::class, [
                'label' => 'Code promo'
            ])
            ->add('ticketType', CheckboxType::class, array(
                'label' => 'Catégorie 1'
            ))
        ;
        $builder->get('promoCode')->setRequired(false);
        $builder->get('ticketType')->setRequired(false);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ticket::class,
        ]);
    }
}
