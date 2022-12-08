<?php


namespace App\Repository;


use Doctrine\ORM\EntityManagerInterface;

class LazyLoadingRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getEntityFieldsByNames(array $fields, $class)
    {
//        $builder = $this->em->createQueryBuilder();
//        $arrayFields = null;
//
//
//
//        foreach ($fields[0] as $field) {
//            $arrayFields[] = "entity.$field";
//        }
//        $builder->select($arrayFields)
//        ->from("$class", 'entity');
//
//        foreach ($fields[1] as $classField) {
//            $field = 'entity.'.$classField;
//            $alias = $classField.'Alias';
//            $builder->addSelect($alias);
//            $builder->leftJoin($field,$alias);
//        }
//
//
//
//
//
//
//   //     $arrayFields[count($arrayFields) - 1] = str_replace(',', '', $arrayFields[count($arrayFields) - 1]);
////        $arrayFields = implode(',entity.', $fields);
//
//
//        return $builder
//        ->getQuery()
//        ->getResult();
    }

}
