<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajax</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <h1>Insert Data</h1>
            <form id="insert-form">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name">
                <label for="city">City</label>
                <input type="text" id="city">
                <input type="button" id="insert-data" value="Add More"><br><br>
            </form><br><br>
            <div id="table">
            </div>
            <div id="success-message"></div>
            <div id="error-message"></div>
        </div>
        <script>
            $(document).ready( function(){

                function loadData(){
                    $.ajax({
                        url : 'ajax-fatch.php',
                        type : 'POST',
                        success : function( data ){
                            $('#table').html(data);
                        }
                    });                  
                }
                loadData();

                $('#insert-data').on('click' , function(e){

                    e.preventDefault();

                    let first_name = $('#first_name').val();
                    let last_name = $('#last_name').val();
                    let city = $('#city').val();

                    if( first_name =="" || last_name=="" || city == "" ){
                        $("#error-message").html("Al fiels are requered!").slideDown();
                    }else{
                        $.ajax({
                        url : 'ajax-insert.php',
                        type : 'post',
                        data : {
                            first_name:first_name,
                            last_name:last_name,
                            city:city,
                        },
                        success : function(data){
                            if( data == 1 ){
                                loadData()
                                $("#insert-form").trigger("reset");
                                $("#success-message").style("display","block").html("Data Inserted Successfully!");
                            }else{
                                $("#error-message").html("Can't save data!").slideDown();
                            }
                        }
                    });
                    }
                });
            });
        </script>
    </body>
</html>