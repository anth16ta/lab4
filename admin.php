<?php
    include "header.php";

    
    //If form submitted
    if(isset($_FILES['img'])){
        
        //Variables
        $maxsize = 2000000;
        $allowedExt = array('jpg', 'jpeg', 'png', 'gif');
        $errors = array();
        $fileName = $_FILES['img']['name'];
        $ext = strtolower(substr($fileName, strpos($fileName, '.')+1));
        $target = "uploads/$fileName";
        //End Variables
        
        
        //Check for errors
        if(in_array($ext, $allowedExt) === false){ //File extention
            $errors[] = "The file extention is not allowed.";
        }
        if($_FILES['img']['size'] > $maxsize){ //File size
            $errors[] = "The file size is to large.";
        }
        //End Check for errors
        
        
        //Upload file
        if(empty($errors)){
            //Connect to database
            @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
        
            if ($db->connect_error) {  //if it was an error
                echo "Could not connect: " . $db->connect_error;
                exit();
            }
            //End Connect to database
            
            
            //Move file to upload folder
            move_uploaded_file($_FILES['img']['tmp_name'], $target);
            //End move file
            
            
            //Insert into the database
            $fileName = "'$fileName'"; //Insert filename into the database
            
            if(isset($_POST['title'])){
                $title = "'" . htmlentities(mysqli_real_escape_string($db, $_POST['title'])) . "'";
            }
            if($title == "''"){
                $title = "NULL";
            }
            if(isset($_POST['description'])){
                $description = "'" . htmlentities(mysqli_real_escape_string($db, $_POST['description'])) . "'";
            }
            if($description == "''"){
                $description = "NULL";
            }
            
            $query = "INSERT INTO Image
            VALUES (NULL, $fileName, $title, $description)";
            
            $stmt = $db->query($query);
            //End Insert into the database
        }
        //End Upload file
        
    }
    //End If form submitted
?>
        
        <main id="admin">
            <h2>Admin</h2>
            <fieldset>
                <legend>Upload an image</legend>
                <form id="imgUpload" method="post" action="" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" name="title" />
                    <label for="description">Description:</label>
                    <textarea name="description"></textarea>
                    <label for="img">Image*:</label>
                    <input type="file" name="img" required/>
                    <?php
                    //If form submitted
                    if(isset($errors)){
                        if(empty($errors)){ //No errors
                            echo "<p>Your image has been uploaded</p>";
                        }
                        else{
                            echo "<p>";
                            foreach($errors as $e){
                                echo "$e<br>";
                            }
                            echo "</p>";
                        }
                    }
                    //End If form submitted
                ?>
                    <input type="submit" value="Upload"/>
                </form>
            </fieldset>
        </main>
        
        <?php include "footer.php" ?>
    </div>
</body>
</html>