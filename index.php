<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/30a0bcf5d6.js" crossorigin="anonymous"></script>
    <title>Autocomplete</title>
</head>
<body>
    <div class="box">
        <div class="content"><h1 class="text_shadow">HELLO!</h1></div>
        <h2>Welcome on board.</h2>
        <img src="animals.jpeg" alt="animals of the world" width="300" height="200">
        <form method="get" action="recherche.php">
            <label for="search"></label>
            <input type="text" id="search" name="search" placeholder="Start typing here">
            <div id="result-list"></div>
            <button class="button" type="submit" name="submit" value="search"><i class="fa-solid fa-magnifying-glass"></i> search</button>
        </form>
    </div>

    <script>
        $(document).ready(function(){
            $('#search').keyup(function(){
                let query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url: 'autocomplete.php',
                        method: 'POST',
                        data: {query:query},
                        success:function(data){
                            $('#result-list').fadeIn();
                            $('#result-list').html(data);
                        }
                    });
                } else {
                    $('#result-list').fadeOut();
                    $('#result-list').html("");
                }
            });

            $(document).on('click', 'li', function(){
                $('#search').val($(this).text());
                $('#result-list').fadeOut();
            });
        });
    </script>

</body>
</html>