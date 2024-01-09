<?php session_start(); ?>
<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    $id=$_GET['id'];
    if( isset($_SESSION['customer']) ){
        $pdo=new PDO($connect,USER,PASS);
        if(isset($_GET['id'])){
            $sql=$pdo->prepare('select * from favorite where customer_id=?');
            $sql->execute([$_SESSION['customer']['id']]);
            foreach($sql as $row){
                if($row['product_id'] == $_GET['id']){
                    echo 'すでにお気に入り登録されています。';
                    echo '<hr>';
                    return;
                }
            }
            $sql=$pdo->prepare('insert into favorite values(?,?)');
            $sql->execute([$_SESSION['customer']['id'],$_GET['id']]);
            echo 'お気に入りに商品を追加しました';
            echo '<hr>';
            require 'favorite.php';    
        }
    }else{
        echo 'お気に入り商品を追加するには、ログインしてください。';
    }
?>
<?php require 'footer.php'; ?>