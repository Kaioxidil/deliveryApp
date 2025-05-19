<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:home.php');
};

if(isset($_POST['submit'])){

   $address = $_POST['flat'] .', '.$_POST['building'].', '.$_POST['area'].', '.$_POST['town'] .', '. $_POST['city'] .', '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $update_address = $conn->prepare("UPDATE `users` set address = ? WHERE id = ?");
   $update_address->execute([$address, $user_id]);

   $message[] = 'endereço salvo!';

}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>atualizar endereço | Dev Brasil</title>
   <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php' ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Seu endereço</h3>
      <!-- <input type="text" class="box" placeholder="Ponto de Referencia" required maxlength="50" name="flat"> -->
      <input type="text" class="box" placeholder="Edificio ou Casa" required maxlength="50" name="building">
      <input type="text" class="box" placeholder="Nome da Rua" required maxlength="50" name="area">
      <input type="text" class="box" placeholder="Bairro (ex: Veneza)" required maxlength="50" name="town">
      <input type="text" class="box" placeholder="Cidade (ex: Terra Roxa)" required maxlength="50" name="city">
      <input type="text" class="box" placeholder="Estado (ex: PR)" required maxlength="50" name="state">
      <input type="text" class="box" placeholder="País (ex: Brasil)" required maxlength="50" name="country">
      <input type="number" class="box" placeholder="Número da casa" required max="999999" min="0" maxlength="6" name="pin_code">
      <input type="submit" value="salvar endereço" name="submit" class="btn">
   </form>

</section>










<?php include 'components/footer.php' ?>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>