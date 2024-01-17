<?php session_start(); ?>
<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

    $pdo=new PDO($connect,USER,PASS);
    echo '<form action="reg.php" method="post">';
    echo '<table>';
    echo '<tr><th>ID</th><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th><th></th></tr>';
    echo '<tr>';
    echo '<td><input type="text" name="id"></td>';
    echo '<td><input type="text" name="name"></td>';
    echo '<td width="70%"><textarea name="exp"></textarea></td>';
    echo '<td><input type="text" name="game"></td>';
    echo '<td width="5%"><input type="submit" value="登録"></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';


    if( isset($_POST['name']) ){
    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
    foreach($sql as $row){
        if($row['character_name'] == $_POST['name']){
            echo 'すでに登録されています。';
            echo '<hr>';
            break;
        }
        $sql=$pdo->prepare('insert into Characters values(?,?)');
        $sql->execute([$_,$_GET['id']]);
        echo '登録しました';
        echo '<hr>';
        require 'reg.php';
    }
    }
    

    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th></tr>';

    foreach ($sql as $row){
    
        $id=$row['character_id'];
        echo '<tr>';
        echo '<td>',$id,'</td>';
        echo '<td>',$row['character_name'],'</td>';
        echo '<td width="70%">',$row['character_exp'],'</td>';
        echo '<td>',$row['game_name'],'</td>';
        echo '</tr>';
    
    }

    echo '</table>';
    
?>
<?php require 'footer.php'; ?>