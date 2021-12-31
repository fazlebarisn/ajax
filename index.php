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
            <h1>Learn Ajax</h1>
            <input type="button" id="load-more" value="Load More"><br><br>
            <div id="table">
            </div>
        </div>
        <script>
            $(document).ready( function(){
                $('#load-more').on('click' , function(){
                    $.ajax({
                        url : 'aj.php',
                        type : 'POST',
                        success : function( data ){
                            $('#table').html(data);
                        }
                    });
                });
            });
        </script>
    </body>
</html>