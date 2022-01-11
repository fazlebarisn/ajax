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
            <div id="search-bar">
                <label for="search">Search: </label>
                <input type="text" id="search" autocomplete="off">
            </div><br>
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
            <div id="modal">
                <div id="modal-form">
                    <h2>Edit Form</h2>
                    <table cellpadding="10px" width="100%">
                    </table>
                    <div id="close-btn">X</div>
                </div>
            </div>
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
                        type : 'POST',
                        data : {
                            first_name:first_name,
                            last_name:last_name,
                            city:city,
                        },
                        success : function(data){
                            //console.log(data);
                            if( data == 1 ){
                                loadData();
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
                    if(confirm("Do you really want to detete this?")){
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
                    }
                });

                // Edit data
                $(document).on("click" , ".edit-btn" , function(){
                    $("#modal").show();
                    let studentId = $(this).data('eid');

                    $.ajax({
                        url : "ajax-update-form.php",
                        type : "POST",
                        data : { id:studentId },
                        success : function(data){
                            $("#modal-form table").html(data);
                        }
                    });
                });

                // Hide Model box
                $('#close-btn').on('click' , function(){
                    $("#modal").hide();
                });

                // save update data
                $(document).on("click" , "#edit-submit" , function(){
                    let stuId = $('#edit-id').val();
                    let first_name = $('#edit-fname').val();
                    let last_name = $('#edit-lname').val();
                    let city = $('#edit-city').val();

                    $.ajax({
                        url : "ajax-save-update-data.php",
                        type : "POST",
                        data : {id:stuId,first_name:first_name,last_name:last_name,city:city},
                        success : function(data){
                            if(data == 1){
                                $("#modal").hide();
                                loadData();
                            }
                            
                        }
                    });
                });

                // Live search
                $("#search").on("keyup" , function(){
                    let search_term = $(this).val();
                    $.ajax({
                        url: "ajax-search.php",
                        type: "POST",
                        data: {search:search_term},
                        success: function(data){
                            $("#table").html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>