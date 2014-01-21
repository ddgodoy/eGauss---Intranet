<?php

/**
 * TypeInformation
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    egauss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class TypeInformation extends BaseTypeInformation
{
    /**
     * get array for select
     * @return array
     */
    public static function getArrayForSelect()
    {
        $object = TypeInformationTable::getInstance()->findAll();
        $array = [''=>'-- seleccionar --'];
        
        foreach ($object AS $v){
            $array[$v->getId()] = $v->getName();
        }
        
        return $array;
    }        
}