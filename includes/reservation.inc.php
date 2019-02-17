<?php
if (isset($_POST['submit'])) {
	include_once 'dbh.inc.php';
	$first = mysqli_real_escape_string ($conn, $_POST['first']);
	$last = mysqli_real_escape_string ($conn, $_POST['last']);
	$email = mysqli_real_escape_string ($conn, $_POST['email']);
    $people = mysqli_real_escape_string($conn,$_POST['people']);
    $dateIn = mysqli_real_escape_string($conn,$_POST['dateIn']);
    $dateOut = mysqli_real_escape_string($conn,$_POST['dateOut']);

    //Проверка за празно поле
    if (empty($first) || empty($last) || empty($email)|| empty($people)|| empty($dateIn)|| empty($dateOut)) {
    	header("Location: ../reservation.php?signup=empty");
	     exit();
    }
  
       //Проверка за имената
    else{ if(!preg_match("/^[a-zA-Z]*$/",$first)  || !preg_match("/^[a-zA-Z]*$/",$last)) {
    		header("Location: ../reservation.php?signup=invalid");
    		exit();

    	
	}else{
    		//проверка за майла
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    	        header("Location: ../reservation.php?signup=email");
                 exit();
        	     }
    	           else{

                    $sql = "INSERT INTO Reservation (user_first, user_last, user_email, user_dateIn, user_dateOut,user_people) VALUES ('$first','$last','$email','$dateIn','$dateOut','$people');";
    			mysqli_query($conn, $sql);
    			header("Location: ../reservation.php?signup=success");
    		exit();

            }
     	
		}

    }
	
}	

else{
	header("Location: ../reservation.php");
	exit();
}