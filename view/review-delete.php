
<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/phpmotors/css/large.css" media="screen">
  <link rel="stylesheet" href="/phpmotors/css/base.css" media="screen">
  <title>Delete Review | PHP Motors</title>
</head>
<body>

    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
     
    <nav id="page_nav">
        <?php echo $navList;?> 
    </nav>
    <main>
        <?php
            if (isset($message)) {
                echo $message;
            }
        ?>
        <h1 class="form_header">Delete <?php echo $review['invMake'].' '.$review['invModel']?> Review</h1>

        <h2 class="form_subHeader">Reviewed on <?php $timestamp = strtotime($review['reviewDate']); $date = date("d F\, Y",$timestamp); echo $date;?></h2>
        <form class="reviewForm" action='/phpmotors/reviews/index.php' method='post'>
            <h3 class="messageFormReview">Deletes cannot be undone. Are you sure you want to delete this review?</h3>
            <label for='reviewText'>Review:</label>
            <textarea name='reviewText' id='reviewText' required><?php if(isset($reviewInfo)){ echo $reviewInfo[0]['reviewText']; 
             } ?></textarea>
            <input type='submit' name='submit' class='reviewButton' value='Delete Review'>
            <input type='hidden' name='action' value='deleteReview'>
            <input type='hidden' name='reviewId' value=<?php echo $review['reviewId']?>>

         </form>

    </main>
    <footer>
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
</body>
</html>
<?php unset($_SESSION['message']); ?>