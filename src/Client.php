<?php

  class Client
  {
    private $c_name;
    private $id;
    private $stylist_id;

    function __construct($c_name, $id, $stylist_id)
    {
      $this->c_name = $c_name;
      $this->id = $id;
      $this->stylist_id = $stylist_id;
    }

    function getC_name()
    {
      return $this->c_name;
    }

    function setC_name($new_c_name)
    {
      return $this->c_name = (string) $new_c_name;
    }

    function getId()
    {
      return $this->id;
    }

    function setId($new_id)
    {
      return $this->id = (int) $new_id;
    }

    function getStylistId()
    {
      return $this->stylist_id;
    }

    function setStylistId($new_stylist_id)
    {
      $this->stylist_id = (int) $new_stylist_id;
    }

    function save()
    {
      $statement = $GLOBALS['DB']->query("INSERT INTO clients (c_name, stylist_id) VALUES ('{$this->getC_name()}', {$this->getStylistId()}) RETURNING id;");
      $result = $statement->fetch(PDO::FETCH_ASSOC);
      $this->setId($result['id']);
    }

    static function getAll()
    {
      $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
      $clients = array();
      foreach($returned_clients as $client) {
        $c_name = $client['c_name'];
        $id = $client['id'];
        $stylist_id = $client['stylist_id'];
        $new_client = new Client($c_name, $id, $stylist_id);
        array_push($clients, $new_client);
      }
      return $clients;
    }

    static function deleteAll()
    {
      $GLOBALS['DB']->exec("DELETE FROM clients *;");
    }

    function deleteClients()
    {
      $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getStylistId()};");
    }

    function deleteSingle()
    {
      $GLOBALS['DB']->exec("DELETE FROM clients WHERE id = {$this->getId()};");
    }


  }


 ?>
