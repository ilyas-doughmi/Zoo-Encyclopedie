<?php 
    include("connexion.php");


    // total habitat
    $query = "SELECT * FROM habitat";

    $total_hab = mysqli_query($conn,$query);
    $total_hab=  mysqli_num_rows($total_hab);

    // habitats names

    $habitats_names = mysqli_query($conn,"SELECT name_hab from habitat");
?>