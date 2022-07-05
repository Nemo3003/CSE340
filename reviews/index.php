<?php

// this is the reviews controller

// Create or access a Session
session_start();

require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/reviews-model.php';
require_once '../library/functions.php';

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
      header("Location: /phpmotors/vehicles/?action=vehicle&invId=$invId");
      exit; 
    }

    // Send the data to the model
    $addReviewResult = addReview($clientId, $invId, $reviewDate, $reviewText);

    // Check and report the result
    if($regOutcome === 1) {
      $_SESSION['message'] = "Your review has been added successfully.";
      header("Location: /phpmotors/vehicles/?action=vehicle&invId=$invId");
      exit;
    }
    break;
  case 'editReview':
    $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_SANITIZE_NUMBER_INT); 

    $clientFirstname = $_SESSION['clientData']['clientFirstname'];
    $clientLastname = $_SESSION['clientData']['clientLastname'];

    $screenName = getScreenname($clientFirstname, $clientLastname);

    $reviewInfo = getReviewsByreviewId($reviewId);
    $reviewText = $reviewInfo[0]['reviewText'];

    include '../view/edit-review.php';
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
    $updateResult = updateReview($reviewId, $reviewText);

    // Check and report the result
    if($updateResult === 1) {
      $message = "<p class='success'>Success, You have updated your review.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts?action=admin');
      exit;
    } else {
      $message = "<p class='error'>Sorry, something went wrong, your review was not updated. Please try again.</p>";
      include '../view/admin.php';
      exit;
    }
    break;
  case 'deleteReview':
    // Filter and store the data
    $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

    // Send to vehicle model
    $deleteResult = deleteReview($reviewId);

    // Check and report the result
    if($deleteResult === 1) {
      $message = "<p class='success'>Success, You have deleted your review.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/accounts/index.php?action=admin');
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