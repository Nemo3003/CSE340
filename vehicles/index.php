<?php
/*THIS IS THE VEHICLES CONTROLLER*/
// Create or access a Session
session_start();
    require_once '../library/connections.php';
    require_once '../model/main-model.php';
    require_once '../model/vehicles-model.php';
    require_once '../model/uploads-model.php';
    require_once '../library/functions.php';
    require_once '../model/reviews-model.php';

    // Get the array of classifications
    $classifications = getClassifications();
    //Call the navbar
    $navList = NavBar($classifications);

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
        case 'getInventoryItems': 
            // Get the classificationId 
            $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT); 
            // Fetch the vehicles by classificationId from the DB 
            $inventoryArray = getInventoryByClassification($classificationId); 
            // Convert the array to a JSON object and send it back 
            echo json_encode($inventoryArray); 
            break;
        case 'mod':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if(count($invInfo)<1){
             $message = 'Sorry, no vehicle information could be found.';
            }
            include '../view/vehicle-update.php';
            exit;
            break;
        case 'updateVehicle':
            $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
            $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
            $message = '<p class="warningMessage">Please complete all information for the item! Double check the classification of the item.</p>';
            include '../view/vehicle-update.php';
            exit;
            }
            $updatetResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
            if ($updatetResult) {
                $message = "<p class='success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/vehicles/');
                exit;
            } else {
                $message = "<p class='warningMessage'>Error. The $invMake $invModel was not updated.</p>";
                include '../view/vehicle-update.php';
                exit;
            }
        break;
        case 'del':
            $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
            $invInfo = getInvItemInfo($invId);
            if (count($invInfo) < 1) {
                    $message = 'Sorry, no vehicle information could be found.';
                }
                include '../view/vehicle-delete.php';
                exit;
                break;
        case 'deleteVehicle':
            $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
            
            $deleteResult = deleteVehicle($invId);
             if ($deleteResult) {
                $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
                $_SESSION['message'] = $message;
                 header('location: /phpmotors/vehicles/');
                 exit;
                    } else {
                        $message = "<p class='notice'>Error: $invMake $invModel was not
                    deleted.</p>";
                        $_SESSION['message'] = $message;
                        header('location: /phpmotors/vehicles/');
                        exit;
                    }
            break;
            case 'classification':
                $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $vehicles = getVehiclesByClassification($classificationName);
                if(!count($vehicles)){
                 $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
                } else {
                 $vehicleDisplay = buildVehiclesDisplay($vehicles);
                }
                include '../view/classification.php';
                break;
            case 'VehicleInformations':
                $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $invInfo = getInvItemInfo($invId);
                $invThumb2 =  getImageThumbByClassification($invId);
                $listThumb = buildThumbnailView($invThumb2);
                if(!$invInfo) {
                    $_SESSION['message'] = "<h2 class='notice'>Vehicle could not be found.</h2>";
                    http_response_code(404);
                    include '../view/404.php';
                    exit;
                }
                        
                $clientFirstname = $_SESSION["clientData"]["clientFirstname"];
                $clientLastname = $_SESSION["clientData"]["clientLastname"];
                $clientId = $_SESSION["clientData"]["clientId"];

                $clientScreenName = getScreenname($clientFirstname, $clientLastname);

                $reviewDate = date('Y-m-d H:i:s');

                $writeReview = buildReviewBox($clientScreenName, $clientId, $invId, $reviewDate);

                $loQueQuieras = getReviewsByinvId($invId);
                $clientReviews = buildClientsReviews($loQueQuieras);
                /*$loQueQuieras2 = getReviewsByreviewId($invId, $reviewDate);
                $adminReviews = buildAdminReviews($loQuieras2);*/
                $_SESSION['reviews'] = $clientReviews;



                if($reviews == True) {
                $clientReviews = getClientReviews($reviews);
                }
                include '../view/vehicle-detail.php';
                break;
        default:
            $classificationList = buildClassificationList($classifications);
            include '../view/vehicle-management.php';
            break;
    }

?>
