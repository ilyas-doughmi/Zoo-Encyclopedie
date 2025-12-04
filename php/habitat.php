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


     $name = "";

    function habitat_name($id){
        global $conn;
       
        $query_name = "SELECT name_hab FROM habitat WHERE id_hab = " . $id;

        if(!$result = mysqli_query($conn,$query_name)){
            echo "problem";
        }
        else{
            $name = mysqli_fetch_assoc($result);
        }
        return $name["name_hab"];
    }


    // add new zone

    if(isset($_GET["name_hab"])){
        $name_hab = $_GET["name_hab"];
        $desc_hab = $_GET["desc_hab"];

        $insert_query = "INSERT INTO habitat(name_hab,desc_hab) VALUES('$name_hab','$desc_hab') ";

        if(!mysqli_query($conn,$insert_query)){
            echo "problem";
        }
        else{
            header("location: ../index.php?added=success");
        }
    }
    

?>