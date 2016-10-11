<html>
    <head>
        <title>Login</title>
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
                die("Connection Failed to Database. " . mysqli_connect_error());
            }
        ?>
    </head>
    <body>
        <?php
            if($_SERVER['REQUEST_METHOD'] == "GET") {
                echo "<form method='POST'>";
                echo "<!--<input type='text' name='email' style='padding: 0.25em; margin: 0.25em;' placeholder='Email' /><br>-->";
                echo "<input type='text' name='uname' style='padding: 0.25em; margin: 0.25em;' placeholder='Username' /><br>";
                echo "<input type='password' name='pass' style='padding: 0.25em; margin: 0.25em;' placeholder='Password' /><br>";
                echo "<input type='submit' style='margin: 0.25em;' value='Login' />";
                echo "</form>";
                echo "<p style='padding: 0.25em; margin: 0.25em;'>No account? <a href='register.php'>Click here</a> to register.";
            }
            if($_SERVER['REQUEST_METHOD'] == "POST") {
                $loggedin = false;
                $uname = $_REQUEST['uname'];
                $pass = $_REQUEST['pass'];
                $uname = stripslashes($uname);
                $pass = stripslashes($pass);
                $uname = mysqli_real_escape_string($conn, $uname);
                $pass = mysqli_real_escape_string($conn, $pass);
                $sql = "SELECT username, password FROM users";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        if($row['username'] == $uname && password_verify($pass, $row['password'])) {
                            $loggedin = true;
                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $uname;
                            include('members.php');
                            break;
                        }
                    }
                }
                if($loggedin == false) {
                    echo "<p method='GET' style='padding: 0.25em; margin: 0.25em;'>Incorrect username or password. Please try again.</p>";
                }
            }
        ?>
    </body>
</html>
