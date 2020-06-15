<?php
// login parameters.....
include_once 'db_parameters.php';

//connection string...
$db_conn = mysqli_connect($db_hostname, $db_username, $db_password) or die("Unable to initiate connection...!");
    mysqli_select_db($db_conn, $db_database) or die("unable to connect to database");

        //database variables
        $user_id =  $subscriber_name = $subscriber_email = 0;

        //the insert form
echo <<<_END
<form action="test_site.php" method="POST">
<fieldset style="width:fit-content">
<pre>
  User Name: <input type="text" name="name" style="background-color:black; color: red; height:27px; font-size:15px;"/> <br>
  E-mail:    <input type="email" name="email" style="background-color:black; color: red; height:27px; font-size:15px;""/> 

  <input type="submit" value="Subscribe"/>
</pre>
</fieldset>
</form>

_END;
        //collecting inputs to the database...
        if($_SERVER['REQUEST_METHOD'] == POST){
            $subscriber_name = $_POST['name'];
            $subscriber_email = $_POST['email'];
                //isert query
                $ins_query = "INSERT INTO Subscribers (subscriber_name, subscriber_email) VALUES('$subscriber_name', '$subscriber_email')";
                    if(!mysqli_query($db_conn, $ins_query)){
                        echo "Insert operation ERROR!";
                    } else {
                        echo "<script>alert('Subscription Success...!')</script>";
                    }
        }

        //displaying database data... 
        $sel_query = "SELECT * FROM Subscribers";
        $result = mysqli_query($db_conn, $sel_query);
            if(!$result){
                 echo "Fetch operation failed";
            }
        
            $rows = mysqli_num_rows($result);
                for($i = 0; $i < $rows; $i++){
                    $row_array = mysqli_fetch_row($result);
echo <<<_END
 <pre>
    Subscriber ID:    $row_array[0]
    Subscriber Name:  $row_array[1]
    Subscriber Email: $row_array[2]
 </pre>
_END;

            //unsubscription form...
            echo <<<_END
<form action="test_site.php" method="GET">
<pre>
 <input type="hidden" name="delete" value="yes" />
 <input type="hidden" name="id" value="$row_array[0]" />
 <input type="submit" value="Unsubscribe">
</pre>
</form>
_END;
                }


            //delete query block
            if(($_SERVER['REQUEST_METHOD'] == GET) && isset($_GET['delete']) && isset($_GET['id'])){
                $user_id = $_GET['id'];
                    $del_query = "DELETE FROM Subscribers WHERE user_id='$user_id'";
                        if(!mysqli_query($db_conn, $del_query)){
                            echo "Delete operation failed";
                        } else {
                            echo "<script>alert('You've successfully unsubscribed...!')</script>";
                        }
            }

















mysqli_close($db_conn);
?>