<?php
  // Check if user is logged in. If not, send to home
  if(!$_SESSION['loggedin']) {
    header('Location: /phpmotors/index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">

  <title>PHP Motors</title>
</head>
<body>
  <header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav id ="page_nav" > 
        <?php echo $navList; ?>
        </nav>
  <?php
    if (isset($message)) {
    echo $message;
    }
  ?>
  <h1><?php echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'] ?></h1>
  <div class="flex-container">
    <h2>Update Your Information</h2>
    <form name="update-client-form" method="post" action="/phpmotors/accounts/index.php">
      <input name="clientFirstname" id="clientFirstname" type="text" placeholder="First Name*" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";} elseif(isset($clientInfo['clientFirstname'])) {echo "value='$clientInfo[clientFirstname]'"; } ?>>
      <input name="clientLastname" id="clientLastname" type="text" placeholder="Last Name*" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";} elseif(isset($clientInfo['clientLastname'])) {echo "value='$clientInfo[clientLastname]'"; } ?>>
      <input name="clientEmail" id="clientEmail" type="text" placeholder="Email*" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";} elseif(isset($clientInfo['clientEmail'])) {echo "value='$clientInfo[clientEmail]'"; } ?>>
      <input type="submit" name="submit" value="Save">
      <input type="hidden" name="action" value="updateClient">
      <input type="hidden" name="clientId" value="
      <?php if(isset($clientInfo)){ echo $clientInfo['clientId']; } ?>">
    </form>
    <h2>Change Your Password</h2>
    <form name="update-password-form" method="post" action="/phpmotors/accounts/index.php">
      <input name="clientPassword" id="clientPassword" type="password" placeholder="New Password*" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
      <span class="password">Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span>
      <input type="submit" name="submit" value="Save">
      <input type="hidden" name="action" value="updatePassword">
      <input type="hidden" name="clientId" value="
      <?php if(isset($_SESSION)){ echo $_SESSION['clientData']['clientId']; } ?>">
    </form>
  </div>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>