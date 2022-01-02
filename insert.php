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
            <div id="error-message"></div>
            <div id="success-message"></div> 
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

                    console.log(first_name,last_name,city);

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
                            //console.log(data);
                            if( data == 1 ){
                                loadData();;
                                $("#success-message").html("Data inserted successfully!").slideDown();
                                $("#insert-form").trigger("reset");
                            }else{
                                $("#error-message").html("Can't save data!").slideDown();
                            }
                        }
                    });
                    }
                });

                // delete data
                $(document).on("click" , ".delete-btn" , function(){

                    let studentId = $(this).data("id");
                    let element = this;
                    //console.log(studentId);
                    $.ajax({
                        url : "ajax-delete.php",
                        data : "POST",
                        data : {id:studentId},
                        success : function(data){
                            if( data == 1 ){
                                $(element).closest("tr").fadeOut();
                            }else{
                                console.log('connection error');
                                //console.log(studentId);
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>