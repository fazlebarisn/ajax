<?php
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$city = $_POST['city'];

$conn = mysqli_connect('localhost' , 'root' , '' , 'learnajax') or die('Connection Faild');
$sql = "INSERT INTO students(frist_name,last_name,city) VALUES('{$first_name}','{$last_name}','{$city}')";
// $result = mysqli_query( $conn , $sql ) or die( 'SQL quary faild!');

if( mysqli_query( $conn , $sql ) ){
    echo 1;
}else{
    echo 0;
}