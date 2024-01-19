<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php

    $pdo=new PDO($connect,USER,PASS);
    echo '<form action="category_reg.php" method="post">';
    echo '<table  width="300" align="center">';
    echo '<tr><th>登場ゲーム</th><th></th></tr>';
    echo '<tr>';
    echo '<td><input type="text" name="game" id="game"></td>';
    echo '</td>';
    echo '<td width="5%"><input type="submit" value="登録"></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form><hr>';

    //ゲーム名が登録されていた場合 = 0   ゲーム名が登録されていなかった場合 = 1
    $flag = 0;

    if( isset($_POST['game']) ){

        if( empty($_POST['game']) ){
            echo 'ゲーム名を入力してください';
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
        }else{
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

        if( $flag==1 ){
            //ゲーム名が登録されていなかった場合
            $sql=$pdo->prepare('insert into Games (game_name, registerday) values(?,CURRENT_DATE())');
            $sql->execute([$_POST['game']]);
            echo '登録しました。';
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