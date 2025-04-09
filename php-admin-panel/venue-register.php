<?php
include '../connection-php.php';
//die();

$venue='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //print_r($_POST);
    //echo "<br>";

    $venue_id = (is_numeric(htmlspecialchars('0'.$_POST['venue-id'])) ? (int)htmlspecialchars('0'.$_POST['venue-id']) : 0);
    //echo '_'.$venue_id."_\n";
    //$venue_id = htmlspecialchars($_POST['venue-id']);
    /*if (is_numeric($venue_id)) {
    echo "venue_id is numeric";
    } else {
    echo $venue_id."\n";
    }*/

    $venue_name = htmlspecialchars($_POST['venue-name']);
    if (empty($venue_name)) {
    echo "venue_name is empty";
    } /*else {
    echo $venue_name."\n";
    }*/

    $venue_email = htmlspecialchars($_POST['venue-email']);
    if (empty($venue_email)) {
    echo "venue_email is empty";
    } /*else {
    echo $venue_email."\n";
    }*/

    $venue_phone = htmlspecialchars($_POST['venue-phone']);
    if (empty($venue_name)) {
    echo "venue_phone is empty";
    } /*else {
    echo $venue_phone."\n";
    }*/

    $venue_website = htmlspecialchars($_POST['venue-website']);
    if (empty($venue_name)) {
    echo "venue_website is empty";
    } /*else {
    echo $venue_website."\n";
    }*/

    $venue_address = htmlspecialchars($_POST['venue-address']);
    if (empty($venue_address)) {
    echo "venue_address is empty";
    } /*else {
    echo $venue_address."\n";
    }*/

    $venue_city = htmlspecialchars($_POST['venue-city']);
    if (empty($venue_city)) {
    echo "venue_city is empty";
    } /*else {
    echo $venue_city."\n";
    }*/

    $venue_postal_code = htmlspecialchars($_POST['venue-postal_code']);
    if (empty($venue_postal_code)) {
    echo "venue_postal_code is empty";
    } /*else {
    echo $venue_postal_code."\n";
    }*/
    

    $venue_bathrooms = htmlspecialchars($_POST['venue-bathrooms']);
    if (empty($venue_bathrooms)) {
    echo "venue_bathrooms is empty";
    } /*else {
    echo $venue_bathrooms."\n";
    }*/

    $venue_capacity = htmlspecialchars($_POST['venue-capacity']);
    if (empty($venue_capacity)) {
    echo "venue_capacity is empty";
    } /*else {
    echo $venue_capacity."\n";
    }*/

    $venue_parking = htmlspecialchars($_POST['venue-parking']);
    if (empty($venue_parking)) {
    echo "venue_parking is empty";
    } /*else {
    echo $venue_parking."\n";
    }*/

    $venue_license = htmlspecialchars($_POST['liquor-license']);
    if (empty($venue_license)) {
    echo "venue_license is empty";
    } /*else {
    echo $venue_license."\n";
    }*/

    $venue_kitchen = htmlspecialchars($_POST['kitchen']);
    if (empty($venue_kitchen)) {
    echo "venue_kitchen is empty";
    } /*else {
    echo $venue_kitchen."\n";
    }*/

    $venue_desc = htmlspecialchars($_POST['venue-desc']);
    if (empty($venue_desc)) {
    echo "venue_desc is empty";
    } /*else {
    echo $venue_desc."\n";
    }*/
    
    $venue_logo = htmlspecialchars($_POST['venue-logo']);
    if (empty($venue_logo)) {
    echo "venue_logo is empty";
    } /*else {
    echo $venue_logo."\n";
    }*/

    $venue_pic1 = htmlspecialchars($_POST['venue-pic1']);
    if (empty($venue_pic1)) {
    echo "venue_pic1 is empty";
    } /*else {
    echo $venue_pic1."\n";
    }*/

    $venue_pic2 = htmlspecialchars($_POST['venue-pic2']);
    if (empty($venue_pic2)) {
    echo "venue_pic2 is empty";
    } /*else {
    echo $venue_pic2."\n";
    }*/
    
    $venue_pic3 = htmlspecialchars($_POST['venue-pic3']);
    if (empty($venue_pic3)) {
    echo "venue_pic3 is empty";
    } /*else {
    echo $venue_pic3."\n";
    }*/
    
    $venue_is_valid = htmlspecialchars($_POST['venue_is_valid']);
    if (empty($venue_is_valid)) {
    echo "venue_is_valid is empty";
    } /*else {
    echo $venue_is_valid."\n";
    }*/


    $venue=$venue_name;


    if($venue_id==0)
    $sql="INSERT INTO `venues` ( ".
    "`name`,`logo`, ".
    "`address`,`city`,`postal_code`, ".
    "`phone`,`email`,`web`, ".
    "`photo1`,`photo2`,`photo3`, ".
    "`description`,`review_stars`,`review_desc`, ".
    "`maximum_capacity`,`liquor_license`,`kitchen_available`, ".
    "`bathrooms_available`,`parking_available` ".
    ") ".
    " values ( ".
    " '".$venue_name."','".$venue_logo."',  ".
    " '".$venue_address."','".$venue_city."','".$venue_postal_code."', ".
    " '".$venue_phone."','".$venue_email."', '".$venue_website."', ".
    " '".$venue_pic1."','".$venue_pic2."','".$venue_pic3."', ".
    " '".$venue_desc."','0','', ".
    " '".$venue_capacity."','".(($venue_license == 'yes') ? 1 : 0)."','".(($venue_kitchen == 'yes') ? 1 : 0)."', ".
    " '".$venue_bathrooms."','".$venue_parking."' ".
    ")";
    else
    $sql="UPDATE `venues` SET  ".
    " `name`='".$venue_name."', ".
    " `logo`='".$venue_logo."', ".
    " `address`='".$venue_address."', ".
    " `city`='".$venue_city."', ".
    " `postal_code`='".$venue_postal_code."', ".
    " `phone`='".$venue_phone."', ".
    " `email`='".$venue_email."', ".
    " `web`='".$venue_website."', ".
    " `photo1`='".$venue_pic1."', ".
    " `photo2`='".$venue_pic2."', ".
    " `photo3`='".$venue_pic3."', ".
    " `description`='".$venue_desc."', ".
    //" `review_stars`='0', ".
    //" `review_desc`='', ".
    " `maximum_capacity`='".$venue_capacity."', ".
    " `liquor_license`='".(($venue_license == 'yes') ? 1 : 0)."', ".
    " `kitchen_available`='".(($venue_kitchen == 'yes') ? 1 : 0)."', ".
    " `bathrooms_available`='".$venue_bathrooms."', ".
    " `parking_available`='".$venue_parking."', ".
    " `is_valid`='".(($venue_is_valid == 'yes') ? 1 : 0)."'  ".
    " WHERE  ".
    " `ID`='".$venue_id."' ";

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
alert("Venue '<?php echo $venue; ?>' is ready.");
window.location.href = "venues.php";
</script>