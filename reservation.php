<?php
 include_once 'header.php';


?>
<section class="main-container"> 
	<div class="main-wrapper">
    
		<h2>Онлайн Резервация За Хотел</h2>"
				<form class="signup-form" action="includes/reservation.inc.php" method="POST">
			<input type="text" name="first" placeholder="Първото ви име">
			<input type="text" name="last" placeholder="Фамилията ви">
			<input type="text" name="email" placeholder="E-mail">
            <input type="text" name="people" placeholder="Стая за колко души">
			<input placeholder="Check in" name="checkin" class="textbox-n" type="text" onfocus="(this.type='date')"  id="datein"> 
			<input placeholder="Check out" name="checkout" class="textbox-n" type="text" onfocus="(this.type='date')"  id="dateout"> 
			<button type="submit" name="submit">Резервация</button>
        </form>
        
		<h2>Home</h2>
		<?php
          if (isset($_SESSION['u_id'])) {           
          	echo "You are logggin";
          }
		?>
	</div>

</section>

<?php
 include_once 'footer.php';


?>