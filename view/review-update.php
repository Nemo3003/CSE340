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
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">

  <title>PHP Motors</title>
</head>
<body>
  <header id="header">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
  </header>
  <nav id="page_nav">
        <?php echo $navList;?> 
    </nav>
  <?php
    if (isset($message)) {
    echo $message;
    }//$reviewDate, $reviewText
  ?>
  <h1>Update Your Review</h1>
  <div class="flex-container">
    <form name="update-review-form" method="post" action="/phpmotors/reviews/index.php">
      <label for='screenName'>Screen Name:</label>
      <input name='screenName' id='screenName' type='text' readonly required value="<?php if(isset($screenName)){ echo $screenName; } ?>">
      <label for='reviewText'>Review:</label>
      <textarea name='reviewText' id='reviewText' required><?php if(isset($reviewInfo)){ echo $reviewInfo[0]['reviewText']; } ?></textarea>
      <input type="submit" name="submit" value="Update">
      <input type="hidden" name="action" value="updateReview">
      <input type="hidden" name="reviewId" value="<?php if(isset($reviewId)){ echo $reviewId; } ?>">
    </form>
  </div>
  <footer id="footer">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
  </footer>
</body>
</html>