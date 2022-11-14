<?php
    //connect to database
    include('config/db_connect.php');
    // queries

    //all viewers

    $sql = 'SELECT Name, Location, Time, Date, Information, id  FROM festivals ORDER BY time_stamp';

    //make query and store result
    $result = mysqli_query($conn, $sql);

    //fetch resulting rows
    $festivals = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free space from memnory
    mysqli_free_result($result);

    //close
    mysqli_close($conn);

?>


<!DOCTYPE html>
<html>

	<?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Welcome! Browse the various music festivals and book the one that suits your music taste the most!</h4>
    <div class="container">
    <div class="row">

        <?php foreach($festivals as $festival): ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($festival['Name']); ?></h6>
                        <div><?php echo htmlspecialchars($festival['Location']); ?></div>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="fest_dets.php?id=<?php echo $festival['id'] ?>">more info</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>
	<?php include('templates/footer.php'); ?>

</html>