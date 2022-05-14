<?php
/**
 * http://lvh.me/phpmotors/.
 * instructions to run docker. put this into the terminal: docker compose up -d
 * VEHICLES CONTROLLER
 */

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/vehicles-model.php';

/**Create a $classificationList variable to build a dynamic drop-down select list. The classificationName must appear in the browser as an option to select, but the classificationId must be the value of each option. */
$classificationList = '<select name="classificationId">';
$classifications = getClassifications();
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$classificationList .= '</select>';


// Get the array of classifications
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
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

switch($action){
    case 'something':
        // do something
        break;
    case 'template':
        include 'view/template.php';
        break;
}

?>