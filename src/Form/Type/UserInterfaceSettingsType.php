<?php


namespace App\Form\Type;


use App\Entity\UserInterfaceSettings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class UserInterfaceSettingsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('colorFilters', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ]
            ])
            ->add('colorBackground', IntegerType::class, [
                'constraints' => [
                    new NotBlank()
                ]
            ])
            ->add('darkMode', CheckboxType::class, [
                'false_values' => [
                  '0', 'false'
                ],
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('sidebarMini', CheckboxType::class, [
                'false_values' => [
                    '0', 'false'
                ],
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('sidebarImage', CheckboxType::class, [
                'false_values' => [
                    '0', 'false'
                ],
                'constraints' => [
                    new NotNull(),
                ]
            ])
            ->add('selectedImage', IntegerType::class, [
                'required' => false,
            ])
;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserInterfaceSettings::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}