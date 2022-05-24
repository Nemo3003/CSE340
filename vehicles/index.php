<?php
/*THIS IS THE VEHICLES CONTROLLER*/
    require_once '../library/connections.php';
    require_once '../model/main-model.php';
    require_once '../model/vehicles-model.php';

    $classifications = getClassifications();


    $navList = "<ul id='navigation'>";
    $navList .= "<li><a href='/phpmotors/accounts/index.php' title='View the PHP Motors home page'>Home</a></li>";
    $classificationList = "<select name='classificationId' id='carClassification'>";
    foreach ($classifications as $classification) {$name = $classification['classificationName']; $id = $classification['classificationId']; $navList .="<li><a href='/phpmotors/index.php?action=".urlencode($name)."' title='View our $name product line'>$name</a></li>"; $classificationList .= "<option value='$id'>$name</option>";
    }
    $navList .='</ul>';
    $classificationList .="</select><br>";



    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    }
    
    switch ($action) {
      
        case 'newClassification':
            //filter_input gets an external variable (e.g. from form input) and optionally filters it.
            $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_UNSAFE_RAW);
            
            if(empty($classificationName)) {
                $message = '<p>Please provide information for all empty form fields.</p>';
                include '../view/add-classification.php';
                exit;
            }
            $regOutcome = newClassification($classificationName);
            if($regOutcome === 1){
                header("Location: ../vehicles/");
                exit;
            } else {
                $message = "<p>Sorry, but the Submission failed. Please try again.</p>";
                include '../view/add-classification.php';
                exit;
            }
            break;
            case 'newVehicle':
                // Filter and store the data
                //FILTER_UNSAFE_RAW basically is used to avoid issues with unwanted characters
                $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_UNSAFE_RAW));
                $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_UNSAFE_RAW));
                $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_UNSAFE_RAW));
                $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_UNSAFE_RAW));
                $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_UNSAFE_RAW));
                $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT));
                $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_UNSAFE_RAW));
                $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_UNSAFE_RAW));
                $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
            
                // Check for missing data
                if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) 
                          || empty($invThumbnail) || empty($invPrice) || empty($invStock) 
                          || empty($invColor) || empty($classificationId)) {
                  $message = '<p>Please provide information for all empty form fields.</p>';
                  include '../view/add-vehicle.php';
                  exit; 
                }
            
                // Send to vehicle model
                $addVehicleResult = newVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
            
                // Check and report the result
                if($addVehicleResult === 1) {
                  $message = "<p class='success'>Success, You have added $invMake $invModel to the inventory.</p>";
                  include '../view/add-vehicle.php';
                  exit;
                } else {
                  $message = "<p class='error'>Sorry, something went wrong, $invMake $invModel was not added. Please try again.</p>";
                  include '../view/add-vehicle.php';
                  exit;
                }
                break;
        case 'Addclassification':
            include '../view/add-classification.php';
            break;
        case 'vehicle':
            include '../view/add-vehicle.php';
            break;
        default:
            include '../view/vehicle-management.php';
            break;
    }

?>
