<?php

namespace Application\Sonata\UserBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

//use Symfony\Component\Form\Exception\TransformationFailedException;
//use Symfony\Component\Form\Extension\Core\ObjectChoiceList;
//use Doctrine\Common\Persistence\ObjectManager;
//use Application\Sonata\UserBundle\Entity\PermisoUser;

class PermisosCategoriaUserTransformer implements DataTransformerInterface {
    /*
     * 
     */

    public function transform($array) {
//        if (null === $array) {
//            return '';
//        }
//        if (!is_array($array)) {
//            throw new TransformationFailedException('Expected an array.');
//        }
//        foreach ($array as &$value) {
//            $value = sprintf('%s%s%s');
//        }
//        $string = trim(implode($array));
//        return $string;
    }

    /*
     * 
     */

    public function reverseTransform($entero) {
//        if (null !== $string && !is_string($string)) {
//            throw new TransformationFailedException('Expected a string.');
//        }
//        $string = trim($string);
//        if (empty($string)) {
//            return array();
//        }
//        $values = explode($string);
//        if (0 === count($values)) {
//            return array();
//        }
//        foreach ($values as &$value) {
//            $value = trim($value);
//        }
//        return $values;
    }

}
