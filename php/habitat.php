<?php 
    include("connexion.php");


    // total habitat
    $query = "SELECT * FROM habitat";

    $total_hab = mysqli_query($conn,$query);
    $total_hab=  mysqli_num_rows($total_hab);
?>