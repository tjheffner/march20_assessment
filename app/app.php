<?php

  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Stylist.php";
  require_once __DIR__."/../src/Client.php";

  $app = new Silex\Application();
  $app['debug'] = true;

  $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  /*3 twig files for Stylist class. view all, view one, edit one
    view all = stylists.twig
    view one = stylist.twig
    edit one = stylist_edit.twig
  */

  //show all stylists
  $app->get("/", function() use ($app) {
    return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
  });

  //create a new stylist form goes through this
  $app->post("/stylists", function() use($app) {
    $new_stylist = new Stylist($_POST['name']);
    $new_stylist->save();
    return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
  });

  //view a single stylist + their clients here
  $app->get("/stylists/{id}", function($id) use($app) {
    $current_stylist = Stylist::find($id);
    return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'clients' => $current_stylist->getClients()));
  });

  //edit a single stylist
  $app->get("/stylists/{id}/edit", function($id) use($app) {
    $current_stylist = Stylist::find($id);
    return $app['twig']->render('stylist_edit.twig', array('stylist' => $current_stylist));
  });

  //edit form sent as a patch
  $app->patch("/stylists/{id}", function($id) use($app) {
    $current_stylist = Stylist::find($id);
    $new_name = $_POST['name'];
    $current_stylist->update($new_name);
    return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'clients' => $current_stylist->getClients()));
  });

  //delete a single stylist
  $app->delete("/stylists/{id}/delete", function($id) use($app) {
    $current_stylist = Stylist::find($id);
    $current_stylist->delete();
    return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
  });

  //delete all stylists
  $app->post("/delete_stylists", function() use($app) {
    Stylist::deleteAll();
    return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
  });

  /* Routes for Client class.
  *  Only one page is called for client because if the client name needs to be edited,
  *  the easiest thing to do is delete the single entry and enter a new one.
  */

  $app->post("/client", function() use ($app) {
    $c_name = $_POST['c_name'];
    $stylist_id = $_POST['stylist_id'];
    $client = new Client($c_name, $id = null, $stylist_id);
    $client->save();
    $current_stylist = Stylist::find($stylist_id);

    return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'clients' => $current_stylist->getClients()));
  });

  $app->delete("/stylists/{id}/deleteClients", function($id) use ($app) {
    $current_stylist = Stylist::find($id);
    $clients = $current_stylist->getClients();
    $single_client = $clients[0];
    $single_client->deleteClients();

    return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'clients' => $current_stylist->getClients()));
  });

  $app->delete("/stylists/{id}/deleteSingle", function($id) use ($app) {
    $client_id = $_POST['client_id'];
    $current_stylist = Stylist::find($id);
    $clients = $current_stylist->getClients();
    $that_client = null;
    foreach ($clients as $client) {
      if ($client->getId() == $client_id) {
      $that_client = $client;
      }
    }
    $that_client->deleteSingle();

    return $app['twig']->render('stylist.twig', array('client_id' => $client_id, 'stylist' => $current_stylist, 'clients' => $current_stylist->getClients()));
  });

  return $app;

 ?>
