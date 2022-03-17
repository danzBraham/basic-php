<?php 

// Koneksi ke Database dan pilih Database
$conn = mysqli_connect('localhost', 'root', '', 'phpdasar');

// Query isi tabel anime
$result = mysqli_query($conn, 'SELECT * FROM anime');

// Ubah data ke dalam array
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
   $rows[] = $row;
}

// tampung ke variable anime
$anime = $rows;

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

   <table border="1" cellpadding="10" cellspacing="0">
      <tr>
         <th>No</th>
         <th>Poster</th>
         <th>Title</th>
         <th>Studio</th>
         <th>Source</th>
         <th>Premiered</th>
         <th>MC</th>
         <th>Action</th>
      </tr>

      <?php $i = 1; ?>
      <?php foreach($anime as $nimek) : ?>
      <tr>
         <td><?= $i++; ?></td>
         <td><img src="img/<?= $nimek['Poster']; ?>" alt="Poster"></td>
         <td><?= $nimek['Title']; ?></td>
         <td><?= $nimek['Studio']; ?></td>
         <td><?= $nimek['Source']; ?></td>
         <td><?= $nimek['Premiered']; ?></td>
         <td><?= $nimek['MC']; ?></td>
         <td>
            <a href="">Edit</a> | <a href="">Delete</a>
         </td>
      </tr>
      <?php endforeach; ?>
   </table>

</body>
</html>