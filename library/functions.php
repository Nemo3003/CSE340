<?php
function checkEmail($clientEmail){
  //The filter_var() function filters a variable with the specified filter.
 $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
 return $valEmail;
}

function checkPass($clientPassword){
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
  //The preg_match() function returns whether a match was found in a string.
  return preg_match($pattern, $clientPassword);
 }
