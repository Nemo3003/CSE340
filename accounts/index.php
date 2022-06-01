<?php
/**
 * http://lvh.me/phpmotors/.
 * instructions to run docker. put this into the terminal: docker compose up -d
 * ACCOUNTS CONTROLLER
 */

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
//Get the functions library
require_once '../library/functions.php';

NavBar();
//echo $navList;
//exit;
/**echo "<pre>";
var_dump($classifications);
echo "</pre>";
exit;*/

// Get the value from the action name - value pair
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'template':
      include 'view/template.php';
      break;
  case 'registration':
      include '../view/registration.php';
      break;
  case 'register':
      // Filter and store the data
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname',FILTER_UNSAFE_RAW);
      $clientLastname = filter_input(INPUT_POST, 'clientLastname',FILTER_UNSAFE_RAW);
      $clientEmail = filter_input(INPUT_POST, 'clientEmail',FILTER_UNSAFE_RAW);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword',FILTER_UNSAFE_RAW);

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPass($clientPassword);
      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; }
      
        //Send data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
      
      // Check and report the result
      if($regOutcome === 1){
        $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
        include '../view/login.php';
        exit;
      } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
      }
      break;
    case 'home':
        include '../view/home.php';
        break;
  default:
      include '../view/login.php';
      break;
}
?>