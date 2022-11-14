<?php 

	include('config/db_connect.php');
    //delete
    if(isset($_POST['delete'])){

		$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

		$sql = "DELETE FROM viewers WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)){
			header('Location: index.php');
		} else {
			echo 'query error: '. mysqli_error($conn);
		}

	}
	// check GET request id param
	if(isset($_GET['id'])){
		
		// escape sql chars
		$id = mysqli_real_escape_string($conn, $_GET['id']);

		// make sql
		$sql = "SELECT * FROM viewers WHERE id = $id";

		// get the query result
		$result = mysqli_query($conn, $sql);

		// fetch result in array format
		$viewer = mysqli_fetch_assoc($result);

		mysqli_free_result($result);
		mysqli_close($conn);

	}

?>

<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

	<div class="container center">
		<?php if($viewer): ?>
			<h4><?php echo $viewer['Name']; ?></h4>
			<p>Email: <?php echo $viewer['email']; ?></p>
			<p>Registered at: <?php echo date($viewer['time_stamp']); ?></p>
			<h5>Contact Number:</h5>
			<p><?php echo $viewer['number']; ?></p>
            <form action="details.php" method="POST">
				<input type="hidden" name="id_to_delete" value="<?php echo $viewer['id']; ?>">
				<input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
			</form>

		<?php else: ?>
			<h5>No such guest exists.</h5>
		<?php endif ?>
	</div>

	<?php include('templates/footer.php'); ?>

</html>