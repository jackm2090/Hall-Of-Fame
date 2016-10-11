<html>
    <head>
        <?php
            if(!isset($_SESSION)) {
                session_start();
            }
        ?>
        <title>Welcome to my Website!</title>
    </head>
    <body>
        <p style='padding: 0.25em; margin: 0.25em;'>Lorem Ipsum</p>
        <p style='padding: 0.25em; margin: 0.25em;'>Please <a href='login.php'>login</a> to view content.</p>
    </body>
</html>
