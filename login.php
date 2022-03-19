<?php
session_start();
require "functions.php";

if (isset($_SESSION['login'])) {
   header("Location: index.php");
   exit;
}

if (isset($_POST['login'])) {
   $login = login($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
   <style>
      html, body {
         font-family: Arial, Helvetica, sans-serif;
      }

      h2 {
         text-align: center;
         font-size: 3em;
      }

      .container {
         border: 3px solid black;
         border-radius: 5px;
         width: fit-content;
         margin: auto;
         text-align: justify;
      }
   </style>
</head>
<body>
   
   <h2>Login</h2>

   <div class="container">
      <?php if (isset($login['error'])) : ?>
         <h3 style="color: red; font-weight: bold; font-style: italic;"><?= $login['message']; ?></h3>
      <?php endif; ?>

      <form action="" method="POST">
         <table>
            <tr>
               <td><label for="username">Username</label></td>
               <td>:</td>
               <td><input type="text" name="username" id="username" autocomplete="off" autofocus required></td>
            </tr>
            <tr>
               <td><label for="password">Password</label></td>
               <td>:</td>
               <td><input type="password" name="password" id="password" required></td>
            </tr>
            <tr>
               <td><button type="submit" name="login">Login</button></td>
               <td></td>
               <td><a href="register.php">I don't have an account</a></td>
            </tr>
         </table>
      </form>
   </div>

</body>
</html>