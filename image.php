<?php
    include "header.php";
    
    //Connect to database
    @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
    
    if ($db->connect_error) {  //if it was an error
        echo "Could not connect: " . $db->connect_error;
        exit();
    }
    //Connect to database end
?>
        
        <main id="galleryimage">
            <h2>Gallery</h2>
            <a id="back" href="gallery.php">< Go back</a>
            <div id="imgContainer">
                <figure id="imgBox">
                    <?php
                        if(isset($_GET['img'])){
                            $id = $_GET['img'];
                            $query = "SELECT fileName, title, description
                            FROM Image
                            WHERE imageID = '$id'";
                            
                            $stmt = $db->prepare($query);
                            $stmt->bind_result($fileName, $title, $description);
                            $stmt->execute();
                            
                            $stmt->fetch();
                            echo "<img src='uploads/$fileName'>";
                            if($title != "" || $description != ""){
                                echo "<figcaption>";
                            }
                            if($title != ""){
                                echo "<h4>$title</h4>";
                            }
                            if($description != ""){
                                echo "<p>$description</>";
                            }
                            if($title != "" || $description != ""){
                                echo "</figcaption>";
                            }
                        }
                    ?>
                </figure>
            </div>
        </main>
        
        <?php include "footer.php" ?>
    </div>
</body>
</html>