<?php 
require "functions.php";

if (isset($_POST["add"])) {

   if (insert($_POST) > 0) {
      echo "<script>
            alert('Data Succesfully Added!');
            document.location.href = 'latihan3.php';
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

   <form action="" method="POST">
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
            <td><input type="text" name="Poster" id="poster" required></td>
         </tr>
         <tr>
            <td><button type="submit" name="add">Add Data</button></td>
            <td></td>
            <td></td>
         </tr>
      </table>
   </form>

</body>
</html>