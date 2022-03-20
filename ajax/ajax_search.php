<?php 
require "../functions.php";

$anime = search($_GET['keyword']);
?>

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