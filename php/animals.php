

<?php
include("connexion.php");



// total animals
if ($conn) {
    $query_total = "SELECT * FROM animal";
    $query_for_all = mysqli_query($conn, $query_total);
    $total = mysqli_query($conn, $query_total);
    $total = mysqli_num_rows($total);


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $anim_name = $_POST["anim_name"];
        $anim_habit = $_POST["anim_habit"];
        $anim_regim = $_POST["anim_regim"];
        $anim_img = $_POST["anim_img"];

        $query_add = "INSERT INTO animal(name_anim,habitat_id,type_alimentaire,anim_image) 
                       VALUES('$anim_name','$anim_habit','$anim_regim','$anim_img')";

        if (!mysqli_query($conn, $query_add)) {
            echo "problem";
        } else {
            header("Location: ../index.php");
            exit;
        }
    }
}


// delete Animal

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $delete = mysqli_query($conn, "DELETE FROM animal WHERE id=" . $id);

    if (!$delete) {
        echo "problem";
    } else {
        header("location: ../index.php?isDeleted = success");
    }
}


// query with id 
function data_id($id)
{
    global $conn;

    $data_query = "SELECT * FROM animal WHERE id = " . $id . ";";
    $data_query = mysqli_query($conn, $data_query);

    if ($data_query) {
        $data = mysqli_fetch_assoc($data_query);

        echo json_encode($data);
    } else {
        echo "no data found";
    }
}


if (isset($_GET["data"])) {
    $id = $_GET['data'];
    data_id($id);
    exit;
}
$new_info = [];
if (isset($_GET["id_edit"])) {
    $new_info = ["id" => $_GET["id_edit"], "new_name" =>  $_GET['new_name'], "new_habit" => $_GET["new_habit"], "new_diet" => $_GET["new_diet"], "new_img" => $_GET["new_img"]];
$query_edit = "UPDATE animal SET name_anim = '".$new_info["new_name"]."',habitat_id = '".$new_info["new_habit"]."',type_alimentaire = '".$new_info["new_diet"]."',anim_image = '".$new_info["new_img"]."'WHERE id = ".$new_info["id"]."
";

    if(!mysqli_query($conn,$query_edit)){
        echo "problem";
    }
    else{
              header("Location: ../index.php");
            exit;
    }
}   
