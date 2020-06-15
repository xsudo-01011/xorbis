<?php
    //login parameters
    include_once 'db_parameters.php';

    //connection string
    $conn = new mysqli($db_hostname, $db_username, $db_password, 'Samp');
        if($conn->connect_error){
            echo ("Failed to connect to mysql (" . $conn->connect_error) . ")";
        } 

    /*
        //create table query
        $tbl_query = "CREATE TABLE Multi (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, username varchar(20), email varchar(20))";
            if(!$conn->query($tbl_query)){
                echo "table create unsuccessful " . $conn->error;
            }

    */


    //variables declaration...
    $id = $username = $email = 0;

    //the subscribe form...
    echo <<<_END
<form action="test_site_mysqli_oop.php" method="POST">
    <fieldset style="width:fit-content">
    <pre>
      User Name: <input type="text" name="name" style="background-color:black; color: red; height:27px; font-size:15px;"/> <br>
      E-mail:    <input type="email" name="email" style="background-color:black; color: red; height:27px; font-size:15px;""/> 
    
      <input type="submit" value="Subscribe"/>
    </pre>
    </fieldset>
    </form>
_END;

    //collecting data...
    if($_SERVER['REQUEST_METHOD'] == POST){
        $username = $_POST['name'];
        $email = $_POST['email'];
            //insert query
            $ins_query = "INSERT INTO Multi (username, email) VALUES('$username', '$email')";
                if(!$conn->query($ins_query)){
                    die($conn->error);
                } else {
                    echo "<script>alert('Subscription Success...!')</script>";
                }
    }

    //displaying the data... 
    $sel_query = "SELECT * FROM Multi";
    $res = $conn->query($sel_query);
        if($conn->error){
            echo  $conn->error;
        }
/*
            $rows = mysqli_num_rows($res);
            for($i = 0; $i < $rows; $i++){
                $row_array = mysqli_fetch_row($res);
echo <<<_END
 <pre>
    Subscriber ID:    $row_array[0]
    Subscriber Name:  $row_array[1]
    Subscriber Email: $row_array[2]
 </pre>
 _END;
        }
*/  

    $rows = mysqli_num_rows($res);
        $i = 0;
            while($i < $rows){
                $row_ass_array = $res->fetch_assoc();
                    $arr_id = $row_ass_array['id'];
                    $arr_username = $row_ass_array['username'];
                    $arr_email = $row_ass_array['email'];
echo <<<_END
 <pre>
    Subscriber ID:    $arr_id
    User Name:        $arr_username
    E - Mail:         $arr_email
 </pre>
_END;

                $i++;


                //unsubscribe form
    echo <<<_END
    <form action="test_site_mysqli_oop.php" method="POST">
    <pre>
     <input type="hidden" name="delete" value="delete" />
     <input type="hidden" name="id" value="$arr_id" />
     <input type="submit" value="Unsubscribe">
    </pre>
    </form>
    _END;
            }

    //delete query block
    if(($_SERVER['REQUEST_METHOD'] == POST) && isset($_POST['delete']) && isset($_POST['id'])){
        $id = $_POST['id'];
            //delete query
            $del_query = "DELETE FROM Multi WHERE id='$id'";
                if(!$conn->query($del_query)){
                    echo $conn->error;
                } else {
                    echo "<script>alert('You've successfully unsubscribed!')</script>";
                }
    }


    $conn->close();
?>