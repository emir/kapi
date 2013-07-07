<?php
namespace KAPI;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Model;

class Views extends Core\Views {

  public static function search($gender, $day, $age) {
    $tags = Model::factory('KAPI\Product')
      ->whereLike("gender", "%$gender%")
      ->whereLike("day", "%$day%")
      ->whereLike("age", "%$age%")
      ->findMany();

    return self::jsonMany($tags);
  }

  public static function searchBurc($burc) {
    $tags = Model::factory('KAPI\Product')
      ->whereLike("burc", "%$burc%")
      ->findMany();

    return self::jsonMany($tags);
  }
}