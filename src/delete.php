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
        exit;
    }

    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
    echo '<tr><th>キャラクターID</th><th>キャラクター名</th><th>キャラクター説明</th><th>登場ゲーム</th></tr>';

    foreach ($sql as $row){
        
        $id=$row['character_id'];
        echo '<tr>';
        echo '<td>',$id,'</td>';
        echo '<td>';
        echo '<a href="detail.php?id=',$id,'">',$row['name'],'</a>';
        echo '</td>';
        echo '<td>',$row['price'],'</td>';
        echo '<a href="delete.php?id="',$id,'">削除</a>';
        echo '</tr>';

    }

?>
<?php require 'footer.php'; ?>