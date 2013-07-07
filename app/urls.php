<?php
namespace KAPI;

$urls = [
  # The API Endpoint View
  ['get', '/api', 'KAPI\Views::doors', "

  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, vitae, consequatur, earum aspernatur modi neque eveniet at id quaerat maiores itaque ea laboriosam numquam beatae maxime vel voluptas! Magni, cum.
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, vitae, consequatur, earum aspernatur modi neque eveniet at id quaerat maiores itaque ea laboriosam numquam beatae maxime vel voluptas! Magni, cum.
  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum, vitae, consequatur, earum aspernatur modi neque eveniet at id quaerat maiores itaque ea laboriosam numquam beatae maxime vel voluptas! Magni, cum.

  "],

  # You can define your own URL schemes.
  ['get', '/blabla{a}', 'KAPI\Views::doors']
];