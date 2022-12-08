<?php


namespace App\DataTransformer;


use Symfony\Component\Form\DataTransformerInterface;

class StringToArrayTransformer implements DataTransformerInterface
{

    public function transform($value)
    {
        return $value;
    }

    public function reverseTransform($value)
    {
        $ar = explode(',', $value);
        return $ar;
    }
}
