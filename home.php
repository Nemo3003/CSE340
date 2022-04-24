<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" media="screen">
    <title>Template</title>
    </head>

<body>
        <header id ="header_page">
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?> 
        </header>
        <nav id ="page_nav" > 
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> 
        </nav>
        <main>
        
        <div id="delorean">
        <h1>Welcome to PHP Motors!</h1> 
            <div id="side-del">
                <h2 id="title-del"> DMC Delorean</h2>
                <p>3 Cup holders</p>
                <p>Superman doors</p>
                <p>Fuzzy dice</p>
                <button>Own Today</button>
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            </div>
        </div>
        <div id="div-bottom">
            <div id="upgrades">
            <h2>Delorean Upgrades</h2>
             <div id="upg-content">
                 <div id="upgr-deep">
                    <div>
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper_sticker"><br>
                        <a  href="#">Bumper Sticker</a>
                    </div>
                    <div>
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame"><br>
                        <a href="#">flame</a>
                    </div>
                    <div>
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux-cap"><br>
                        <a href="#">flux cap</a>
                    </div>
                    <div>
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub_cap"><br>
                        <a href="#">hub cap</a>
                    </div>
                    </div>
                </div>
            </div>
            <div id="character">
                <h2>DMC Delorean Reviews</h2>
                <ul><br><br>
                    <li>"So fast its almost like travelling in time." (4/5)</li>
                    <li>"Coolest ride on the road."(4/5)</li>
                    <li>"I'm feeling Marty McFly!"(5/5)</li>
                    <li>"The most futuristic ride of our day."(4.5/5)</li>
                    <li>"50's livin and I love it!"(5/5)</li>
                </ul>
            </div>
        </div>
        </main>
    <footer id = "footer_page">
    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 
    </footer>
    <script src = "js/app.js"></script>
</body>
</html>