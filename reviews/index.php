<?php

// this is the reviews controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';


$classifications = getClassifications();

$navList = NavBar($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action) {
  case 'addReview':
    // Filter and store the data
    $clientId = trim(filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
    $reviewDate = trim(filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Check for missing data
    if(empty($clientId) || empty($invId) || empty($reviewDate) || empty($reviewText)){
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';

      header("Location: /phpmotors/vehicles/?action=VehicleInformations&invId=$invId");

      exit; 
    }

    // Send the data to the model
    $addReviewResult = addReview($clientId, $invId, $reviewDate, $reviewText);

    
    // Check and report the result
    if($addReviewResult) {

      $loQueQuieras = getReviewsByinvId($invId);
      $clientReviews = buildClientsReviews($loQueQuieras);
      $_SESSION['message'] = "Your review has been added successfully.";
      $_SESSION['reviews'] = $clientReviews;
      header("Location: /phpmotors/vehicles/?action=VehicleInformations&invId=$invId");
      exit;
    }
    

    break;
  case 'editReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT); 

    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];

    $screenName = getScreenname($clientFirstname, $clientLastname);

    $reviewInfo = getReviewsByinvId($reviewId);
    $reviewText = $reviewInfo[0]['reviewText'];


    include '../view/review-update.php';

    break;
  case 'updateReview':
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
    $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Check for missing data
    if(empty($reviewId) || empty($reviewText)) {
      $_SESSION['message'] = '<p>Please provide information for all empty form fields.</p>';
      include '../view/admin.php';
      exit; 
    }

    // Send the data to the model

    // Send the data to the model
    $updateReview = updateReview($clientId, $invId, $reviewDate, $reviewText);

    // Check and report the result
    if($updateReview) {

      $loQueQuieras = getReviewsByinvId($invId);
      $adminReviews = buildAdminReviews($loQueQuieras);
      $_SESSION['message'] = "Your review has been updated successfully.";
      $_SESSION['reviews'] = $adminReviews;
      header("Location: /phpmotors/vehicles/?action=VehicleInformations&invId=$invId");
    }else {

        $message = "<p class='error'>Sorry, something went wrong, your review was not updated. Please try again.</p>";
        include '../view/admin.php';
        exit;
      }
      break; 
  case 'deleteReview':
    // Filter and store the data
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    // Send to vehicle model

       // Send the data to the model
       $deleteReview = deleteReview($reviewId);
    
       // Check and report the result
       if($deleteReview) {
   
         $loQueQuieras = getReviewsByreviewId($invId);
         $adminReviews = buildAdminReviews($loQueQuieras);
         $_SESSION['message'] = "Your review has been deleted successfully.";
         $_SESSION['reviews'] = $adminReviews;
         header("Location: /phpmotors/vehicles/?action=VehicleInformations&invId=$invId");
         exit;

    } else {
      $message = "<p class='error'>Sorry, something went wrong, your review was not deleted. Please try again.</p>";
      include '../view/admin.php';
      exit;
    }
    break;

  default:
    if ($_SESSION['loggedin'] == True) {
      include '../view/admin.php';
    } else {
      header("Location: /phpmotors/index.php");
    }
 } 