<?php session_start(); ?>
<?php require 'db-connect.php'; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>

<?php
    $pdo=new PDO($connect,USER,PASS);

    $sql=$pdo->prepare('insert into purchase (customer_id) values(?)');
    $sql->execute([
        $_SESSION['customer']['id']
    ]);
    
    $lastId=$pdo->lastInsertId();
    $sql=$pdo->prepare('insert into purchase_detail (purchase_id, product_id, count) values(?,?,?)');
    foreach($_SESSION['product'] as $id=>$product){
        $sql->execute([
        (int)$lastId, $id, $product['count']
        ]);
    }
    unset($_SESSION['product']);
    
    echo '購入手続きが完了しました、ありがとうございます。';
?>

<?php require 'footer.php'; ?>
