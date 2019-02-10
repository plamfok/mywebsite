<?php
 include_once 'header.php';
 

?>
<section class="main-container"> 
	<div class="main-wrapper">
        <h2>Home</h2>
        <?php
include_once 'includes/dbh.inc.php';

$sql = "SELECT user_id, user_last, user_date FROM reservation";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["user_id"]. " - Name: " . $row["user_last"]. " " . $row["user_date"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?> 
		<?php
          if (isset($_SESSION['u_id'])) {
              echo "You are login admin";
                         
          }
		?>
	</div>

</section>

<?php
 include_once 'footer.php';


?>
