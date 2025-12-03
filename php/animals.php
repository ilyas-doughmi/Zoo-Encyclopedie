

<?php
include("connexion.php");



// total animals
if ($conn) {
    $query_total = "SELECT * FROM animal";
    $query_for_all = mysqli_query($conn, $query_total);
    $total = mysqli_query($conn, $query_total);
    $total = mysqli_num_rows($total);


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $anim_name = $_POST["anim_name"];
        $anim_habit = $_POST["anim_habit"];
        $anim_regim = $_POST["anim_regim"];
        $anim_img = $_POST["anim_img"];

        $query_add = "INSERT INTO animal(name_anim,habitat_id,type_alimentaire,anim_image) 
                       VALUES('$anim_name','$anim_habit','$anim_regim','$anim_img')";

        if(!mysqli_query($conn,$query_add)){
            echo "problem";
        }
        else{
            header("Location: ../index.php");
            exit;
        }
    }
}


// delete Animal

if(isset($_GET["id"])){
    $id = $_GET["id"];
    $delete = mysqli_query($conn,"DELETE FROM animal WHERE id=".$id);

    if(!$delete){
        echo "problem";
    }
    else{
        header("location: ../index.php?isDeleted = success"); 
    }
}


// query with id 
function data_id($id){
    global $conn;

    $data_query = "SELECT * FROM animal WHERE id = " .$id.";";
    $data_query = mysqli_query($conn,$data_query);

    if($data_query){
        $data = mysqli_fetch_assoc($data_query);

       echo json_encode($data);
        
    }
    else{
        echo "no data found";
    }
}


if(isset($_GET["data"])){
    $id = $_GET['data'];
    data_id($id);
    exit;
}


?>