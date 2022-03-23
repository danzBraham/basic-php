<?php 
session_start();
require "functions.php";

if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}

// cek apakah tombol add sudah ditekan
if (isset($_POST["add"])) {
   if (insert($_POST) > 0) {
      echo "<script>
            alert('Data Succesfully Added!');
            document.location.href = 'index.php';
            </script>";
   } else {
      echo "<script>
            alert('Data Failed to Add!');
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
   <title>Add Anime Data</title>
</head>
<body>
   
   <h1>Add Anime Data</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <table>
         <tr>
            <td><label for="title">Title</label></td>
            <td>:</td>
            <td><input type="text" name="Title" id="title" required autofocus></td>
         </tr>
         <tr>
            <td><label for="studio">Studio</label></td>
            <td>:</td>
            <td><input type="text" name="Studio" id="studio" required></td>
         </tr>
         <tr>
            <td><label for="source">Source</label></td>
            <td>:</td>
            <td><input type="text" name="Source" id="source" required></td>
         </tr>
         <tr>
            <td><label for="premiered">Premiered</label></td>
            <td>:</td>
            <td><input type="date" name="Premiered" id="premiered" required></td>
         </tr>
         <tr>
            <td><label for="MC">MC</label></td>
            <td>:</td>
            <td><input type="text" name="MC" id="MC" required></td>
         </tr>
         <tr>
            <td><label for="poster">Poster</label></td>
            <td>:</td>
            <td><img src="img/batu.png" class="img-preview" style="width: 125px; display: block;"></td>
            <td><input type="file" name="Poster" id="poster" class="img-input" onchange="previewImage()"></td>
         </tr>
         <tr>
            <td><button type="submit" name="add">Add Data</button></td>
            <td></td>
            <td></td>
         </tr>
      </table>
   </form>

   <script src="js/script.js"></script>
</body>
</html>