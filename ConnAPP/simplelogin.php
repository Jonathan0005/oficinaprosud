<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");
       
        $username = $_POST['username'];
 	$password = $_POST['password'];
 	
	 if( $username == '' || $password == '' ){
	        echo json_encode(array( "status" => "false","message" => "Parameter missing!") );

	 }else{
	 	$query= "SELECT * FROM users WHERE usuario='$username' AND password='$password'";
	        $result= mysqli_query($con, $query);
		 
	        if(mysqli_num_rows($result) > 0){  
	         $query= "SELECT * FROM users WHERE usuario='$username' AND password='$password'";
	                     $result= mysqli_query($con, $query);
		             $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
	                     }
	           echo json_encode(array( "status" => "true","message" => "Ingreso Exitoso!", "data" => $emparray) );
	        }else{ 
	        	echo json_encode(array( "status" => "false","message" => "Usuario o contraseña incorrecta!") );
	        }
	         mysqli_close($con);
	 }
	} else{
			echo json_encode(array( "status" => "false","message" => "Intente Nuevamente!") );
	}
?>