<?php

/**
 * ProductRegisteredCompanies
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    egauss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class ProductRegisteredCompanies extends BaseProductRegisteredCompanies
{
    /**
     * set new product in company
     * @param int $company_id
     * @param object company $recorded
     * @return boolean 
     */
    public static function setProductInCompany($company_id, $product_id)
    {
        $product_registered_companies = New ProductRegisteredCompanies();
        $product_registered_companies->setRegisteredCompaniesId($company_id);
        $product_registered_companies->setProductsId($product_id);
        $product_registered_companies->save();
    }  
    
    /**
     * getArrayForSelectByCompany
     * @param type $company
     */
    public static function getArrayForSelectByCompany($company)
    {
        $array = array();
        $product = ProductRegisteredCompaniesTable::getInstance()->getProductsInCompnay($company);
        
        foreach($product as $v)
        {
            $array[$v->getId()] = $v->getProducts()->getName().' - ('.$v->getRegisteredCompanies()->getName().')';
        }  
        
        return $array;
    }        
}
