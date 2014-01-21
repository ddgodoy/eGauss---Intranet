<?php

/**
 * BaseCalendar
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $app_user_id
 * @property integer $year
 * @property integer $month
 * @property integer $day
 * @property string $hour_from
 * @property string $hour_to
 * @property text $subject
 * @property text $body
 * @property integer $type_calendar_id
 * @property integer $registered_companies_id
 * @property boolean $next
 * @property AppUser $AppUser
 * @property RegisteredCompanies $RegisteredCompanies
 * @property TypeCalendar $TypeCalendar
 * @property Doctrine_Collection $Calendar
 * 
 * @method integer             getId()                      Returns the current record's "id" value
 * @method integer             getAppUserId()               Returns the current record's "app_user_id" value
 * @method integer             getYear()                    Returns the current record's "year" value
 * @method integer             getMonth()                   Returns the current record's "month" value
 * @method integer             getDay()                     Returns the current record's "day" value
 * @method string              getHourFrom()                Returns the current record's "hour_from" value
 * @method string              getHourTo()                  Returns the current record's "hour_to" value
 * @method text                getSubject()                 Returns the current record's "subject" value
 * @method text                getBody()                    Returns the current record's "body" value
 * @method integer             getTypeCalendarId()          Returns the current record's "type_calendar_id" value
 * @method integer             getRegisteredCompaniesId()   Returns the current record's "registered_companies_id" value
 * @method boolean             getNext()                    Returns the current record's "next" value
 * @method AppUser             getAppUser()                 Returns the current record's "AppUser" value
 * @method RegisteredCompanies getRegisteredCompanies()     Returns the current record's "RegisteredCompanies" value
 * @method TypeCalendar        getTypeCalendar()            Returns the current record's "TypeCalendar" value
 * @method Doctrine_Collection getCalendar()                Returns the current record's "Calendar" collection
 * @method Calendar            setId()                      Sets the current record's "id" value
 * @method Calendar            setAppUserId()               Sets the current record's "app_user_id" value
 * @method Calendar            setYear()                    Sets the current record's "year" value
 * @method Calendar            setMonth()                   Sets the current record's "month" value
 * @method Calendar            setDay()                     Sets the current record's "day" value
 * @method Calendar            setHourFrom()                Sets the current record's "hour_from" value
 * @method Calendar            setHourTo()                  Sets the current record's "hour_to" value
 * @method Calendar            setSubject()                 Sets the current record's "subject" value
 * @method Calendar            setBody()                    Sets the current record's "body" value
 * @method Calendar            setTypeCalendarId()          Sets the current record's "type_calendar_id" value
 * @method Calendar            setRegisteredCompaniesId()   Sets the current record's "registered_companies_id" value
 * @method Calendar            setNext()                    Sets the current record's "next" value
 * @method Calendar            setAppUser()                 Sets the current record's "AppUser" value
 * @method Calendar            setRegisteredCompanies()     Sets the current record's "RegisteredCompanies" value
 * @method Calendar            setTypeCalendar()            Sets the current record's "TypeCalendar" value
 * @method Calendar            setCalendar()                Sets the current record's "Calendar" collection
 * 
 * @package    egauss
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCalendar extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('calendar');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('app_user_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('year', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('month', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('day', 'integer', 8, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('hour_from', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('hour_to', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('subject', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('body', 'text', null, array(
             'type' => 'text',
             ));
        $this->hasColumn('type_calendar_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => 4,
             ));
        $this->hasColumn('registered_companies_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('next', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));

        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('AppUser', array(
             'local' => 'app_user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('RegisteredCompanies', array(
             'local' => 'registered_companies_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('TypeCalendar', array(
             'local' => 'type_calendar_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('DocumentsRegisteredCompanies as Calendar', array(
             'local' => 'id',
             'foreign' => 'calendar_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}