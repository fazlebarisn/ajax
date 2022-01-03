<?php

$studentId = $_POST["id"];

$conn = mysqli_connect("localhost" , "root" , "" , "learnajax") or die("Connection Faild");
$sql = "SELECT * FROM students WHERE id = {$studentId}";
$result = mysqli_query( $conn , $sql ) or die( "SQL quary faild!" );
$output = "";

if( mysqli_num_rows($result) > 0 ){

    $output = "";

        while( $row = mysqli_fetch_assoc( $result ) ){
            $output.="
                <tr>
                    <td>First Name</td>
                    <td><input type='text' id='edit-fname' value='{$row["first_name"]}'></td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type='text' id='edit-lname' value='{$row["last_name"]}'></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><input type='text' id='edit-city' value='{$row["city"]}'></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type='submit' id='edit-submit' value='Update'></td>
                </tr>
            ";
        }
    

    mysqli_close($conn);

    echo $output;

}else{
    echo "NO recod found";
}

?>
