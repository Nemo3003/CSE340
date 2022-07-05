<?php
/**
 * http://lvh.me/phpmotors/.
 * instructions to run docker. put this into the terminal: docker compose up -d
 * ACCOUNTS CONTROLLER
 */
// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
//Get the functions library
require_once '../library/functions.php';
//Get the review model
require_once '../model/reviews-model.php';
// Get the array of classifications
$classifications = getClassifications();
//Call the navbar
$navList = NavBar($classifications);
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
// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname',FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail',FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword',FILTER_SANITIZE_FULL_SPECIAL_CHARS));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPass($clientPassword);
      $existingEmail = checkExistingEmail($clientEmail);
      // Check for existing email address in the table
      if($existingEmail){
        $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
        include '../view/login.php';
        exit;
       }
      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
        $message = '<p>Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit; }
      //Hash the password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      //Send data to the model
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

      // Check and report the result
      if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      header('Location: /phpmotors/accounts/?action=Login');
      exit;
      }  else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit;
      }
      break;
    case 'Login':
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientEmail = checkEmail($clientEmail);
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
      $passwordCheck = checkPass($clientPassword);

      // Run basic checks, return if errors
      if (empty($clientEmail) || empty($passwordCheck)) {
      $message = '<p class="notice">Please provide a valid email address and password.</p>';
      include '../view/login.php';
      exit;
      }
        
      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if(!$hashCheck) {
        $message = '<p class="notice">Please check your password and try again.</p>';
        include '../view/login.php';
        exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      include '../view/admin.php';
      exit;
    case 'logout':
        session_unset();
        session_destroy();
        header("Location: /phpmotors/index.php");
        break;
    case 'home':
        include '../view/home.php';
        break;
    case 'updateClient':
          // Filter and store the data
          $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
          $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
          $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
      
          $clientEmail = checkEmail($clientEmail);
      
          if(isset($clientEmail) && $clientEmail != $_SESSION['clientData']['clientEmail']) {
            $emailExists = checkExistingEmail($clientEmail);
      
            // Check for existing email address in the table
            if($emailExists){
              $message = '<p class="notice">That email address already exists. Try another one.</p>';
              include '../view/client-update.php';
              exit;
            }
          }
          
          // Check for missing data
          if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
          }
      
          // Send the data to the model
          $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
      
          // Check and report the result
          if($updateResult) {
            $messages = "<p class='success'>Success, You have updated your information.</p>";
            $_SESSION['messages'] = $messages;
            $clientData = getClientById($clientId);
            $_SESSION['clientData'] = $clientData;
            header('location: /phpmotors/accounts?action=admin');
            exit;
          } else {
            $messages = "<p class='error'>Sorry, something went wrong, your info was not updated. Please try again.</p>";
            $_SESSION['messages'] = $messages;
            header('location: /phpmotors/accounts?action=admin');
            exit;
          }
          break;
    case 'updatePassword':
            // Filter and store the data
            $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
            $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        
            $checkPassword = checkPass($clientPassword);
            // Check for missing data
            if(empty($clientPassword)){
              $message = '<p>Please provide information for all empty form fields.</p>';
              include '../view/client-update.php';
              exit; 
            }
            //check if the password is valid
            if(!$checkPassword) {
              $message = '<p class="notice">Please provide a valid password.</p>';
              include '../view/client-update.php';
              exit;
            }else{
            $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        
            // Send the data to the model
            $updateResult = updatePassword($hashedPassword, $clientId);
        
            // Check the password  and report the result
            if($updateResult) {
              $messages = "<p class='success'>Success, You have updated your password.</p>";
              $_SESSION['messages'] = $messages;
              $clientData = getClientById($clientId);
              $_SESSION['clientData'] = $clientData;
              header('location: /phpmotors/accounts?action=admin');
              exit;
            } else {
              $messages = "<p class='error'>Sorry, something went wrong, your password was not updated. Please try again.</p>";
              $_SESSION['messages'] = $messages;
              header('location: /phpmotors/accounts?action=admin');
              exit;
            }}
            
            break;    
  default:
      $clientFirstname = $_SESSION["clientData"]["clientFirstname"];
      $clientLastname = $_SESSION["clientData"]["clientLastname"];

      $adminReviews = getReviewsByClientId($_SESSION['clientData']['clientId']);

      $reviewsDisplay = buildAdminReviews($adminReviews, $clientFirstname, $clientLastname);
      include '../view/admin.php';
      break;
}
?>