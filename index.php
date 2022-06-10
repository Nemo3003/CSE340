<?php
/**
 * http://lvh.me/phpmotors/.
 * instructions to run docker. put this into the terminal: docker compose up -d
 * 
 */
// Create or access a Session
session_start();
// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';
//Get the functions library
require_once 'library/functions.php';

NavBar();
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'template':
      include 'view/template.php';
      break;
  default:
      include 'view/home.php';
      break;
}
?>