<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Stylist.php";
  require_once "src/Client.php";

  $DB = new PDO ('pgsql:host=localhost;dbname=hair_salon_test');

  class StylistTest extends PHPUnit_Framework_TestCase
  {
    protected function tearDown()
    {
      Stylist::deleteAll();
      Client::deleteAll();
    }

    function test_getName()
    {
      //Arrange
      $name = "Alice";
      $id = null;
      $test_stylist = new Stylist($name, $id);

      //Act
      $result = $test_stylist->getName();

      //Assert
      $this->assertEquals($name, $result);
    }

    function test_getId()
    {
      //Arrange
      $name = "Betty";
      $id = 1;
      $test_stylist = new Stylist($name, $id);

      //Act
      $result = $test_stylist->getId();

      //Assert
      $this->assertEquals(1, $result);
    }

    function test_setId()
    {
      //Arrange
      $name = "Wilma";
      $id = null;
      $test_stylist = new Stylist($name, $id);

      //Act
      $test_stylist->setId(2);

      //Assert
      $result = $test_stylist->getId();
      $this->assertEquals(2, $result);
    }

    function test_save()
    {
      //Arrange
      $name = "Lorraine";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      //Act
      $result = Stylist::getAll();

      //Assert
      $this->assertEquals($test_stylist, $result[0]);
    }

    function test_getAll()
    {
      //Arrange
      $name = "Patty";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      $name2 = "Rita";
      $id2 = null;
      $test_stylist2 = new Stylist($name2, $id2);
      $test_stylist2->save();

      //Act
      $result = Stylist::getAll();

      //Assert
      $this->assertEquals([$test_stylist, $test_stylist2], $result);
    }

    function test_deleteAll()
    {
      //Arrange
      $name = "Georgia";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      //Act
      Stylist::deleteAll();
      $result = Stylist::getAll();

      //Assert
      $this->assertEquals([], $result);
    }

    function testUpdate()
    {
      //Arrange
      $name = "Louise";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      $new_name = "Thelma";

      //Act
      $test_stylist->update($new_name);

      //Assert
      $this->assertEquals("Thelma", $test_stylist->getName());
    }

    function testDelete()
    {
      //Arrange
      $name = "Bridget";
      $id = null;
      $test_stylist = new Stylist($name, $id);
      $test_stylist->save();

      //Act
      $test_stylist->delete();

      //Assert     //change this to client once class is created!!
      $this->assertEquals([], Stylist::getAll());
    }
  }

 ?>
