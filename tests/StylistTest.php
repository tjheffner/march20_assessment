<?php

  /**
  * @backupGlobals disabled
  * @backupStaticAttributes disabled
  */

  require_once "src/Stylist.php";

  // $DB = new PDO ('pgsql:host=localhost;dbname=hair_salon_test');

  class StylistTest extends PHPUnit_Framework_TestCase
  {
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


  }

 ?>
