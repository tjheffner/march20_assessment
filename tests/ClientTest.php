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
      Client::deleteAll();
      Stylist::deleteAll();
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

    function test_save()
    {
      //Arrange
      $name = "Phyllis";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      $c_name = "Victor";
      $stylist_id = $test_stylist->getId();
      $test_client = new Client($c_name, $id, $stylist_id);

      //Act
      $test_client->save();

      //Assert
      $result = Client::getAll();
      $this->assertEquals($test_client, $result[0]);
    }

    function test_getAll()
    {
      //Arrange
      $name = "Bonnie";
      $id = null;
      $c_name = "Clyde";
      $c_name2 = "Kelly";

      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      $stylist_id = $test_stylist->getId();

      $test_client = new Client($c_name, $id, $stylist_id);
      $test_client->save();
      $test_client2 = new Client($c_name2, $id, $stylist_id);
      $test_client2->save();

      //Act
      $result = Client::getAll();

      //Assert
      $this->assertEquals([$test_client, $test_client2], $result);
    }

    function test_deleteAll()
    {
      //Arrange
      $name = "Bonnie";
      $id = null;
      $c_name = "Clyde";
      $c_name2 = "Kelly";

      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      $stylist_id = $test_stylist->getId();

      $test_client = new Client($c_name, $id, $stylist_id);
      $test_client->save();
      $test_client2 = new Client($c_name2, $id, $stylist_id);
      $test_client2->save();

      //Act
      $result = Client::deleteAll();

      //Assert
      $result = Client::getAll();
      $this->assertEquals([], $result);
    }

  }

?>
