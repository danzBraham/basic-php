<?php 
require 'functions.php';
$anime = query('SELECT * FROM anime');
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

      table {
         width: 100%;
      }
   </style>
</head>
<body>
   
   <h1>Anime List</h1>

   <h4><a href="insert.php">Add Anime</a></h4>

   <table border="1" cellpadding="10" cellspacing="0">
      <tr>
         <th>No</th>
         <th>Poster</th>
         <th>Title</th>
         <th>Action</th>
      </tr>

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

</body>
</html>