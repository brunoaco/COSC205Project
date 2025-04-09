<?php
include '../connection-php.php';
//die();

$musician='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //print_r($_POST);
    //echo "<br>";

    $musician_id = (is_numeric(htmlspecialchars('0'.$_POST['musician-id'])) ? (int)htmlspecialchars('0'.$_POST['musician-id']) : 0);
    //echo '_'.$musician_id."_\n";
    //$musician_id = htmlspecialchars($_POST['musician-id']);
    /*if (is_numeric($musician_id)) {
    echo "musician_id is numeric";
    } else {
    echo $musician_id."\n";
    }*/

    $musician_name = htmlspecialchars($_POST['musician-name']);
    if (empty($musician_name)) {
    echo "musician_name is empty";
    } /*else {
    echo $musician_name."\n";
    }*/

    $musician_email = htmlspecialchars($_POST['musician-email']);
    if (empty($musician_email)) {
    echo "musician_email is empty";
    } /*else {
    echo $musician_email."\n";
    }*/
    /*
    $musician_phone = htmlspecialchars($_POST['musician-phone']);
    if (empty($musician_name)) {
    echo "musician_phone is empty";
    } else {
    echo $musician_phone."\n";
    }*/

    /*$musician_website = htmlspecialchars($_POST['musician-website']);
    if (empty($musician_name)) {
    echo "musician_website is empty";
    } else {
    echo $musician_website."\n";
    }*/

    $musician_address = htmlspecialchars($_POST['musician-address']);
    if (empty($musician_address)) {
    echo "musician_address is empty";
    } /*else {
    echo $musician_address."\n";
    }*/

    $musician_city = htmlspecialchars($_POST['musician-city']);
    if (empty($musician_city)) {
    echo "musician_city is empty";
    } /*else {
    echo $musician_city."\n";
    }*/

    $musician_postal_code = htmlspecialchars($_POST['musician-postal_code']);
    if (empty($musician_postal_code)) {
    echo "musician_postal_code is empty";
    } /*else {
    echo $musician_postal_code."\n";
    }*/
    

    /*$musician_bathrooms = htmlspecialchars($_POST['musician-bathrooms']);
    if (empty($musician_bathrooms)) {
    echo "musician_bathrooms is empty";
    } else {
    echo $musician_bathrooms."\n";
    }*/

    /*$musician_capacity = htmlspecialchars($_POST['musician-capacity']);
    if (empty($musician_capacity)) {
    echo "musician_capacity is empty";
    } else {
    echo $musician_capacity."\n";
    }*/

    /*$musician_parking = htmlspecialchars($_POST['musician-parking']);
    if (empty($musician_parking)) {
    echo "musician_parking is empty";
    } else {
    echo $musician_parking."\n";
    }*/

    /*$musician_license = htmlspecialchars($_POST['liquor-license']);
    if (empty($musician_license)) {
    echo "musician_license is empty";
    } else {
    echo $musician_license."\n";
    }*/

    /*$musician_kitchen = htmlspecialchars($_POST['kitchen']);
    if (empty($musician_kitchen)) {
    echo "musician_kitchen is empty";
    } else {
    echo $musician_kitchen."\n";
    }*/

    $musician_desc = htmlspecialchars($_POST['musician-desc']);
    if (empty($musician_desc)) {
    echo "musician_desc is empty";
    } /*else {
    echo $musician_desc."\n";
    }*/
    
    $musician_logo = htmlspecialchars($_POST['musician-logo']);
    if (empty($musician_logo)) {
    echo "musician_logo is empty";
    } /*else {
    echo $musician_logo."\n";
    }*/

    $musician_pic1 = htmlspecialchars($_POST['musician-pic1']);
    if (empty($musician_pic1)) {
    echo "musician_pic1 is empty";
    } /*else {
    echo $musician_pic1."\n";
    }*/

    $musician_pic2 = htmlspecialchars($_POST['musician-pic2']);
    if (empty($musician_pic2)) {
    echo "musician_pic2 is empty";
    } /*else {
    echo $musician_pic2."\n";
    }*/
    
    $musician_pic3 = htmlspecialchars($_POST['musician-pic3']);
    if (empty($musician_pic3)) {
    echo "musician_pic3 is empty";
    } /*else {
    echo $musician_pic3."\n";
    }*/
    
    $musician_is_valid = htmlspecialchars($_POST['musician_is_valid']);
    if (empty($musician_is_valid)) {
    echo "musician_is_valid is empty";
    } /*else {
    echo $musician_is_valid."\n";
    }*/


    $musician=$musician_name;


    if($musician_id==0)
    $sql="INSERT INTO `musicians` ( ".
    "`name`,`logo`, ".
    "`address`,`city`,`postal_code`, ".
    //"`phone`, ".
    "`email`, ".
    //"`web`, ".
    "`photo1`,`photo2`,`photo3`, ".
    "`description`,`review_stars`,`review_desc` ".
    //"`maximum_capacity`,`liquor_license`,`kitchen_available`, ".
    //"`bathrooms_available`,`parking_available` ".
    ") ".
    " values ( ".
    " '".$musician_name."','".$musician_logo."',  ".
    " '".$musician_address."','".$musician_city."','".$musician_postal_code."', ".
    //" '".$musician_phone."', ".
    " '".$musician_email."', ".
    //*"  '".$musician_website."', ".
    " '".$musician_pic1."','".$musician_pic2."','".$musician_pic3."', ".
    " '".$musician_desc."','0','' ".
    //" '".$musician_capacity."', ".
    //" '".(($musician_license == 'yes') ? 1 : 0)."','".(($musician_kitchen == 'yes') ? 1 : 0)."', ".
    //" '".$musician_bathrooms."','".$musician_parking."' ".
    ")";
    else
    $sql="UPDATE `musicians` SET  ".
    " `name`='".$musician_name."', ".
    " `logo`='".$musician_logo."', ".
    " `address`='".$musician_address."', ".
    " `city`='".$musician_city."', ".
    " `postal_code`='".$musician_postal_code."', ".
    //" `phone`='".$musician_phone."', ".
    " `email`='".$musician_email."', ".
    //" `web`='".$musician_website."', ".
    " `photo1`='".$musician_pic1."', ".
    " `photo2`='".$musician_pic2."', ".
    " `photo3`='".$musician_pic3."', ".
    " `description`='".$musician_desc."', ".
    //" `review_stars`='0', ".
    //" `review_desc`='', ".
    //" `maximum_capacity`='".$musician_capacity."', ".
    //" `liquor_license`='".(($musician_license == 'yes') ? 1 : 0)."', ".
    //" `kitchen_available`='".(($musician_kitchen == 'yes') ? 1 : 0)."', ".
    //" `bathrooms_available`='".$musician_bathrooms."', ".
    //" `parking_available`='".$musician_parking."', ".
    " `is_valid`='".(($musician_is_valid == 'yes') ? 1 : 0)."'  ".
    " WHERE  ".
    " `ID`='".$musician_id."' ";

    //echo "<br>".$sql."<br>";
    //die();

        // Create connection
        $conn = new mysqli($servername, $username, $password,$dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        //echo $sql."<br>";
        $result = $conn->query($sql);
        $conn->close();
}

?>
<script type="text/javascript">
alert("musician '<?php echo $musician; ?>' is ready.");
window.location.href = "Entertainment.php";
</script>