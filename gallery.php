<?php
    include "header.php";
    
    //Connect to database
    @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
    
    if ($db->connect_error) {  //if it was an error
        echo "Could not connect: " . $db->connect_error;
        exit();
    }
    //Connect to database end
    
    
    //Get file names
    $query = "SELECT imageID, fileName FROM Image";
    $stmt = $db->prepare($query);
    $stmt->bind_result($imageID, $fileName);
    $stmt->execute();
    //End Get file names
?>
        
        <main>
            <h2>Gallery</h2>
            <div id="gallery">
                <?php
                    while($stmt->fetch()){
                        echo "<a href='image.php?img=$imageID'><img src='uploads/$fileName'></a>";
                    }
                ?>
            </div>
        </main>
        
        <?php include "footer.php" ?>
    </div>
</body>
</html>