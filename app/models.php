<?php
namespace KAPI;
use \Model as Model;

class Product extends Model {
  public static $_table = 'products';

  public $id;
  public $link;
  public $image;
  public $name;
  public $gender;
  public $day;
  public $age;
}