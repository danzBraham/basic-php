<?php 
session_start();
require 'functions.php';

if (!isset($_SESSION['login'])) {
   header("Location: login.php");
   exit;
}

$anime = query('SELECT * FROM anime');

if (isset($_POST['search'])) {
   $anime = search($_POST['keyword']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Anime List</title>
   <style>
      html {
         font-family: Arial, Helvetica, sans-serif;
         text-align: center;
      }

      form {
         margin-bottom: 20px;
      }

      table {
         width: 100%;
      }
   </style>
</head>
<body>

   <a href="logout.php">Logout</a>
   
   <h1>Anime List</h1>

   <h4><a href="insert.php">Add Anime</a></h4>

   <form action="" method="POST">
      <input type="text" name="keyword" placeholder="Enter keywords..." autocomplete="off" size="40" autofocus class="keyword">
      <button type="submit" name="search" class="search-button">Search</button>
   </form>
   
   <div class="container">
      <table border="1" cellpadding="10" cellspacing="0">
         <tr>
            <th>No</th>
            <th>Poster</th>
            <th>Title</th>
            <th>Action</th>
         </tr>
         
         <?php if (empty($anime)) : ?>
            <tr>
               <th colspan="4" style="color: red;">Anime not Found</th>
            </tr>
         <?php endif; ?>

         <?php $i = 1; ?>
         <?php foreach($anime as $nimek) : ?>
         <tr>
            <td><?= $i++; ?></td>
            <td><img src="img/<?= $nimek['Poster']; ?>" alt="Poster"></td>
            <td><?= $nimek['Title']; ?></td>
            <td>
               <a href="detail.php?id=<?= $nimek['id']; ?>">See details</a>
            </td>
         </tr>
         <?php endforeach; ?>
      </table>
   </div>

   <script src="js/script.js"></script>
</body>
</html>