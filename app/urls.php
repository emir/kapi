<?php
namespace KAPI;

$urls = [
  # The API Endpoint View
  ['get', '/api', 'KAPI\Views::doors', "Lists the API endpoints."],

  # You can define your own URL schemes.
  ['get', '/links/{search}',  'KAPI\Views::links', 'Searchs the value in links table.'],
  ['get', '/links',           'KAPI\Views::links', 'Shows all the links in links table.'],

  ['get', '',                 'KAPI\Views::index']

  # [http method, url pattern, view method, help text (optional)]
];