 <?php
 //test_site php scrip...
    
    //including database login parameters...
    include_once "db_parameters.php";
 
    $db_conn = mysqli_connect($db_hostname, $db_username, $db_password) or die("Connection Failed");
        mysqli_select_db($db_conn, $db_database) or die('Unable to connect to Database');

/*
    $query = "SELECT * FROM Trial_1";
    $result = mysqli_query($db_conn, $query);
        if(!$result){
            die("Database Access Failed". mysqli_error());
        }

       $rows = mysqli_num_rows($result); 
        if($rows > 0){
            //output data of each row...
            while($row = mysqli_fetch_assoc($result)){
                echo 'ID: ' . $row["id"] . "<br />" . 'User Name: ' . $row["username"] . '<br />' . 'Password: ' . $row["password"] .'<br><br>' ;  
            }

        }  else {
            echo "Zero results...";
        }
    
    
*/

//*********************loading data*******==WORKS PERFECTLY FINE==************* */

$username = $password = 0;
/*
        if($_SERVER['REQUEST_METHOD'] == POST){
            $username = $_POST['username'];
            $password = $_POST['password'];
        }

$query = "INSERT INTO Trial_1 (username, password) values('$username', '$password')";
        if(!mysqli_query($db_conn, $query)){
            echo "Query execution failed...";
        } else {
            echo "Simple congrats...!";
        }
*/
if(isset($_POST['username']) && isset($_POST['delete'])){
    $username = $_POST['username'];
    $del_query = "DELETE FROM Trial_1 WHERE username='$username'";
        if(!mysqli_query($db_conn, $del_query)){
            echo "Unable to initiate delete...";
        } else {
            echo "delete successfull";
        }
}

if(($_SERVER['REQUEST_METHOD'] == POST) && isset($_POST['username']) && isset($_POST['password']) ){
    $username = $_POST['username'];
    $password = $_POST['password'];
      $insert_query = "INSERT INTO Trial_1 (username, password) value('$username', '$password')";
        if(!mysqli_query($db_conn, $insert_query)){
            echo "Fail to insert data"; 
        } else {
            echo "Insert operation successful!";
        }
} else {
//    echo "Fatal Error!";
}
                echo <<<_END
                <form action="test_site_php.php" method = "POST">
                <fieldset style="width: fit-content; background-color:green;">
                <p style="margin-left:">Simple Login!</p> <br>
                Username: <input type="text" name = "username" style="background-color:black; color: red; height:25px"><br><br>
                Password: <input type="password" name = "password" style="background-color:black; color: red; height:25px"><br><br>
                <input type="submit" value="Execute !">
                </fieldset>

                </form>
                _END;

//******************************displaying data*************** */

$select_query = "SELECT * FROM Trial_1";
$result = mysqli_query($db_conn, $select_query);
    if(!$result) die("database access failed");
        $rows = mysqli_num_rows($result);
            for($j = 0; $j<$rows; ++$j){
                $row = mysqli_fetch_row($result);
                    echo <<<_END
                        <pre>
                            ID:       $row[0];
                            UserName: $row[1];
                            PassWord: $row[2];
                        </pre>
                        <form action="test_site_php.php" method = "POST">
                        <input type="hidden" name = "delete" value="yes"><br><br>
                        <input type="hidden" name = "username" value="$row[1]"><br><br>
                        <input type="submit" value="Delete Record!">
                        </form>
                    _END;
            }

//*************mysqli built-in sanitize-input************** */
function sanitize($input){
    return mysqli_real_escape_string($input);
}














mysqli_close($db_conn);
 ?>