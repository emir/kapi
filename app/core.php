<?php
namespace KAPI\Core;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Model;

class Views {

  public static function doors() {
    global $urls;
    return self::render('doors.html', array('urls' => $urls));
  }

  protected static function jsonMany(array $data, $status = 200, array $headers = array()) {
    // Serve as array.
    if (count($data) == 0) {
      return self::json(array(), 404, $headers);
    }
    $response = array();
    foreach ($data as $datum) {
      if (method_exists($datum, "asArray")) {
        $response[] = $datum->asArray();
      } else {
        $response[] = $datum;
      }
    }
    return self::json($response, $status, $headers);
  }

  // Json Dumper
  protected static function json($data, $status = 200, array $headers = array()) {
    $headers = array_merge(['Content-Type' => 'application/json'], $headers);
    return new Response(json_encode($data), $status, $headers);
  }

  // View Render
  protected static function render($template, $data = []) {
    global $app;
    return $app['twig']->render($template, $data);
  }
}