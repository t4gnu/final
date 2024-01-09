<?php session_start(); ?>
<?php require 'db-connect.php';?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
    if( isset($_SESSION['customer']) ){
        if( !empty($_SESSION['product']) ){
            echo 'お名前：',$_SESSION['customer']['name'],'<br>';
            echo 'ご住所：',$_SESSION['customer']['address'],'<hr>';
            echo '<table>';
            echo '<tr><th>商品番号</th><th>商品名</th>';
            echo '<th>価格</th><th>個数</th><th>小計</th><th></th></tr>';
            $total=0;
            foreach($_SESSION['product'] as $id=>$product){
                echo '<tr>';
                echo '<td>',$id,'</td>';
                echo '<td><a href="detail.php?id=',$id,'">',
                    $product['name'],'</a></td>';
                echo '<td>',$product['price'],'</td>';
                echo '<td>',$product['count'],'</td>';
                $subtotal=$product['price']*$product['count'];
                $total+=$subtotal;
                echo '<td>',$subtotal,'</td>';
                echo '<td><a href="cart-delete.php?id=',$id,'">削除</a></td>';
                echo '</tr>';
            }
            echo '<tr><td>合計</td><td></td><td></td><td></td><td>',$total,
            '</td><td></td></tr>';
            echo '</table>','<br><hr>';
            echo '内容をご確認いただき、購入を確定してください。<br>';
            echo '<a href="purchase-output.php">購入を確定する</a>';

        }else{
            echo 'お名前：',$_SESSION['customer']['name'],'<br>';
            echo 'ご住所：',$_SESSION['customer']['address'],'<hr>';
            echo 'カートに商品がありません。';
        }
    }else{
        echo '購入するには、ログインしてください。';
    }
?>
<?php require 'footer.php'; ?>