<?php
//Стартирване на сесията
session_start();
if (isset ($_POST['submit'])){
     //вмъкване на файла за сървара
	include 'dbh.inc.php';
     //взимане на парола и username
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
	
	//проверяване дали не въведено празно поле за данни
	if(empty($uid) || empty($pwd)) {
		header("Location: ../index.php?login=empty");
	     exit();

	}else{
		//избира от базата таблиза users и проврява за username или email
          $sql = "SELECT * FROM users WHERE user_uid='$uid' OR user_email='$uid'";
          $result = mysqli_query($conn, $sql);
          $resultCheck = mysqli_num_rows($result);
          //ако е грешно нещо с username дава грешка
         if ($resultCheck < 1) {
         	header("Location: ../index.php?login=erorr");
	     exit();
         }else{
         	if ($row = mysqli_fetch_assoc($result)) {
         		// de-hashing преобръща хешинга на паролата
				 $hashedPwdCheck = password_verify($pwd, $row ['user_pwd']);
				 //ако има грешка дава ерор
         		if ($hashedPwdCheck == false) {
         			header("Location: ../index.php?login=erorr");
	                  exit();
         		}elseif ($hashedPwdCheck == true){
         			//влиза в системата с избрания user
         			$_SESSION['u_id'] = $row['user_id'];
         			$_SESSION['u_first'] = $row['user_first'];
         			$_SESSION['u_last'] = $row['user_last'];
         			$_SESSION['u_email'] = $row['user_email'];
					 $_SESSION['u_uid'] = $row['user_uid'];
					 //Избрал съм този user да влиза в администраторската страница
					 if ($uid === tanev) {
						header("Location: ../admin.php?login=success");
						 exit();
					}
         			header("Location: ../reservation.php?login=success");
	                  exit();

         		}
         	}
         }
	}
}else{
	header("Location: ../signup.php?signup=erorr");
	     exit();
}