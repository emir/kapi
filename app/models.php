<?php
namespace KAPI;

use \Model;

class Link extends Model {
  public static $_table = 'links';

  public $id;
  public $link;
  public $name;
}