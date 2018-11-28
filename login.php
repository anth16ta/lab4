<?php
    include "header.php";
    
    //Login 
    if(isset($_POST['username']) && isset($_POST['password'])){ //If form submitted
        //Connect to database
        @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
            
        if ($db->connect_error) {  //if it was an error
            echo "Could not connect: " . $db->connect_error;
            exit();
        }
        //End Connect to database
        
        
        //Variables
        $error = 0;
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = md5(mysqli_real_escape_string($db, $_POST['password']));
        //End Variables
        
        
        $query = "SELECT userID FROM User
        WHERE username = '$username' AND password = '$password'";
                
        $stmt = $db->prepare($query);
        $stmt->bind_result($userID);
        $stmt->execute();
            
        if($stmt->fetch()){
            //$_SESSION['userip'] = $_SERVER['REMOTE_ADDR'];
            header("Location: admin.php");
        }
        else{
            $error = 1;
        }
    }
    //End Login   
?>

        <main>
            <h2>Sign in</h2>
            <form id="loginform" method="post" action="">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Sign in">
            </form>
            <?php
                if(isset($error)){
                    if($error == 1){
                        echo "<p>The username or password is wrong. Try again.</p>";
                    }
                }
            ?>
        </main>
        
        <?php include "footer.php" ?>
    </div>
</body>
</html>