<?php
	//********all neccessary funtions required*******
	
	//**including the database connection parameters**
	// 	require_once "db_parameters.php";
	$db_hostname = 'localhost';             //******host on which the database is located*********
        $db_username = 'xsudo';         //********database username************
        $db_password = '0070502580';    //********database password*******
        $db_database = 'xsudo_orbis';   //******actual database name*******
        $appname = 'Xsudo Orbis';       //*********name of application**********


	//***issueing the connection script****
	$db_connect = mysqli_connect($db_hostname, $db_username, $db_password, $db_database) or die("Connectino Error! ".mysqli_connect_error());
		
//(1)	//create table
		function tbl_create($name, $sql){
		   queryMysql("CREATE TABLE IF NOT EXISTS $name($sql)");
		   echo "Table '$name' created or already exists.<br />";
		}
		
//(2)	//*****function to handle sql queries*********
		function queryMysql($sql){
			$result = mysqli_query($sql) or die(mysqli_error());
			return $result;
		}
		
		
//(3)	//********destroy section**********
	function destroySession(){
		$_SESSION=array();
			if (session_id() != "" || isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-2592000, '/');
			session_destroy();
			}
	
//(4)	//*********sanitize strings*********
	function sanitize_input($input){
		$input = htmlspecialchars($input);
		$input = trim($input);
		$input = stripslashes($input);
		$input = strip_tags($input);
		return mysql_real_escape_string($input);
	}
		
		
//(5)	//*********showing user profiles******
		
	function showProfile($user){
		if (file_exists("$user.jpg"))
			echo "<img src='$user.jpg' align='left' />";
			$result = queryMysql("SELECT * FROM profiles WHERE user='$user'");
		}.....................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................

		if (mysql_num_rows($result)){
			$row = mysql_fetch_row($result);
			echo stripslashes($row[1]) . "<br clear=left /><br/>";
		}

	mysqli_close($db_connect);
	
?>
