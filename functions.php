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

function upload() {
   $file_name = $_FILES['Poster']['name'];
   $file_type = $_FILES['Poster']['type'];
   $file_tmp = $_FILES['Poster']['tmp_name'];
   $file_error = $_FILES['Poster']['error'];
   $file_size = $_FILES['Poster']['size'];

   // ketika tidak ada gambar yang diupload
   if ($file_error == 4) {
      return 'batu.png';
   }

   // cek ekstensi file
   $extension_valid = ['jpg', 'jpeg', 'png'];
   $extension_file = explode('.', $file_name);
   $extension_file = strtolower(end($extension_file));

   if (!in_array($extension_file, $extension_valid)) {
      echo "<script>
               alert('You are not uploading an image');
            </script>";
      return false;
   }

   // cek tipe file
   if ($file_type != 'image/jpeg' && $file_type != 'image/png') {
      echo "<script>
               alert('You are not uploading an image');
            </script>";
      return false;
   }

   // cek ukuran file
   if ($file_size > 5000000) {
      echo "<script>
               alert('The image size is too large');
            </script>";
      return false;
   }

   // lolos pengecekan dan siap upload file
   // generate nama file baru
   $new_file_name = uniqid() . '.' . $extension_file;
   move_uploaded_file($file_tmp, 'img/' . $new_file_name);
   
   return $new_file_name;
}

function insert($data) {
   $conn = connection();

   $title = htmlspecialchars($data["Title"]);
   $studio = htmlspecialchars($data["Studio"]);
   $source = htmlspecialchars($data["Source"]);
   $premiered = htmlspecialchars($data["Premiered"]);
   $MC = htmlspecialchars($data["MC"]);
   // $poster = htmlspecialchars($data["Poster"]);

   $poster = upload();
   if (!$poster) {
      return false;
   }

   $query = "INSERT INTO anime VALUES (
      NULL, '$title', '$studio', '$source', '$premiered', '$MC', '$poster'
   )";

   mysqli_query($conn,$query) or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

function delete($id) {
   $conn = connection();

   // menghapus gambar di folder img
   $anime = query("SELECT * FROM anime WHERE id = $id");
   if ($anime['Poster'] != 'batu.png') {
      unlink('img/' . $anime['Poster']);
   }

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
   $oldPoster = htmlspecialchars($data["oldPoster"]);

   $poster = upload();
   if (!$poster) {
      return false;
   }

   if ($poster == 'batu.png') {
      $poster = $oldPoster;
   }

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

function search($keyword) {
   $conn = connection();

   $query = "SELECT * FROM anime WHERE
            Title LIKE '%$keyword%' OR
            Studio LIKE '%$keyword%' OR
            Source LIKE '%$keyword%' OR
            Premiered LIKE '%$keyword%' OR
            MC LIKE '%$keyword%'";
   
   $result = mysqli_query($conn, $query);

   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }

   return $rows;
}

function login($data) {
   $username = htmlspecialchars($data['username']);
   $password = htmlspecialchars($data['password']);

   // cek username
   if ($user = query("SELECT * FROM users WHERE username = '$username'")) {
      // cek password
      if (password_verify($password, $user['password'])) {
         // set session
         $_SESSION['login'] = true;

         header("Location: index.php");
         exit;
      }
   }

   return [
      "error" => true,
      "message" => "Username or Password Incorrect!"
   ];
}

function register($data) {
   $conn = connection();

   $username = htmlspecialchars(strtolower($data['username']));
   $password = mysqli_real_escape_string($conn, $data['password']);
   $passWord = mysqli_real_escape_string($conn, $data['passWord']);

   // jika username atau password kosong
   if (empty($username) || empty($password) || empty($passWord)) {
      echo "<script>
               alert('Please fill in Username or Password');
               document.location.href = 'register.php';
            </script>";
      return false;
   }

   // jika username sudah ada
   if (query("SELECT * FROM users WHERE username = '$username'")) {
      echo "<script>
               alert('Username already exists');
               document.location.href = 'register.php';
            </script>";
      return false;
   }

   // jika konfirmasi password tidak sesuai
   if ($password !== $passWord) {
      echo "<script>
               alert('Password does not match');
               document.location.href = 'register.php';
            </script>";
      return false;
   }

   // jika password < 5 digit
   if (strlen($passWord) < 5) {
      echo "<script>
               alert('Your password is less than 5 digits');
               document.location.href = 'register.php';
            </script>";
      return false;
   }

   // jika username dan password sudah sesuai
   // enkripsi password
   $newPassword = password_hash($passWord, PASSWORD_DEFAULT);

   // insert ke tabel users
   $query = "INSERT INTO users VALUES (
      NULL, '$username', '$newPassword'
   )";

   mysqli_query($conn, $query) or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

?>