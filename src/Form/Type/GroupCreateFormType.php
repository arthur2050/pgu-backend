<?php


namespace App\Form\Type;


use App\Entity\Group;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class GroupCreateFormType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('curator', TextType::class, [
                'mapped' => false
            ])
            ->add('headman', IntegerType::class, [
                'mapped' => false
            ])
            ->add('direction', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'mapped' => false
            ])
            ->add('studyVariant', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'mapped' => false
            ])
            ->add('students', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'mapped' => false
            ])
            ->add('timeTable', IntegerType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'mapped' => false
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Group::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }

}
