<?php

/**
 * TypeCompanies
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    egauss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class TypeCompanies extends BaseTypeCompanies
{
    /**
     * get array for select
     * @param object $object
     * @return array
     */
    public static function getArrayForSelect($object)
    {
        $array = [];
        
        foreach ($object AS $v){
            $array[$v->getId()] = $v->getName();
        }
        
        return $array;
    }        
}