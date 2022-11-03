<?php


namespace App\Utils;


class LecturerStringUtils implements StringUtilsInterface
{
    public const FULL_NAME = [
        1 => 'name',
        0 => 'surname',
        2 => 'patronymic',
    ];

    public static function fullName(string $value)
    {
        $fullNameValues = self::FULL_NAME;

        $data = explode(' ', trim($value));

        if(count($data) > 4) throw new \HttpException('Array with lecturer"s full name can"t be more than 3 items' , 400);

        foreach ($data as $orderValue => $value) {
            $fullNameValues[$orderValue] = $value;
        }

        return array_combine(self::FULL_NAME, $fullNameValues);
    }
}
