<?php

/*
Plugin Name: Validatieplugin
Description: Plugin voor controle van gebruikersinvoer door 182code. Wordt gebruikt door andere plugins van 182code.
Author: Geert van Dijk
Version: 1.0.1
*/


include_once(ABSPATH . 'wp-config.php');
include_once(ABSPATH . 'wp-includes/wp-db.php');
include_once(ABSPATH . 'wp-includes/pluggable.php');


class g182_Validator {

  function __construct() {
     
  }

  function none($text) {
    return true;
  } 

  function password($text) {
    // for now, all non-empty passwords are allowed
    // minimum/maximum length should be added at least
    return !empty($text);
  }

  function email($text) {
  	return filter_var($text, FILTER_VALIDATE_EMAIL);
  }

  function name($text) {
  	return preg_match('/^[A-Za-z ]/', $text);
  }

  function phone($text) {
  	return preg_match('/^[0-9\/-]+$/', $text);
  }

}

add_action("init", "g182_Validator_Init");
function g182_Validator_Init() { global $g182_Validator; $g182_Validator = new g182_Validator(); }
?>