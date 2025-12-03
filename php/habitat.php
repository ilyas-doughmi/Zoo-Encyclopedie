<?php 
    include("connexion.php");

    $habitat = [];

    if($conn){
            // total habitat
    $query = "SELECT * FROM habitat";

    $total_hab = mysqli_query($conn,$query);
    $total_hab=  mysqli_num_rows($total_hab);

    // habitats names

    $habitats_names = mysqli_query($conn,"SELECT * from habitat");

    while($row = mysqli_fetch_assoc($habitats_names)){
        $habitat[] = $row;
    }
    }

?>