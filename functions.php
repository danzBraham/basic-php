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
   $MC = htmlspecialchars($data["MC"]);
   $poster = htmlspecialchars($data["Poster"]);

   $query = "INSERT INTO anime VALUES (
      NULL, '$title', '$studio', '$source', '$premiered', '$MC', '$poster'
   )";

   mysqli_query($conn,$query) or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

function delete($id) {
   $conn = connection();
   mysqli_query($conn, "DELETE FROM anime WHERE id = $id") or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

function edit($data) {
   $conn = connection();

   $id = htmlspecialchars($data["id"]);
   $title = htmlspecialchars($data["Title"]);
   $studio = htmlspecialchars($data["Studio"]);
   $source = htmlspecialchars($data["Source"]);
   $premiered = htmlspecialchars($data["Premiered"]);
   $MC = htmlspecialchars($data["MC"]);
   $poster = htmlspecialchars($data["Poster"]);

   $query = "UPDATE anime SET
            Title = '$title',
            Studio = '$studio',
            Source = '$source',
            Premiered = '$premiered',
            MC = '$MC',
            Poster = '$poster' WHERE id = $id";

   mysqli_query($conn,$query) or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

function search($keywords) {
   $conn = connection();

   $query = "SELECT * FROM anime WHERE
            Title LIKE '%$keywords%' OR
            Studio LIKE '%$keywords%' OR
            Source LIKE '%$keywords%' OR
            Premiered LIKE '%$keywords%' OR
            MC LIKE '%$keywords%'";
   
   $result = mysqli_query($conn, $query);

   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }

   return $rows;
}

?>