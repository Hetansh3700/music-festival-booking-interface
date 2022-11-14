<?php
    //connect to database
    include('config/db_connect.php');
    // queries

    //all viewers

    $sql = 'SELECT Name, email, number, id  FROM viewers ORDER BY time_stamp';

    //make query and store result
    $result = mysqli_query($conn, $sql);

    //fetch resulting rows
    $viewers = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free space from memnory
    mysqli_free_result($result);

    //close
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>
<h4 class="center grey-text">Viewers visiting</h4>

<div class="container">
    <div class="row">

        <?php foreach($viewers as $viewer): ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($viewer['Name']); ?></h6>
                        <div><?php echo htmlspecialchars($viewer['number']); ?></div>
                    </div>
                    <div class="card-action right-align">
                        <a class="brand-text" href="details.php?id=<?php echo $viewer['id'] ?>">more info</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>

<?php include('templates/footer.php'); ?>
    
</body>
</html>