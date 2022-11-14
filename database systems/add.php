<?php
	include('config/db_connect.php');

	$email = $name = $number = '';
	$errors = array('email' => '', 'name' => '', 'number' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
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

		// check ingredients
		if(empty($_POST['number'])){
			$errors['number'] = 'Contact number is required';
		} else{
			$number = $_POST['number'];
			if(!preg_match('/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/', $number)){
				$errors['number'] = 'Contact number must be of form xxx-yyy-zzzz';
			}
		}
		if(array_filter($errors)){
			//errors
		} else {
			// escape sql chars
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$number = mysqli_real_escape_string($conn, $_POST['number']);

			// create sql
			$sql = "INSERT INTO viewers(Name,email,number) VALUES('$name','$email','$number')";

			// save to db and check
			if(mysqli_query($conn, $sql)){
				header('Location: index.php');
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
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>
			<label>Name</label>
			<input type="text" name="name" value="<?php echo htmlspecialchars($name) ?>">
			<div class="red-text"><?php echo $errors['name']; ?></div>
			<label>Contact Number</label>
			<input type="text" name="number" value="<?php echo htmlspecialchars($number) ?>">
			<div class="red-text"><?php echo $errors['number']; ?></div>
			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>
<?php include('templates/footer.php'); ?>
    
</body>
</html>