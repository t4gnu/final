<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

    if( isset($_POST['id']) ){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('update Characters set character_name=?,character_exp=?,updateday=CURRENT_DATE()where character_id=?');
        $sql->execute([$_POST['name'],$_POST['exp'],(int)$_POST['id']]); 
        echo '更新しました';
        echo '<hr>';
        $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th><th></th></tr>';

        foreach ($sql as $row){
            echo '<form action="updade.php" method="post">';
            echo '<tr>';
            echo '<td><input type="hidden" name="id" value="',$row['character_id'],'">',$row['character_id'],'</td>';
            echo '<td><input type="text" name="name" value="',$row['character_name'],'"></td>';
            echo '<td width="70%"><textarea name="exp">',$row['character_exp'],'</textarea></td>';
            echo '<td><input type="text" name="game" value="',$row['game_name'],'"></td>';
            echo '<td width="5%"><input type="submit" value="更新"></td>';
            echo '</from>';
            echo '</tr>';

        }
        echo '</table>';
        return;
    }

    $pdo=new PDO($connect,USER,PASS);
    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th><th></th></tr>';

    foreach ($sql as $row){
        echo '<form action="update.php" method="post">';
        echo '<tr>';
        echo '<td><input type="hidden" name="id" value="',$row['character_id'],'">',$row['character_id'],'</td>';
        echo '<td><input type="text" name="name" value="',$row['character_name'],'"></td>';
        echo '<td width="70%"><textarea name="exp">',$row['character_exp'],'</textarea></td>';
        echo '<td><input type="text" name="game" value="',$row['game_name'],'"></td>';
        echo '<td width="5%"><input type="submit" value="更新"></td>';
        echo '</form>';
        echo '</tr>';

    }
    echo '</table>';

?>
<?php require 'footer.php'; ?>