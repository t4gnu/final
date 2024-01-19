<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    $pdo=new PDO($connect,USER,PASS);

    echo '<h1>好きなゲームキャラ一覧</h1>';
    echo '<form action="index.php" method="post">';
    echo '<select name="category">';
    $sql=$pdo->query('select * from Games');
    foreach ($sql as $row){
        echo '<option value="',$row['game_name'],'">',$row['game_name'],'</option>';
    }
    echo '</select>';
    echo '<td width="5%"><input type="submit" value="検索"></td>';
    echo '</form>';
    echo '<hr>';
    if( isset($_POST['category']) ){
        $sql=$pdo->prepare('select * from Characters inner join Games on Characters.game_id = Games.game_id where game_name = ?');
        $sql->execute([$_POST['category']]); 
        foreach ($sql as $row){
            $id=$row['character_id'];
            echo 'No.',$id;
            echo '　',$row['character_name'],'<br>';
            echo '<p>',$row['character_exp'],'</p>';
            echo '登場ゲーム：',$row['game_name'],'<br><hr>';
        }
        return;
    }
    $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
    foreach ($sql as $row){
        $id=$row['character_id'];
        echo 'No.',$id;
        echo '　',$row['character_name'],'<br>';
        echo '<p>',$row['character_exp'],'</p>';
        echo '登場ゲーム：',$row['game_name'],'<br><hr>';
    }
?>
<?php require 'footer.php'; ?>