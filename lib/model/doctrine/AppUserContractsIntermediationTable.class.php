<?php

/**
 * AppUserContractsIntermediationTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AppUserContractsIntermediationTable extends Doctrine_Table
{
    /**
     * Returns an instance of this class.
     *
     * @return object AppUserContractsIntermediationTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('AppUserContractsIntermediation');
    }
    
    /**
     * Get array of all for select tag
     * @param string $id 
     * @return array
     */
    public function getAllForSelectContactAssociated($id)
    {
           $arr_options = array();
           
           $q = Doctrine_Query::create()
                   ->select('ac.*, au.id AS id, au.name AS name, au.last_name AS last_name, ur.name AS rol')
                   ->from('AppUserContractsIntermediation ac')
                   ->leftJoin('ac.AppUser au')
                   ->leftJoin('au.UserRole ur')
                   ->where('ac.contracts_intermediation_id = ?', $id)
                   ->orderBy('id');
           
           $d = $q->fetchArray();

           foreach ($d as $value) {
                   $arr_options[$value['id']] = $value['name'].' '.$value['last_name'].' ('.$value['rol'].')';
           }
           return $arr_options;
    }
    
    /**
     * delete customer not in contract
     * @param string $array_user
     * @param int $contract_id
     * @return delete
     */
    public function deleteCustomerNotInContract($array_user, $contract_id)
    {
        $q = $this->createQuery()
             ->where('contracts_intermediation_id = ?', $contract_id)
             ->andWhere('app_user_id NOT IN '.$array_user )
             ->delete();
        
        return $q->execute();
    } 
}