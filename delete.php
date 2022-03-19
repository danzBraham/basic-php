<?php 
require "functions.php";

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