

<?php
    include("connexion.php");


    // total animals
    $query_total = "SELECT * FROM animal";
    $total = mysqli_query($conn,$query_total);
    $total = mysqli_num_rows($total);

?>