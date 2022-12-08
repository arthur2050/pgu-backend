<?php


namespace App\Form\Type;


use App\DataTransformer\StringToArrayTransformer;
use App\Entity\Lecturer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class LecturerCreateFormType extends AbstractType
{
    private $stringToArrayTransformer;

    public function __construct(StringToArrayTransformer $stringToArrayTransformer)
    {
        $this->stringToArrayTransformer = $stringToArrayTransformer;
    }

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
                'mapped' => false
            ])
            ->add('surname', TextType::class, [
                'mapped' => false
            ])
            ->add('patronymic', TextType::class, [
                'mapped' => false
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email()
                ],
                'mapped' => false
            ])
            ->add('password', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 6,
                        'max' => 30
                    ])
                ],
                'mapped' => false
            ])
            ->add('phone', TextType::class, [
                'mapped' => false
            ])
            ->add('avatarPath', TextType::class, [
                'mapped' => false
            ])
            ->add('slug', TextType::class)
            ->add('position', TextType::class)
            ->add('card_image', TextType::class)
            ->add('professionalInterests', TextType::class)
            ->add('publicationsCount', IntegerType::class, [
                'required' => false,
            ])
            ->add('projectsCount', IntegerType::class, [
                'required' => false,
            ])
            ->add('conferencesCount', IntegerType::class, [
                'required' => false,
            ])
            ->add('diplomaProjectsCount', IntegerType::class, [
                'required' => false,
            ])
            ->add('roles', TextType::class, [
                'mapped' => false,
                'property_path' => 'user.roles'
            ])
        ;

        $builder->get('roles')->addModelTransformer($this->stringToArrayTransformer);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lecturer::class,
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }


}
