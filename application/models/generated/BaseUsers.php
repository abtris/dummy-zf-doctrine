<?php

/**
 * BaseUsers
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $idUser
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property boolean $ban
 * @property integer $groupMember
 * @property Groups $Groups
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseUsers extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('users');
        $this->hasColumn('idUser', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('phone', 'string', 30, array(
             'type' => 'string',
             'length' => '30',
             ));
        $this->hasColumn('email', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('password', 'string', 255, array(
             'type' => 'string',
             'length' => '255',
             ));
        $this->hasColumn('ban', 'boolean', null, array(
             'type' => 'boolean',
             ));
        $this->hasColumn('groupMember', 'integer', 4, array(
             'type' => 'integer',
             'length' => '4',
             ));

        $this->option('type', 'INNODB');
        $this->option('collate', 'utf8_general_ci');
        $this->option('charset', 'utf8');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Groups', array(
             'local' => 'groupMember',
             'foreign' => 'idGroup'));
    }
}