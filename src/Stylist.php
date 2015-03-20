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

  }

 ?>
