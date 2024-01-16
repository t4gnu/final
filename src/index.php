<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    $pdo=new PDO($connect,USER,PASS);

    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');

    echo '<h1>好きなゲームキャラ一覧</h1><hr>';
    foreach ($sql as $row){
        $id=$row['character_id'];
        echo 'No.',$id;
        echo '　',$row['character_name'],'<br>';
        echo '<p>',$row['character_exp'],'</p>';
        echo '登場ゲーム：',$row['game_name'],'<br><hr>';
    }
?>
<?php require 'footer.php'; ?>