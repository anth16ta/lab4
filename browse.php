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
    $searchtitle = "";
    $searchauthor = "";
    $bookArray = array();
    $authors = array();
    //Variables end
    
    
    //Reserve book
    if(isset($_GET['bookID'])){
        $bookID = $_GET['bookID'];
        $query="UPDATE Library
        SET borrowed = 1
        WHERE bookID = $bookID";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    //Reserve book end
    
    
    //Search book
    if(isset($_POST) && !empty($_POST)){
        $searchtitle = trim($_POST["title"]);
        $searchauthor = trim($_POST["author"]);
    }
    
    $query = "SELECT Book.bookID FROM Book
    JOIN AuthorBook ON Book.bookID = AuthorBook.bookID
    JOIN Author ON AuthorBook.authorID = Author.authorID";
    
    if($searchtitle && !$searchauthor){ //Search by title
        $query = $query . " WHERE Book.title LIKE '%" . $searchtitle . "%'";
    }
    if(!$searchtitle && $searchauthor){ //Search by author
        $query = $query . " WHERE Author.firstName LIKE '%" . $searchauthor . "%'";
    }
    if($searchtitle && $searchauthor){ //Search by both title and author
        $query = $query . " WHERE Book.title LIKE '%" . $searchtitle . "%' AND Author.firstName LIKE '%" . $searchauthor . "%'";
    }
    
    $stmt = $db->prepare($query);
    $stmt->bind_result($bookId);
    $stmt->execute();
    
    while ($stmt->fetch()) {
        array_push($bookArray, $bookId);
    }
    
    $bookArray = array_unique($bookArray);
    //End Search book

?>

        
        <main>
            <h2>Browse books</h2>
            <form id="searchform" method="post" action="">
                <div>
                    <input type="text" name="title" placeholder="Title">
                    <input type="text" name="author" placeholder="Author">                   
                </div>
                <input type="submit" value="Search">
            </form>
            
            <?php
                echo "<table>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Shelf<th>
                        </tr>";
                
                foreach($bookArray as $id){
                    $query ="SELECT Book.title, Book.edition, Book.pubYear, Book.publisher, Author.firstName, Author.lastName, Library.shelf, Library.borrowed
                    FROM Book
                    JOIN AuthorBook ON Book.bookID = AuthorBook.bookID
                    JOIN Author ON AuthorBook.authorID = Author.authorID
                    JOIN Library ON Book.bookID = Library.bookID
                    WHERE Book.bookID = $id";
                    
                    $stmt = $db->prepare($query);
                    $stmt->bind_result($title, $edition, $pubYear, $publisher, $firstName, $lastName, $shelf, $borrowed);
                    $stmt->execute();
                    
                    while ($stmt->fetch()) {
                        $fullName = $firstName. " " .$lastName;
                        array_push($authors, $fullName);
                    }
                    
                    $i = 0;
                    
                    echo "<tr>
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
                    
                    echo "  </td>
                            <td>$shelf</td>
                            <td>
                                <form method='get' action=''>";
                                    if($borrowed == 1){
                                        echo "<button name='bookID' value='" . $id . "' class='disabled' disabled>Reserved</button>";
                                    }
                                    else{
                                        echo "<button name='bookID' value='" . $id . "'>Reserve</button>";
                                    }
                                echo "</form>
                            </td>
                        </tr>";
                    $authors = array();
                }
                echo "</table>";

            ?>
        </main>
        
        <?php include "footer.php" ?>
    </div>
</body>
</html>