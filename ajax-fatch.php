<?php
$conn = mysqli_connect('localhost' , 'root' , '' , 'learnajax') or die('Connection Faild');
$sql = 'SELECT * FROM students';
$result = mysqli_query( $conn , $sql ) or die( 'SQL quary faild!');
$output = '';

if( mysqli_num_rows($result) > 0 ){

    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
            <tr>
                <th>Name</th>
                <th>City</th>
                <th>Delete</th>
            </tr>
            ';
            while( $row = mysqli_fetch_assoc( $result ) ){
                $output.= "<tr><td>{$row["first_name"]} {$row["last_name"]}</td><td>{$row["city"]}</td><td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
            }
    $output.= '</table>';

    mysqli_close($conn);

    echo $output;

}else{
    echo "NO recod found";
}

?>
