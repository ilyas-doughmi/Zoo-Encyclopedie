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

    // delete Habitat

    if (isset($_GET["del_id"])) {
        $id = $_GET["del_id"];
        $delete = mysqli_query($conn, "DELETE FROM habitat WHERE id_hab=" . $id);

        if (!$delete) {
            echo "problem";
        } else {
            header("location: ../index.php?isDeleted = success");
        }
    }

    // query with id 
    function habitat_data_id($id)
    {
        global $conn;

        $data_query = "SELECT * FROM habitat WHERE id_hab = " . $id . ";";
        $data_query = mysqli_query($conn, $data_query);

        if ($data_query) {
            $data = mysqli_fetch_assoc($data_query);

            echo json_encode($data);
        } else {
            echo "no data found";
        }
    }

    // edit a habitat 
    if (isset($_GET["data_id"])) {
        $id = $_GET['data_id'];
        habitat_data_id($id);
        exit;
    }

    if (isset($_GET["id_edit_hab"])) {
        $id = $_GET["id_edit_hab"];
        $new_name = $_GET['edit_name_hab'];
        $new_desc = $_GET["edit_desc_hab"];
        
        $query_edit = "UPDATE habitat SET name_hab = '".$new_name."',desc_hab = '".$new_desc."' WHERE id_hab = ".$id;

        if(!mysqli_query($conn,$query_edit)){
            echo "problem";
        }
        else{
                header("Location: ../index.php");
                exit;
        }
    }   
    

?>