<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Client.php";
  require_once "src/Stylist.php";

  $DB = new PDO ('pgsql:host=localhost;dbname=hair_salon_test');

  class ClientTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
    {
  //    Client::deleteAll();
    }

    function test_getC_name()
    {
      //Arrange
      $c_name = "Fred";
      $id = null;
      $stylist_id = 1;
      $test_client = new Client($c_name, $id, $stylist_id);

      //Act
      $result = $test_client->getC_name();

      //Assert
      $this->assertEquals($c_name, $result);
    }

    function test_getId()
    {
      //Arrange
      $name = "Betty";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      $c_name = "Joe";
      $stylist_id = $test_stylist->getId();
      $test_client = new Client($name, $id, $stylist_id);
      $test_client->save();

      //Act
      $result = $test_client->getId();

      //Assert
      $this->assertEquals(true, is_numeric($result));
    }

    

  }

?>
