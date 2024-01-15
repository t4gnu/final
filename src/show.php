<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<hr>
<?php
    echo '<table>';
    echo '<tr><th>キャラクターID</th><th>キャラクター名</th><th>キャラクター説明</th><th>登場ゲーム</th></tr>';
    $pdo=new PDO($connect,USER,PASS);

    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');

    foreach ($sql as $row){
        $id=$row['character_id'];
        echo '<tr>';
        echo '<td>',$id,'</td>';
        echo '<td>',$row['character_name'],'</td>';
        echo '<td>',$row['character_exp'],'</td>';
        echo '<td>',$row['game_name'],'</td>';
        echo '</tr>';
    }
    echo '</table>';
?>
<?php require 'footer.php'; ?>