<?php

function connection() {
   return mysqli_connect('localhost', 'root', '', 'phpdasar');
}

function query($query) {
   $conn = connection();
   $result = mysqli_query($conn, $query);
   
   if (mysqli_num_rows($result) === 1) {
      return mysqli_fetch_assoc($result);
   }
   
   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }

   return $rows;
}

function insert($data) {
   $conn = connection();

   $title = htmlspecialchars($data["Title"]);
   $studio = htmlspecialchars($data["Studio"]);
   $source = htmlspecialchars($data["Source"]);
   $premiered = htmlspecialchars($data["Premiered"]);
   $poster = htmlspecialchars($data["Poster"]);
   $MC = htmlspecialchars($data["MC"]);

   $query = "INSERT INTO anime VALUES (
      NULL, '$title', '$studio', '$source', '$premiered', '$MC', '$poster'
   )";

   mysqli_query($conn,$query);
   echo mysqli_error($conn);
   return mysqli_affected_rows($conn);
}

?>