<html>
    <head>
        <title>Register</title>
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
                die("Connection Failed to Database. ". mysqli_connect_error());
            }
        ?>
    </head>
    <body>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "GET") {
                echo "<form method='post'>";
                echo "<input type='text' name='email' style='padding: 0.25em; margin: 0.25em;' placeholder='Email' /><br>";
                echo "<input type='text' name='uname' style='padding: 0.25em; margin: 0.25em;' placeholder='Username' /><br>";
                echo "<input type='password' name='pass' style='padding: 0.25em; margin: 0.25em;' placeholder='Password' /><br>";
                echo "<input type='password' name='cpass' style='padding: 0.25em; margin: 0.25em;' placeholder='Confirm Password' /><br>";
                echo "<input type='submit' style='margin: 0.25em;' value='Register' />";
                echo "</form>";
                echo "<p style='padding: 0.25em; margin: 0.25em;'>Back to <a href='login.php'>Login</a></p>";
            }
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $email = $_REQUEST['email'];
                $name = $_REQUEST['uname'];
                $pass = $_REQUEST['pass'];
                $cpass = $_REQUEST['cpass'];
                if(empty($name)) {
                    echo "Username is empty. Back to <a href='register.php'>Register</a>";
                    $name = null;
                    $pass = null;
                    $cpass = null;
                    if(ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                    }
                    session_destroy();
                }
                elseif($pass != $cpass) {
                    echo "Passwords do not match. Back to <a href='register.php'>Register</a>";
                    $name = null;
                    $pass = null;
                    $cpass = null;
                    if(ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
                    }
                    session_destroy();
                }
                else {
                    $hash = password_hash($pass, PASSWORD_BCRYPT);                    
                    $sql = "INSERT INTO users (email, username, password)
                    VALUES ('$email', '$name', '$hash')";
                    
                    if(mysqli_query($conn, $sql)) {
                        echo "Success! $name is now registered.<br>";
                        echo "Return to <a href='login.php'>Login</a>";
                    }
                    else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                }
            }
        ?>
    </body>
</html>
