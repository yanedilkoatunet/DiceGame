<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=V, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>DICE</title>
</head>

<body>
    <div class="wrapper">
        <div class="container">
        <?php
            if(isset($_POST["info"])) {
                $info_array = json_decode($_POST["info"], true);
                $info_array["attempt"]++;
            }else{
                $info_array = [
                    "name1" => $_POST["name1"],
                    "name2" => $_POST["name2"],
                    "attempt" => 0,
                    "points0" => 0,
                    "points1" => 0,
                    "played" => 0
                ];
            }
            if(isset($_POST["rolls"])) {
                echo("<div class='dice'>");
                $dice_array = [];
                for($i = 1; $i <= 6; $i++){
                    $rand = rand(1,6);
                    echo("<img src='".$rand.".jpg' alt='".$rand."'>");
                    // створюємо новий елемент массива і записуємо в dice array
                    $dice_array[] += $rand;
                    // echo("<p>Dices side was $rand</p>");
                }
                $points = 0; // загальна кількість очків
                $combo = 1;
                $totalcombo = 0;
                $combonumber = 0;
                // на одну ітерацию $i виконується по 6 ітераций $j
                for($i = 0;$i < count($dice_array);$i++){
                    $points += $dice_array[$i]; 
                    for($j = 0;$j < count($dice_array);$j++){
                        // щоб не перевіряти кубік вже з перевіреними і сам з собою
                        if($j <= $i || $combonumber == $dice_array[$i]){
                            continue;
                        }
                        if($dice_array[$i] == $dice_array[$j]){
                            $combo++;
                        }
                        // if($j == count($dice_array) - 1){
                        //     // коли доходимо до останнього кубіка то порівнюємо combo з 3
                        // }
                    }
                    if($combo >= 3){
                        $totalcombo += $combo;
                        $combonumber = $dice_array[$i];
                    }
                    $combo = 1;
                }
                if($totalcombo != 0){
                    $points *= $totalcombo;
                }
                // var_dump($info_array);
                if($info_array["played"] == 1){
                    $info_array["points0"] += $points;
                }else{
                    $info_array["points1"] += $points;
                }
                echo("</div>");
                if($totalcombo >= 3){
                    echo("<p>Congrats!Your totalcombo is X".$totalcombo."</p>");
                }
                echo("<p>Your points amount in this game is ".$points."</p>");
                
            }else{ 
                echo ("Let's play");
                $random = rand(0,1);
                if($random == $info_array["attempt"]){
                    $info_array["attempt"]++;
                }
            } 
            function form($even, $info_array){
                $player = 0;
                if(!$even){
                    $player = 1;
                }
                if ($even){
                    // якщо рандом поділиться з остачою чи 1 чи 3 чи 5.. то тоді код виконається  
                    echo("
                    <input disabled type='submit' name='rolls' value='rolls'>
                    ");
                   
                }else{
                    if($info_array["played"] == 0 || $info_array["played"] == 1){
                        $info_array["played"] = 2;
                    }else{
                        $info_array["played"] = 1;
                    }
                    echo("
                    it's your turn now
                        <input type='hidden' name='info' value='".json_encode($info_array)."'>
                        <input type='submit' name='rolls' value='rolls'>
                        ");
                    }   
                        echo("
                        </form>
                        ");
            }
            $even = $info_array["attempt"] % 2;
            function formpage($info_array){
                echo("<div class='players'>");   
                if($info_array["points0"] > 1000 || $info_array["points1"] > 1000){
                    echo("
                    <form action='winner.php' method='post'>
                    ");
                }else{
                    echo("
                    <form action='game.php' method='post'>
                    ");
                }
            }
            formpage($info_array);
            echo("
                <h2>PLAYER ".$info_array["name1"]."</h2>
                <p>Total score ".$info_array['points0']."</p>
                ");
                form(!$even, $info_array);
                // логічне заперечення 0 - true, 1 - false
                formpage($info_array);
                echo("
                <h2>PLAYER ".$info_array["name2"]."</h2>
                <p>Total score ".$info_array['points1']."</p>
            ");
            form($even, $info_array);
            // 
            echo("
                </div>
            ");
            ?>
        </div>
    </div>
</body>

</html>