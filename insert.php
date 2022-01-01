<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ajax</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body>
        <div>
            <h1>Insert Data</h1>
            <form action="">
                <label for="sfirst_name">First Name</label>
                <input type="text" id="sfirst_name">
                <label for="slast_name">Last Name</label>
                <input type="text" id="slast_name">
                <label for="scity">City</label>
                <input type="text" id="scity">
            </form><br><br>
            <input type="button" id="insert-data" value="Add More"><br><br>
            <div id="table">
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
            });
        </script>
    </body>
</html>