<?php
$conn = mysqli_connect('localhost', 'hetansh', 'test1234', 'music_festival');
if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}
?>