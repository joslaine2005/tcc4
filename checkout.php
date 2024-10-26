<?php

@include 'conexao.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>obrigado pela compra!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : R$".$price_total."  </span>
         </div>
         <div class='customer-details'>
            <p> seu nome : <span>".$name."</span> </p>
            <p> seu número : <span>".$number."</span> </p>
            <p> seu email : <span>".$email."</span> </p>
            <p> endereço : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> método de pagamento : <span>".$method."</span> </p>
         </div>
            <a href='produtos.php' class='btn'>continue comprando</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/cart.css">

</head>
<body>



<div class="container">

<section class="checkout-form">

   <h1 class="heading">Finalize seu pedido</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> total da compra : R$<?= $grand_total; ?> </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>nome</span>
            <input type="text" placeholder="seu nome" name="name" required>
         </div>
         <div class="inputBox">
            <span>número</span>
            <input type="number" placeholder="seu número" name="number" required>
         </div>
         <div class="inputBox">
            <span>email</span>
            <input type="email" placeholder="seu email" name="email" required>
         </div>
         <div class="inputBox">
            <span>método de pagamento</span>
            <select name="method">
               <option value="cash on delivery" selected></option>
               <option value="credit cart">cartão de crédito</option>
               <option value="paypal">cartão de debito</option>
            </select>
         </div>
         <div class="inputBox">
            <span>endereço 1</span>
            <input type="text" placeholder="ex. rua" name="flat" required>
         </div>
         <div class="inputBox">
            <span>endereço 2</span>
            <input type="text" placeholder="ex. rua2" name="street" required>
         </div>
         <div class="inputBox">
            <span>cidade</span>
            <input type="text" placeholder="ex. cidade" name="city" required>
         </div>
         <div class="inputBox">
            <span>estado</span>
            <input type="text" placeholder="ex. estado" name="state" required>
         </div>
         <div class="inputBox">
            <span>País</span>
            <input type="text" placeholder="ex. Pais  " name="country" required>
         </div>
         <div class="inputBox">
            <span>código pin</span>
            <input type="text" placeholder="ex. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="Finalizar compra" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="javascript2.js"></script>
   
</body>
</html>
