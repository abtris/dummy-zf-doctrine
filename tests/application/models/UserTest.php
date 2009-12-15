<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserTest
 *
 */
class UserTest 
    extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function testCanCreateUsers()
    {

        $u = new Users();
        $u->email = "jon@doo.com";
        $u->name = "Jon Doo";
        $u->phone = "XXX-123-323";
        $u->save();

        $this->assertTrue(intval($u->idUser) === 1);


        $u2 = new Users();
        $u2->email = "jane@example.com";
        $u2->name = 'Jane Doe';
        $u2->save();
        $this->assertTrue(intval($u2->idUser) === 2);

    }
}

