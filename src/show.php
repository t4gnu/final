<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    echo '<table>';
    echo '<tr><th></th><th>キャラクター名</th><th></th><th>登場ゲーム</th></tr>';
    $pdo=new PDO($connect,USER,PASS);

    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');

    foreach ($sql as $row){
        $id=$row['character_id'];
        echo '<tr>';
        echo '<td>No.',$id,'</td>';
        echo '<td>',$row['character_name'],'</td>';
        echo '<td>',$row['character_exp'],'</td>';
        echo '<td>',$row['game_name'],'</td>';
        echo '</tr>';
    }
    echo '</table>';
?>
<?php require 'footer.php'; ?>