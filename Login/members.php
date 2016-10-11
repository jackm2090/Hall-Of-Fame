<html>
    <head>
        <title>Members</title>
        <?php
            if(!isset($_SESSION)) {
                session_start();
            }
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $db = "firstlogin";
            
            $conn = mysqli_connect($servername, $username, $password, $db);
            
            if(!$conn) {
                die("Connection failed to Database. " . mysqli_connect_error());
            }
        ?>
    </head>
    <body>
        <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo "<p style='padding: 0.25em; margin: 0.25em;'>Welcome, " . $_SESSION['username'] . "!</p>";
            
                echo "<p style='padding: 0.25em; margin: 0.25em;'><a href='logout.php'>Logout</a></p>";
            }
            else {
                echo "<p style='padding: 0.25em; margin: 0.25em;'>Please <a href='login.php'>login</a> to view this page.</p>";
            }
        ?>
    </body>
</html>
