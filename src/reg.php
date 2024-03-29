<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

    $pdo=new PDO($connect,USER,PASS);
    echo '<form action="reg.php" method="post">';
    echo '<table>';
    echo '<tr><th>キャラ名</th><th>キャラ説明</th><th>登場ゲーム</th><th></th></tr>';
    echo '<tr>';
    echo '<td><input type="text" name="name"></td>';
    echo '<td width="70%"><textarea name="exp"></textarea></td>';
    echo '<td><select name="game">';
    $sql=$pdo->query('select * from Games');
    foreach ($sql as $row){
        echo '<option value="',$row['game_name'],'">',$row['game_name'],'</option>';
    }
    echo '</select>';
    echo '</td>';
    echo '<td width="5%"><input type="submit" value="登録"></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
    echo '<a href="category_reg.php">ゲーム名(カテゴリー)追加</a><br><hr>';

    //ゲーム名が登録されていた場合 = 0   ゲーム名が登録されていなかった場合 = 1
    $flag = 0;

    if( isset($_POST['name']) ){

        if( empty($_POST['name']) || empty($_POST['game']) ){
            echo 'キャラ名を入力してください';
            echo '<hr>';
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
            return;
        }



        $sql=$pdo->prepare('select * from Games where game_name = ?');
        $sql->execute([$_POST['game']]);
        $result = $sql->fetchAll();
        if( empty($result) ){
            //ゲーム名が登録されていなかった場合
            $flag = 1;
        }

        if( $flag==1 ){
            //ゲーム名が登録されていなかった場合
            $sql=$pdo->prepare('insert into Games (game_name, registerday) values(?,CURRENT_DATE())');
            $sql->execute([$_POST['game']]);
        }

        $lastId=$pdo->lastInsertId();



        $sql=$pdo->prepare('select * from Characters where character_name = ?');
        $sql->execute([$_POST['name']]);
        $result = $sql->fetchAll();
        if( !(empty($result)) ){
            echo 'すでに登録されています。';
            echo '<hr>';
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
            return;
        }

        $sql=$pdo->prepare('insert into Characters (character_name, character_exp, game_id, registerday) values(?,?,?,CURRENT_DATE())');
        if( $flag==1 ){
            //ゲーム名が登録されていなかった場合
            $sql->execute([$_POST['name'],$_POST['exp'],(int)$lastId]);
        }else{
            //ゲーム名が登録されていた場合
            $sql2=$pdo->prepare('select * from Games where game_name = ?');
            $sql2->execute([$_POST['game']]);
            foreach($sql2 as $row2){
                $sql->execute([$_POST['name'],$_POST['exp'],$row2['game_id']]);
            }
        }
            
        echo '登録しました';
        echo '<hr>';
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
        return;

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