<?php

include_once 'db_parameters.php';

$conn = new mysqli($db_hostname, $db_username, $db_password, 'Samp');
    if($conn->connect_error) die ("Error! " . $conn->connect_error);

//==========================================================================

    //create table query
/*
    $crte_query = "CREATE TABLE cats (
        id SMALLINT NOT NULL AUTO_INCREMENT,
        name VARCHAR(32) NOT NULL,
        family VARCHAR(32) NOT NULL,
        age TINYINT NOT NULL,
        PRIMARY KEY (id)
    )";

        $res = $conn->query($crte_query);
            if(!$res){
                echo $conn->error;
            }

*/
//==========================================================================

    //verifying table creation from inside a browser
    //code to be analyzed later
/*    
    $des_query = "DESCRIBE cats";
    $res = $conn->query($des_query);
        if(!$res) die ($conn->error);

            $rows = mysqli_num_rows();
            echo <<<_END
            <table>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Null</th>
                    <th>Key</th>
                </tr>
                
                for($i = 0; $i < $rows; $i++){
                    $row_array = mysqli_fetch_row($res);
                        <tr>
                            for($j = 0; $j < 4; $j++){
                                <td>$row_array[$j]</td>
                            }
                        </tr>
                }

            </table>
            _END;
*/
//==========================================================================
/*
    //insert Query  AND getting last id using PREPARED
//prepare and bind
    $ins_query = $conn->prepare("INSERT INTO cats VALUES(?, ?, ?, ?)");
    $ins_query->bind_param("issi", $id, $name, $family, $age );
//setting parameters and execute
    $id = NULL;
    $name = 'Vicar';
    $family = 'Amiens';
    $age = 3;
        $ins_query->execute();

        if($conn->error){
            echo "Error populationg table";
        } else {
            echo "CONGRATS...!   " . "The 'ID' for this Animal is: " . $conn->insert_id;
        }
    $ins_query->close();
*/
//==========================================================================
  
/*
   //retrieve (data) query
   $sel_query = "SELECT * FROM cats";
    $res = $conn->query($sel_query);
    $rows = mysqli_num_rows($res);
        echo '
            <table style="border:1px solid red; padding: 10px;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Family</th>
                    <th>Age</th>
                </tr>

            ';

            for($i = 0; $i < $rows; $i++){
                $row_array = mysqli_fetch_row($res);
              /*  echo "
                    <tr>
                        <td>$row_array[0]</td>
                        <td>$row_array[1]</td>
                        <td>$row_array[2]</td>
                        <td>$row_array[3]</td>
                    </tr>
                ";
              *//*

                  echo "<tr>";
                    for($j = 0; $j < 4; $j++){echo "<td>$row_array[$j]</td>";}   
                  echo "</tr>";

            }

           echo " </table> ";
 
        /*
        for($i = 0; $i < $rows; $i++){
            $row_array = mysqli_fetch_row($res);
                echo <<<_END
                <pre>
                ID:     $row_array[0]
                Name:   $row_array[1]
                Family: $row_array[2]
                Age:    $row_array[3]
                </pre>
                _END;
        */
//==========================================================================

    //update query
/*
    $upd_query = "UPDATE cats SET name = 'Charlieeee' WHERE id = 2";
    $conn->query($upd_query);
*/
        
//==========================================================================
//==========================================================================
//==========================================================================
//==========================FORM HANDLING===================================

    //form building
    echo <<<_END
    <html>
    <head>
        <title>Form Building</title>
    </head>
    <body>
        <pre>
        <form method="post" action="practical_mysql.php">
            What is your name?

            <input type="text" name="name" />

            <input type="submit" />
        </form>
        </pre>
    </body>
    </html>
    _END;

    if(($_SERVER["REQUEST_METHOD"] == POST) && isset($_POST["name"])){
        $name = $_POST["name"];
        echo"<script>alert('Welcom! $name...')</script>";
    } else {echo'<script>alert("We don\'t know your name")</script>';}












$conn->close();

