<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 
        $info_array = json_decode($_POST["info"], true);
        var_dump($info_array);
        $winner;
        $gap;
        if($info_array["points0"] > 1000){
            $winner = $info_array["name1"];
        }else{
            $winner = $info_array["name2"];
        }
        $gap = abs($info_array["points0"] - $info_array["points1"]);
        echo("<h1>CONGRATULATIONS PLAYER ".$winner."</h1>");
        echo("GAP BETWEEN PLAYERS SCORES IS ".$gap);
    ?>
</body>
</html>