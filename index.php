<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=Б, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <?php
        if(isset($_POST["info"]))  {
                echo("<title> DICE </title>");
            }else{
                echo("<title>WELCOME PLAYER </title>");
            }
    ?>
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <h1>DICE</h1>
            <form class="players" method="POST" action="game.php">
                <div>
                    <h2>Type your nickname</h2>
                    <h2>PLAYER 1</h2>
                    <input type="text" name="name1">
                </div>
                <div>
                    <input class="submit" type="submit" value="ROLLS">
                </div>
                <div class="right">
                    <h2>Type your nickname</h2>
                    <h2>PLAYER 2</h2>
                    <input type='text' name='name2'>
                </div>
            </form>
        </div>
    </div>
</body>

</html>