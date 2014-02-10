<?php

/**
 * BaseInvestor
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $name
 * @property decimal $amount
 * @property string $phone
 * @property string $website
 * @property string $address
 * @property string $business
 * @property integer $year
 * @property integer $estado
 * @property integer $registered_companies_id
 * @property RegisteredCompanies $RegisteredCompanies
 * 
 * @method integer             getId()                      Returns the current record's "id" value
 * @method string              getName()                    Returns the current record's "name" value
 * @method decimal             getAmount()                  Returns the current record's "amount" value
 * @method string              getPhone()                   Returns the current record's "phone" value
 * @method string              getWebsite()                 Returns the current record's "website" value
 * @method string              getAddress()                 Returns the current record's "address" value
 * @method string              getBusiness()                Returns the current record's "business" value
 * @method integer             getYear()                    Returns the current record's "year" value
 * @method integer             getEstado()                  Returns the current record's "estado" value
 * @method integer             getRegisteredCompaniesId()   Returns the current record's "registered_companies_id" value
 * @method RegisteredCompanies getRegisteredCompanies()     Returns the current record's "RegisteredCompanies" value
 * @method Investor            setId()                      Sets the current record's "id" value
 * @method Investor            setName()                    Sets the current record's "name" value
 * @method Investor            setAmount()                  Sets the current record's "amount" value
 * @method Investor            setPhone()                   Sets the current record's "phone" value
 * @method Investor            setWebsite()                 Sets the current record's "website" value
 * @method Investor            setAddress()                 Sets the current record's "address" value
 * @method Investor            setBusiness()                Sets the current record's "business" value
 * @method Investor            setYear()                    Sets the current record's "year" value
 * @method Investor            setEstado()                  Sets the current record's "estado" value
 * @method Investor            setRegisteredCompaniesId()   Sets the current record's "registered_companies_id" value
 * @method Investor            setRegisteredCompanies()     Sets the current record's "RegisteredCompanies" value
 * 
 * @package    egauss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseInvestor extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('investor');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('name', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('amount', 'decimal', 10, array(
             'type' => 'decimal',
             'scale' => 2,
             'default' => 0,
             'length' => 10,
             ));
        $this->hasColumn('phone', 'string', 50, array(
             'type' => 'string',
             'length' => 50,
             ));
        $this->hasColumn('website', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('address', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             ));
        $this->hasColumn('business', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('year', 'integer', 8, array(
             'type' => 'integer',
             'length' => 8,
             ));
        $this->hasColumn('estado', 'integer', 30, array(
             'type' => 'integer',
             'length' => 30,
             ));
        $this->hasColumn('registered_companies_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));

        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('RegisteredCompanies', array(
             'local' => 'registered_companies_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}