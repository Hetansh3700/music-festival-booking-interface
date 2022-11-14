<?php
	include('config/db_connect.php');

	$location = $name = $date = $time = $information = '';
	$errors = array('name' => '', 'location' => '', 'date' => '', 'time' => '', 'information' => '');

	if(isset($_POST['submit'])){
		
		// check location
		if(empty($_POST['location'])){
			$errors['location'] = 'A location is required';
		} else{
			$location = $_POST['location'];
			if(!preg_match('/^[a-zA-Z0-9\s,]+$/', $location)){
				$errors['location'] = 'Location must be a valid';
			}
		}

		// check name
		if(empty($_POST['name'])){
			$errors['name'] = 'A name is required';
		} else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
				$errors['name'] = 'Name must be letters and spaces only';
			} 
		}

		// check date
		if(empty($_POST['date'])){
			$errors['date'] = 'Date is required';
		} else{
			$date = $_POST['date'];
			if(!preg_match('/^[a-zA-Z0-9\s\/]+$/', $date)){
				$errors['date'] = 'Date must be of form mm/dd/yyyy';
			}
		}
        if(empty($_POST['time'])){
			$errors['time'] = 'Time is required';
		} else{
			$time = $_POST['time'];
			if(!preg_match('/^[a-zA-Z\s0-9:-]+$/', $time)){
				$errors['time'] = 'Time must be of form';
			}
		}
        if(empty($_POST['information'])){
			$errors['information'] = 'Information is required';
		} else{
			$information = $_POST['information'];
			if(!preg_match('/^(?!\s*$).+/', $information)){
				$errors['information'] = 'Information must be valid';
			}
		}
		if(array_filter($errors)){
			//errors
		} else {
			// escape sql chars
			$location = mysqli_real_escape_string($conn, $_POST['location']);
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$date = mysqli_real_escape_string($conn, $_POST['date']);
            $time = mysqli_real_escape_string($conn, $_POST['time']);
            $information = mysqli_real_escape_string($conn, $_POST['information']);

			// create sql
			$sql = "INSERT INTO festivals(Name,Location,Time,Date,Information) VALUES('$name','$location','$time','$date','$information')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				header('Location: home.php');
			} else {
				echo 'query error: '. mysqli_error($conn);
			}
		}

	} // end POST check

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<section class="container grey-text">
		<h4 class="center">Let's get you a place!</h4>
		<form class="white" action="add_fest.php" method="POST">
            <label>Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>
			<label>Location</label>
			<input type="text" name="location" value="<?php echo htmlspecialchars($location) ?>">
			<div class="red-text"><?php echo $errors['location']; ?></div>
            <label>Date</label>
			<input type="text" name="date" value="<?php echo htmlspecialchars($date) ?>">
			<div class="red-text"><?php echo $errors['date']; ?></div>
            <label>Time</label>
			<input type="text" name="time" value="<?php echo htmlspecialchars($time) ?>">
			<div class="red-text"><?php echo $errors['time']; ?></div>
			<label>Information</label>
			<input type="text" name="information" value="<?php echo htmlspecialchars($information) ?>">
			<div class="red-text"><?php echo $errors['information']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
<?php include('templates/footer.php'); ?>
    
</body>
</html>