<?php
namespace KAPI;

use \Model;

class Views extends Core\Views {

  public static function links($search = "") {
    $links = Model::factory('KAPI\Link')
      ->whereLike("name", "%$search%")
      ->findMany();

    return self::jsonMany($links);
  }

  public static function index() {
    return self::render("index.html");
  }
}