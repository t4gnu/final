<?php session_start(); ?>
<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

    if( isset($_GET['id']) ){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('delete from where character_id=?');
        $sql->execute($_GET['id']); 
        echo 'お気に入りから商品を削除しました';
        echo '<hr>';
        require 'delete.php';
        return;
    }

    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th><th></th></tr>';

    foreach ($sql as $row){

        $id=$row['character_id'];
        echo '<tr>';
        echo '<td>',$id,'</td>';
        echo '<td>',$row['character_name'],'</td>';
        echo '<td width="70%">',$row['character_exp'],'</td>';
        echo '<td>',$row['game_name'],'</td>';
        echo '<td width="5%"><a href="delete.php?id="',$id,'">削除</a></td>';
        echo '</tr>';

    }
    echo '</table>';

?>
<?php require 'footer.php'; ?>