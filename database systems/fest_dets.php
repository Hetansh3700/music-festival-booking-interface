<?php 

	include('config/db_connect.php');
    //delete
    if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM festivals WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: home.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}
	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM festivals WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$festival = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if($festival): ?>
			<h4><?php echo $festival['Name']; ?></h4>
			<p>Location: <?php echo $festival['Location']; ?></p>
			<h5>Time: </h5>
			<p><?php echo $festival['Time']; ?></p>
            <h5>Date: </h5>
			<p><?php echo $festival['Date']; ?></p>
            <h5>Information: </h5>
			<p><?php echo $festival['Information']; ?></p>
            <form action="fest_dets.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $festival['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
                <li><a href="add.php" class="btn brand z-depth-0 margin-5">Register</a></li>
			</form>



		<?php else: ?>
			<h5>No such festival exists.</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php'); ?>

</html>