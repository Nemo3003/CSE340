<?php
/*THIS IS THE VEHICLES CONTROLLER*/
    require_once '../library/connections.php';
    require_once '../model/main-model.php';
    require_once '../model/vehicles-model.php';
    require_once '../library/functions.php';

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
                //Filter and store data
                $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_UNSAFE_RAW));
                $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_UNSAFE_RAW));
                $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_UNSAFE_RAW));
                $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_UNSAFE_RAW));
                $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_UNSAFE_RAW));
                $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_UNSAFE_RAW, FILTER_FLAG_ALLOW_FRACTION));
                $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_UNSAFE_RAW));
                $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_UNSAFE_RAW));
                $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_UNSAFE_RAW));
                // Check for missing data
                if(empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || 
                empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)){
                    $message = '<p>Please provide information for all empty form fields.</p>';
                    include '../view/add-vehicle.php';
                    exit; 
                }
                // Send the data to the model
                $regOutcome = addNewVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);
                // Check and report the result
                if($regOutcome === 1){
                    $message = "<p>The $invMake $invModel has been added succesfully!.</p>";
                    include '../view/add-vehicle.php';
                    exit;
                } else {
                    $message = "<p>Sorry, we could't add the $invMake $invModel. Please try again.</p>";
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
