<?php 
require "functions.php";

// jika tidak ada id di url
if (!isset($_GET['id'])) {
   header("Location: index.php");
   exit;
}

// ambil id dari url
$id = $_GET['id'];

if (delete($_GET['id']) > 0) {
   echo "<script>
            alert('Data Succesfully Deleted!');
            document.location.href = 'index.php';
         </script>";
} else {
   echo "<script>
            alert('Data Failed to Delete!');
         </script>";
}
?>