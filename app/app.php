<?php

  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Stylist.php";

  $app = new Silex\Application();
  $app['debug'] = true;

  $DB = new PDO('pgsql:host=localhost;dbname=hair_salon');

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  /*3 twig files for stylist class. view all, view one, edit one
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
    return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist, 'clients' => Client::getAll()));
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
    return $app['twig']->render('stylist.twig', array('stylist' => $current_stylist));
  });

  //delete a single stylist
  $app->delete("/stylists/{id}", function($id) use($app) {
    $current_stylist = Stylist::find($id);
    $current_stylist->delete();
    return $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
  });

  //delete all stylists
  $app->post("/delete_stylists", function() use($app) {
    Stylist::deleteAll();
    $app['twig']->render('stylists.twig', array('stylists' => Stylist::getAll()));
  });

  return $app;

 ?>
