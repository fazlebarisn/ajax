<?php
$studentId = $_POST["id"];

$conn = mysqli_connect('localhost' , 'root' , '' , 'learnajax') or die('Connection Faild');
$sql = "DELETE FROM students WHERE id={$studentId}";
//$sql = "DELETE FROM students";
//$result = mysqli_query( $conn , $sql ) or die( 'SQL quary faild!');
if( mysqli_query( $conn , $sql ) ){
    echo 1;
}else{
    echo 0;
}