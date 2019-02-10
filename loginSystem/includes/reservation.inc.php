<?php
if (isset($_POST['submit'])) {
	include_once 'dbh.inc.php';
	$first = mysqli_real_escape_string ($conn, $_POST['first']);
	$last = mysqli_real_escape_string ($conn, $_POST['last']);
	$email = mysqli_real_escape_string ($conn, $_POST['email']);
    $room = mysqli_real_escape_string($conn,$_POST['room']);
    $date = mysqli_real_escape_string($conn,$_POST['date']);

    //Erroo handles
    //check for empty field
    if (empty($first) || empty($last) || empty($email)|| empty($room)|| empty($date)) {
    	header("Location: ../reservation.php?signup=empty");
	     exit();
    }
  
       //Check if input chacrckter are valid
    else{ if(!preg_match("/^[a-zA-Z]*$/",$first)  || !preg_match("/^[a-zA-Z]*$/",$last)) {
    		header("Location: ../reservation.php?signup=invalid");
    		exit();

    	
	}else{
		if (!preg_match("/^(([1-9])|(0[1-9])|(1[0-2]))\/((0[1-9])|([1-31]))\/((\d{2})|(\d{4}))$/",$date)){
			header("Location: ../reservation.php?signup=datainvalid");
    		exit();

		}
	
	else{
    		//check email is valid
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    	        header("Location: ../reservation.php?signup=email");
                 exit();
        	     }
    	           else{

                    $sql = "INSERT INTO reservation (user_first, user_last, user_email, user_room, user_date) VALUES ('$first','$last','$email','$room','$date');";
    			mysqli_query($conn, $sql);
    			header("Location: ../reservation.php?signup=success");
    		exit();

                }
     	
         

            }
		}
	}
}
else{
	header("Location: ../reservation.php");
	exit();
}