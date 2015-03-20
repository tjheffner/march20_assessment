<?php

  class Stylist
  {
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
      $this->name = $name;
      $this->id = $id;
    }

    function getName()
    {
      return $this->name;
    }

    function setName($new_name)
    {
      return $this->name = (string) $new_name;
    }

    function getId()
    {
      return $this->id;
    }

    function setId($new_id)
    {
      return $this->id = (int) $new_id;
    }

    function save()
    {
      $statement = $GLOBALS['DB']->query("INSERT INTO stylists (name) VALUES ('{$this->getName()}') RETURNING id;");
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $this->setId($result['id']);
    }

    static function getAll()
    {
      $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
      $stylists = array();
      foreach($returned_stylists as $stylist) {
        $name = $stylist['name'];
        $id = $stylist['id'];
        $new_stylist = new Stylist($name, $id);
        array_push($stylists, $new_stylist);
      }
      return $stylists;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM stylists *;");
    }

  }

 ?>
