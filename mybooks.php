<?php
    include "header.php";
    
    //Connect to database
    @ $db = new mysqli($dbserver, $dbuser, $dbpass, $dbname);
            
    if ($db->connect_error) {  //if it was an error
        echo "Could not connect: " . $db->connect_error;
        exit();
    }
    //End Connect to database
    
    
    //Variables
    $bookArray = array();
    $authors = array();
    //End Variables
    
    
    //Return book
    if(isset($_GET['bookID'])){
        $bookID = $_GET['bookID'];
        $query="UPDATE Library
        SET borrowed = 0
        WHERE bookID = $bookID";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    //End Return book
    
    
    //Retrieve borrowed books
    $query = "SELECT bookID FROM Library
    WHERE borrowed = 1";
    
    $stmt = $db->prepare($query);
    $stmt->bind_result($bookID);
    $stmt->execute();
    
    while($stmt->fetch()){
        array_push($bookArray, $bookID);
    }
    //End Retrieve borrowed books

?>

        <main>
            <h2>My books</h2>
            <?php
                if(count($bookArray) > 0){  //If there are any books to show, echo a table
                    echo"<table>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Shelf</th>
                                <th></th>
                            </tr>";
                }
                else{
                    echo "<p>You have no reserved books. Go to <a href='browse.php'>Browse books</a> to find books to reserve.</p>";
                }
                    
                foreach($bookArray as $id){
                            
                    $query ="SELECT Book.title, Book.edition, Book.pubYear, Book.publisher, Author.firstName, Author.lastName, Library.shelf FROM Book
                    JOIN AuthorBook ON Book.bookID = AuthorBook.bookID
                    JOIN Author ON AuthorBook.authorID = Author.authorID
                    JOIN Library ON Book.bookID = Library.bookID
                    WHERE Book.bookID = $id";
                            
                    $stmt = $db->prepare($query);
                    $stmt->bind_result($title, $edition, $pubYear, $publisher, $firstName, $lastName, $shelf);
                    $stmt->execute();
                            
                    while ($stmt->fetch()) {
                        $fullName = $firstName. " " .$lastName;
                        array_push($authors, $fullName);
                    }
                            
                    $i = 0;
                            
                    echo    "<tr>
                                <td>
                                    <p>$title</p>
                                    <p>Edition $edition</p>
                                    <p>$publisher, $pubYear</p>
                                </td>
                                <td>";
                    foreach($authors as $a){
                        if($i == 0){
                            echo $a;
                        }
                        else{
                            echo ", ". $a;
                        }
                        $i ++;
                    }
                            
                    echo        "</td>
                                <td>$shelf</td>
                                <td>
                                    <form method='get' action=''>
                                        <button name='bookID' value='" . $id . "'>Return</button>
                                    </form>
                                </td>
                            </tr>";
                            
                    $authors = array();
                }
                        
                echo"</table>"
            ?>
        </main>
        
        <?php include "footer.php" ?>
    </div>
</body>
</html>