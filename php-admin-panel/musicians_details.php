<?php
include '../connection-php.php';
//die();

$musician='';

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    //print_r($_GET);
    //echo "<br>";

    $musician_id = (is_numeric(htmlspecialchars('0'.$_GET['id'])) ? (int)htmlspecialchars('0'.$_GET['id']) : 0);

    //require_once ('db.php');
    $sql = "SELECT ".
    " `ID`, `name`,`logo`, ".
    " `address`,`city`,`postal_code`, ".
    " `email`,`photo1`,`photo2`, ".
    " `photo3`,`description`,`genre1`, ".
    " `genre2`,`genre3`,`review_stars`, ".
    " `review_desc`,`date_created`,`date_modified`, ".
    " `is_valid`  ".
    " FROM `musicians`  ".
    " WHERE ID=".$musician_id.";";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {        {
                $array = array(
                    'ID' => $row["ID"],
                    'name' => $row["name"],
                    'logo' => $row["logo"],
                    'address' => $row["address"],
                    'city' => $row["city"],
                    'postal_code' => $row["postal_code"],
                    //'phone' => $row["phone"],
                    'email' => $row["email"],
                    //'web' => $row["web"],
                    'photo1' => $row["photo1"],
                    'photo2' => $row["photo2"],
                    'photo3' => $row["photo3"],
                    'description' => $row["description"],
                    //'maximum_capacity' => $row["maximum_capacity"],
                    //'liquor_license' => $row["liquor_license"],
                    //'kitchen_available' => $row["kitchen_available"],
                    //'bathrooms_available' => $row["bathrooms_available"],
                    //'parking_available' => $row["parking_available"],
                    'genre1' => $row["genre1"],
                    'genre2' => $row["genre2"],
                    'genre3' => $row["genre3"],
                    'is_valid' => $row["is_valid"],
                    );
                    //print_r($_GET)."<br>";
                    echo json_encode($array);
            }
        }
    } else {
        //echo 'Data Not Found';
        $array = array(
            'ID' => '',
            'name' => '',
            'logo' => '',
            'email' => '',
            'address' => '',
            'city' => '',
            'postal_code' => '',
            'photo1' => '',
            'photo2' => '',
            'photo3' => '',
            'description' => '',
            'genre1' => '',
            'genre2' => '',
            'genre3' => '',
            'is_valid' => '',
            );
            //print_r($_GET)."<br>";
            echo json_encode($array);
    }
}

?>
