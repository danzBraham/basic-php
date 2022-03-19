<?php 
require "functions.php";

if (isset($_POST['register'])) {
   if (register($_POST) > 0) {
      echo "<script>
               alert('You successfully registered, please login!');
               document.location.href = 'login.php';
            </script>";
   } else {
      echo "<script>
               alert('You failed registration');
            </script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registration</title>
</head>
<body>
   
   <h2>Registration</h2>

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
            <td><label for="passWord">Confirm Password</label></td>
            <td>:</td>
            <td><input type="password" name="passWord" id="passWord" required></td>
         </tr>
         <tr>
            <td><button type="submit" name="register">Register</button></td>
            <td></td>
            <td></td>
         </tr>
      </table>
   </form>

</body>
</html>