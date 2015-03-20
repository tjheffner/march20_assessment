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

    static function find($search_id)
    {
      $found_stylist = null;
      $stylists = Stylist::getAll();
      foreach($stylists as $stylist) {
        $stylist_id = $stylist->getId();
        if ($stylist_id == $search_id) {
          $found_stylist = $stylist;
        }
      }
      return $found_stylist;
    }

    function update($new_name)
    {
      $GLOBALS['DB']->exec("UPDATE stylists SET name = '{$new_name}' WHERE id = {$this->getId()};");
      $this->setName($new_name);
    }

    function delete()
    {
      $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
      $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
    }

    function getClients()
    {
      $clients = array();
      $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
      foreach($returned_clients as $client) {
        $c_name = $client['c_name'];
        $id = $client['id'];
        $stylist_id = $client['stylist_id'];
        $new_client = new Client($c_name, $id, $stylist_id);
        array_push($clients, $new_client);
      }
      return $clients;
    }
  }

 ?>
