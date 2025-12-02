

<?php
    include("./php/connexion.php");


    // total animals
    $query_total = "SELECT * FROM animal";
    $total_anim = mysqli_query($conn,$query_total);
    $total_anim = mysqli_num_rows($total);

?>