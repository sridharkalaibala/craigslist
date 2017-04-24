<?php
namespace CloneBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use CloneBundle\Document\Feed;


class FeedType extends AbstractType
{
    function __construct($locations = null, $categories = null)
    {
        $this->locations = $locations;
        $this->categories = $categories;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('title', 'text');
        $builder->add('location', 'choice', [
            'required' => true,
            'choices' => array_combine($this->locations, $this->locations),
        ]);
        $sub_values = [];
        $main_keys = array_keys($this->categories);
        foreach ($this->categories as $value) {
            $sub_values =  array_merge($sub_values,$value);
        }

        $builder->add('main_category', 'choice', [
            'required' => true,
            'choices' => array_combine($main_keys, $main_keys),

        ]);
        $builder->add('sub_category', 'choice', [
            'required' => true,
            'choices' => [array_combine($sub_values, $sub_values)]
        ]);
        $builder->add('details', 'textarea',['required' => true]);
        $builder->add('email', 'email',['required' => true]);
        $builder->add('contact', 'text',['required' => true]);


    }

    public function getDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Feed::class
        ));
    }

    public function getName()
    {
        return 'feed';
    }
}
