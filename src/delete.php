<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

    if( isset($_GET['id']) ){
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('delete from Characters where character_id=?');
        $sql->execute([(int)$_GET['id']]); 
        echo '削除しました';
        echo '<hr>';
        $sql=$pdo->query('select * from Characters inner join Games on Characters.game_id = Games.game_id');
        echo '<table border="1">';
        echo '<tr><th>ID</th><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th><th></th></tr>';

        foreach ($sql as $row){

            echo '<tr>';
            echo '<td>',$row['character_id'],'</td>';
            echo '<td>',$row['character_name'],'</td>';
            echo '<td width="70%">',$row['character_exp'],'</td>';
            echo '<td>',$row['game_name'],'</td>';
            echo '<td width="5%"><a href="delete.php?id=',$row['character_id'],'"><button>削除</button></a></td>';
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

        $id=$row['character_id'];
        echo '<tr>';
        echo '<td>',$id,'</td>';
        echo '<td>',$row['character_name'],'</td>';
        echo '<td width="70%">',$row['character_exp'],'</td>';
        echo '<td>',$row['game_name'],'</td>';
        echo '<td width="5%"><a href="delete.php?id=',$id,'"><button>削除</button></a></td>';
        echo '</tr>';

    }
    echo '</table>';

?>
<?php require 'footer.php'; ?>