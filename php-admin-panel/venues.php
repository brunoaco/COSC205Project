<?php 
include '../connection-php.php';

//print_r($_GET);
function getArray(){
  return $_GET;
}
$getArray= getArray();



$params=array("page-nr"=> '1',
  "order"=>"name",
  "name"=>"ASC",
  "address"=>"ASC",
  "postal"=>"ASC", 
  "phone"=>"ASC",
  "email"=>"ASC", 
  "page-origin"=> 'auto');
function updtParamsToGet($paramsArr,$getArray){
  foreach($paramsArr as $key=> $value ){
    $getArray[$key]=$value;
  }
  return $getArray;
}
function addParamsToGet($key,$value,$getArray){
  $getArray[$key]=$value;
  return $getArray;
}
function paramsToGet($array){
  $resultString="";
  foreach($array as $key => $value){
    $resultString= $resultString.$key."=".$value."&";
  }
  $resultString=substr($resultString,0,strlen($resultString)-1);
  return "?".$resultString;

}

$getArray=updtParamsToGet($params,$getArray);
$getArray=updtParamsToGet($params,$getArray);


if(isset($_GET["order"])){ 
  $order=htmlspecialchars(''.$_GET["order"]);
}else{
  $order='';
}

if(isset($_GET["search"])){ 
  $search=htmlspecialchars(''.$_GET["search"]);
}else{
  $search='';
}

if(isset($_GET["name"])){ 
  $name = htmlspecialchars(''.$_GET['name']);
}else{
  $name ='ASC';
}

if(isset($_GET["address"])){ 
  $address = htmlspecialchars(''.$_GET['address']);
}else{
  $address ='ASC';
}

if(isset($_GET["postal"])){ 
  $postal = htmlspecialchars(''.$_GET['postal']);
}else{
  $postal ='ASC';
}

if(isset($_GET["phone"])){ 
  $phone = htmlspecialchars(''.$_GET['phone']);
}else{
  $phone ='ASC';
}

if(isset($_GET["email"])){ 
  $email = htmlspecialchars(''.$_GET['email']);
}else{
  $email ='ASC';
}

$start=0;
$rows_per_page=4;
echo "start:($start)<br>";
if(isset($_GET['page-nr'])){
  //echo "start:($start)<br>";
  $page= $_GET['page-nr']-1;
  //echo "start:($start)<br>";
  //echo "rows_per_page:($rows_per_page)<br>";
  //echo "page:($page)<br>";
  $start = $page * $rows_per_page;
  //echo "start:($start)<br>";
}
//echo "start:($start)<br>";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="./src/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    .page-info-short{
      margin-top: 10px;
      font-size: 18px;
      font-weight: bold;
    }.page-info{
      margin-top: 90px;
      font-size: 18px;
      font-weight: bold;
    }
    .pagination{
      margin-top: 20px;
    }
    .page-numbers{
      display: inline-block;
    }
    .pagination-link{
      display: inline-block;
      text-decoration: none;
      color: #006cb3;
      padding: 10px 20px;
      border: thin solid #d4d4d4;
      transition: all 0.3s;
      font-size: 18px;
    }
    a.active{
   background-color: #0d81cd;
   color: #fff;
}

</style>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include './header.php' ?>
    
    <div class="content-wrapper">

      <section class="content">
        <div class="container-fluid">
        <form  class="registration-form" action="venue-register.php" method="post" id="edit-form" name="edit-form" style="display: none;">
          
          <div class="form-group">
            <label for="phone">ID:</label>
            <input type="tel" class="form-control" id="venue-id" name="venue-id" type="number" readonly>
          </div>

          <div class="form-group">
            <label for="venueName">Name:</label>
            <input type="text" class="form-control" id="venue-name" name="venue-name" required>
          </div>
          <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" class="form-control" id="venue-phone" name="venue-phone" required>
          </div>
          
          <div class="form-group">
            <label for="Web">Web:</label>
            <input type="url" class="form-control" id="venue-website" name="venue-website" placeholder="Paste URL here" >
          </div>
          
          <div class="form-group">
            <label for="Web">Email:</label>
            <input type="email" class="form-control" id="venue-email" name="venue-email" required>
          </div>

          <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="venue-address" name="venue-address" required>
          </div>

          <div class="form-group">
            <label for="city">City:</label>
            <?php citiesSelect("venue-city"); ?>
          </div>

          <div class="form-group">
            <label for="postalCode">Postal Code:</label>
            <input type="text" class="form-control" id="venue-postal_code" name="venue-postal_code" required>
          </div>

          <div class="form-group">
            <label for="bathrooms">Number of Bathrooms:</label>
            <input type="number" class="form-control" id="venue-bathrooms" name="venue-bathrooms" min="0" required>
          </div>
        

          <div class="form-group">
            <label for="address">Maximum Capacity:</label>
            <input type="number" class="form-control" id="venue-capacity" name="venue-capacity"  min="1" value="10" required>
          </div>

          <div class="form-group">
            <label for="avatar">Parking Spots:</label>
            <input type="number" class="form-control form-control-lg" id="venue-parking" name="venue-parking" min="1" required>
          </div>

          <label>Liquor License:</label>
          <div class="radio-group">
            <div class="radio-item">
              <input type="radio" id="liquor-yes" name="liquor-license" value="yes" required>
              <label for="liquor-yes" style="margin: 0;">Yes</label>
            </div>
            <div class="radio-item">
              <input type="radio" id="liquor-no" name="liquor-license" value="no" required>
              <label for="liquor-no" style="margin: 0;">No</label>
            </div>
          </div>

          <label>Kitchen:</label>
          <div class="radio-group">
            <div class="radio-item">
              <input type="radio" id="kitchen-yes" name="kitchen" value="yes" required>
              <label for="kitchen-yes" style="margin: 0;">Yes</label>
            </div>
            <div class="radio-item">
              <input type="radio" id="kitchen-no" name="kitchen" value="no" required>
              <label for="kitchen-no" style="margin: 0;">No</label>
            </div>
          </div>

          <div class="form-group">
            <label for="avatar">Description:</label>
            <textarea type="text" class="form-control form-control-lg" id="venue-desc" name="venue-desc"></textarea>
          </div>

          <div class="form-group">
            <label class="full-width">Logo</label>
            <input id="venue-logo" name="venue-logo"  type="url" placeholder="Paste img URL here" class="form-control form-control-lg" accept="image/*">
            <span id="logo-span" name="logo-span"></span>
          </div>

          <div>
            <label for="gallery1">Gallery:</label>
            <input type="url" class="form-control form-control-lg" id="venue-pic1" name="venue-pic1" placeholder="Paste img URL here" >
            <input type="url" class="form-control form-control-lg" id="venue-pic2" name="venue-pic2" placeholder="Paste img URL here" >
            <input type="url" class="form-control form-control-lg" id="venue-pic3" name="venue-pic3" placeholder="Paste img URL here" >
          </div>

          <div class="form-group">
            <label for="about">About:</label>
            <textarea class="form-control" id="about" rows="3"></textarea>
          </div>

          <label>Is Valid:</label>
          <div class="radio-group">
            <div class="radio-item">
              <input type="radio" id="venue-yes" name="venue_is_valid" value="yes" required>
              <label for="venue-yes" style="margin: 0;">Yes</label>
            </div>
            <div class="radio-item">
              <input type="radio" id="venue-no" name="venue_is_valid" value="no" required>
              <label for="venue-no" style="margin: 0;">No</label>
            </div>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-primary mb-3">Submit</button>

          </div>
        </form>

        <button class="btn btn-primary mb-3" onClick="formShow();formLoad(-1)" id="toggle" name="toggle">New Record</button>
        <button class="btn btn-primary mb-3" onClick="formToggle()" id="toggle" name="toggle">Show/Hide Form</button>

        
          <?php
          if(isset($_GET["search"])){?><div id="filters"><div class="page-info-short"><?php
            echo "You are searching : <input type='text' id='filter_Search' name='filter_Search' value='$search' >";
              //"Order : <input type='hidden' id='filter_Search' name='filter_Search' value='$order' readonly><br>".
              //"Name : <input type='hidden' id='filter_Search' name='filter_Search' value='$name' readonly><br>".
              //"Address : <input type='hidden' id='filter_Search' name='filter_Search' value='$address' readonly><br>".
              //"Postal : <input type='hidden' id='filter_Search' name='filter_Search' value='$postal' readonly><br>".
              //"Phone : <input type='hidden' id='filter_Search' name='filter_Search' value='$phone' readonly><br>".
              //"Email : <input type='hidden' id='filter_Search' name='filter_Search' value='$email' readonly><br>";
            ?>
            <button type="button" onclick="re_Search()">Search</button>
            <button type="button" onclick="document.location='?'">Reset Search</button>
            <?php
            ?></div><?php
          }
          ?>
        </div>
        <?php
        ?>
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Firstname
                <?PHP
                if($name=="ASC"){$name="DESC";}else{$name="ASC";}

                $getArray=updtParamsToGet(array("name"=>$name),$getArray);
                $getArray=updtParamsToGet(array("page-nr"=>'1'),$getArray);
                $getArray=updtParamsToGet(array("order"=>'name'),$getArray);
                
                ?>
                <a href="<?php echo paramsToGet($getArray) ?>">
                  <i class="fa fa-sort-<?php echo strtolower ($name) ?>"></i>
                </a>
                <?php 
                  $getArray=updtParamsToGet(array("order"=>$order),$getArray);
                  if($name=="ASC"){$name="DESC";}else{$name="ASC";}
                  $getArray=updtParamsToGet(array("name"=>$name),$getArray);
                ?>
              </th>
              <th>Address
                <?PHP
                if($address=="ASC"){$address="DESC";}else{$address="ASC";}

                $getArray=updtParamsToGet(array("address"=>$address),$getArray);
                $getArray=updtParamsToGet(array("page-nr"=>'1'),$getArray);
                $getArray=updtParamsToGet(array("order"=>'address'),$getArray);
                ?>
                <a href="<?php echo paramsToGet($getArray) ?>">
                  <i class="fa fa-sort-<?php echo strtolower ($address) ?>"></i>
                </a>
                <?php 
                  $getArray=updtParamsToGet(array("order"=>$order),$getArray);
                  if($address=="ASC"){$address="DESC";}else{$address="ASC";}
                  $getArray=updtParamsToGet(array("address"=>$address),$getArray);
                ?>
              </th>
              <th>Postal Code
                <?PHP
                if($postal=="ASC"){$postal="DESC";}else{$postal="ASC";}

                $getArray=updtParamsToGet(array("postal"=>$postal),$getArray);
                $getArray=updtParamsToGet(array("page-nr"=>'1'),$getArray);
                $getArray=updtParamsToGet(array("order"=>'postal'),$getArray);
                ?>
                <a href="<?php echo paramsToGet($getArray) ?>">
                  <i class="fa fa-sort-<?php echo strtolower ($postal) ?>"></i>
                </a>
                <?php 
                
                $getArray=updtParamsToGet(array("order"=>$order),$getArray);
                  if($postal=="ASC"){$postal="DESC";}else{$postal="ASC";}
                  $getArray=updtParamsToGet(array("postal"=>$postal),$getArray);
                ?>
                </th>
              <th>Logo</th>
              <th>telephone
                <?PHP
                if($phone=="ASC"){$phone="DESC";}else{$phone="ASC";}

                $getArray=updtParamsToGet(array("phone"=>$phone),$getArray);
                $getArray=updtParamsToGet(array("page-nr"=>'1'),$getArray);
                $getArray=updtParamsToGet(array("order"=>'phone'),$getArray);
                ?>
                <a href="<?php echo paramsToGet($getArray) ?>">
                  <i class="fa fa-sort-<?php echo strtolower ($phone) ?>"></i>
                </a>
                <?php 
                
                $getArray=updtParamsToGet(array("order"=>$order),$getArray);
                  if($phone=="ASC"){$phone="DESC";}else{$phone="ASC";}
                  $getArray=updtParamsToGet(array("phone"=>$phone ),$getArray);
                ?></th>
              <th>E-mail
                <?PHP
                if($email=="ASC"){$email="DESC";}else{$email="ASC";}

                $getArray=updtParamsToGet(array("email"=>$email),$getArray);
                $getArray=updtParamsToGet(array("page-nr"=>'1'),$getArray);
                $getArray=updtParamsToGet(array("order"=>'email'),$getArray);
                ?>
                <a href="<?php echo paramsToGet($getArray) ?>">
                  <i class="fa fa-sort-<?php echo strtolower ($email) ?>"></i>
                </a>
                <?php 
                
                $getArray=updtParamsToGet(array("order"=>$order),$getArray);
                  if($email=="ASC"){$email="DESC";}else{$email="ASC";}
                  $getArray=updtParamsToGet(array("email"=>$email ),$getArray);
                ?></th>
            </tr>
          </thead>
          <tbody>
            <?php             
            // Create connection
            $conn = new mysqli($servername, $username, $password,$dbname);
            
            // Check connection
            if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
            }

            //echo "start:($start)<br>";
            $sql = " SELECT ".
            "`ID`,`name`,`logo`, ".
            "`address`,`postal_code`, ".
            "`phone`,`email`  ".
            "FROM venues  ".
            "where `is_valid`=1  ".
            " ".(($search != '') ? " and (".
                "name like '%".$search."%' or ".
                "address like '%".$search."%' or ".
                "description  like '%".$search."%' or ".
                "email like '%".$search."%'  ".
                " )" : '');
            if($order=="name"){$sql=$sql."order by name $name";}
            elseif($order=="address"){$sql=$sql."order by address $address";}
            elseif($order=="postal"){$sql=$sql."order by postal_code $postal";}
            elseif($order=="phone"){$sql=$sql."order by phone $phone";}
            elseif($order=="email"){$sql=$sql."order by email $email";}
            else{$sql=$sql."order by date_modified desc";}
            $sql=$sql." limit $start,$rows_per_page; ";

            //echo $sql."<br>";
            
            $result = $conn->query($sql);
            $rows = mysqli_num_rows($result);


            

            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                <td><?php echo $row["name"]; ?></td>
                <td><a href="<?php echo "https://www.google.com/maps/place/".str_replace(" ","+",rtrim($row["address"], " ")); ?>" target="_blank"><?php echo rtrim($row["address"], " ");?></a></td>
                <td><a href="<?php echo "https://www.google.com/maps/place/".$row["postal_code"]; ?>" target="_blank"><?php echo $row["postal_code"]; ?></a></td>
                <td><img src="<?php echo $row["logo"]; ?>" alt="Logo" width="50" height="60"/></td>
                <td><a href="tel:<?php echo $row["phone"]; ?>"><?php echo $row["phone"]; ?></a></td>
                <td><a href="mailto:<?php echo $row["email"]; ?>?subject=Hello%20there&body=Hi%20<?php echo $row["name"]; ?>This%20is%20a%20predefined%20email%20body."> <?php echo $row["email"]; ?></a></td>
                <!--<td><?php echo $row["ID"]; ?>formShow();formLoad()</td>-->
                <td><button class="btn btn-default" onclick="formShow();formLoad(<?php echo $row["ID"]; ?>);"><i class="glyphicon glyphicon-pencil"></i> Edit</button></td>
                
                </tr>
                <?php
              }
            } else {
              $result= 0;
            }

            ?>



          </tbody>
          <tfoot>            <?php 

            $sql = " SELECT ID FROM venues WHERE is_valid=1 ".
            " ".(($search != '') ? " and name like '%".$search."%' " : '').
            "; ";

            $result = $conn->query($sql);
            $nr_of_rows = $result->num_rows;


            $pages=ceil($nr_of_rows / $rows_per_page);
            if($pages==0){$pages=1;}
            
            $conn->close();
            
            ?>
            <td colspan=6>
              <div class="page-info">
                <?php
                if(!isset($_GET['page-nr'])){
                  $page=1;
                }
                else{
                  $page=$_GET['page-nr'];
                }
                ?>
                showing <?php echo $page?> of <?php echo $pages ?> pages
              </div>
              <div class="pagination">

              <?php $getArray=updtParamsToGet(array("page-nr"=>'1'),$getArray);?>
              <a href="<?php echo paramsToGet($getArray) ?>" class="pagination-link">First</a>

              <?php
              if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1){
                $getArray=updtParamsToGet(array("page-nr"=>($_GET['page-nr'] -1)),$getArray);?>
                <a href="<?php echo paramsToGet($getArray) ?>" class="pagination-link">Previous</a>
              <?php 
              }else{
                ?><a class="pagination-link">Previous</a>
                <?php 
              }
              
              ?>

              
              <div class="page-numbers">

              <?php
              for($counter=1;$counter <= $pages; $counter++){
                $getArray=updtParamsToGet(array("page-nr"=>$counter),$getArray);
                ?><a href="<?php echo paramsToGet($getArray) ?>" class="pagination-link<?php 
                if(isset($_GET['page-nr'])){
                  $current_page=$_GET['page-nr'];
                }else{
                  $current_page=1;
                }
                if($counter == $current_page) echo " active " ?>"><?php echo $counter ?></a>
                <?php
              }
              ?>
              
              </div>

              <?php
              if(!isset($_GET['page-nr'])){
                $getArray=updtParamsToGet(array("page-nr"=>'2'),$getArray);
                ?><a href="<?php echo paramsToGet($getArray) ?>" class="pagination-link">Next</a><?php
              }
              else{
                if($_GET['page-nr']>=$pages){
                  ?><a class="pagination-link">Next</a><?php

                }else{
                  $getArray=updtParamsToGet(array("page-nr"=>($_GET['page-nr']  +1)),$getArray);
                  ?><a href="<?php echo paramsToGet($getArray) ?>" class="pagination-link">Next</a><?php
                }
              }
              ?>
              <?php 
              // "pages:($pages)";
              $getArray=updtParamsToGet(array("page-nr"=>$pages),$getArray);?>
              <a href="<?php echo paramsToGet($getArray) ?>" class="pagination-link">Last</a>
              </div>
            </td>
          </tfoot>
        </table>
        </div>
      </section>

    </div>
    <?php include './footer.php'; ?>
  </div>
  <script src="./src/js/jquery.min.js"></script>
  <script src="./src/js/bootstrap.bundle.min.js"></script>
  <script src="./src/js/adminlte.min.js"></script>
  <script>
    function imageExists(image_url){

      var http = new XMLHttpRequest();

      http.open('HEAD', image_url, false);
      http.send();

      return http.status != 404;

      }
    function isEmpty(obj) {
      for (const prop in obj) {
        if (Object.hasOwn(obj, prop)) {
          return false;
        }
      }
      return true;
    }
    function formToggle(){
      var x = document.getElementById("edit-form");
      if (x.style.display === "none") {
        x.style.display = "block";
      } else {
        x.style.display = "none";
      }
    }
    function formHide(){
      var x = document.getElementById("edit-form");
      x.style.display = "none";
    }
    function formShow(){
      var x = document.getElementById("edit-form");
      x.style.display = "block";
    }
    function formLoad(id){
        //alert(id);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
          text = this.responseText;
          //alert(text);
           obj = JSON.parse(text);
          //alert(obj.name) ;
          document.getElementById("venue-id").value   =obj.ID;
          document.getElementById("venue-name").value   =obj.name;
          document.getElementById("venue-logo").value   =obj.logo;
          document.getElementById("venue-address").value   =obj.address;
          document.getElementById("venue-city").value = obj.city;/************************************** */
          document.getElementById("venue-postal_code").value = obj.postal_code;
          document.getElementById("venue-phone").value = obj.phone;
          document.getElementById("venue-email").value = obj.email;
          document.getElementById("venue-website").value = obj.web;
          document.getElementById("venue-pic1").value = obj.photo1;
          document.getElementById("venue-pic2").value = obj.photo2;
          document.getElementById("venue-pic3").value = obj.photo3;
          document.getElementById("venue-desc").value = obj.description;
          document.getElementById("venue-capacity").value = obj.maximum_capacity;
          if(obj.liquor_license==1){
            document.getElementsByName("liquor-license")[0].checked=true;//yes
          }else{
            document.getElementsByName("liquor-license")[1].checked=true;//false
          }
          if(obj.kitchen_available==1){
            document.getElementsByName("kitchen")[0].checked=true;//yes
          }else{
            document.getElementsByName("kitchen")[1].checked=true;//false
          }
          document.getElementById("venue-bathrooms").value = obj.bathrooms_available;
          document.getElementById("venue-parking").value = obj.parking_available;

          if(obj.is_valid==1){
            document.getElementsByName("venue_is_valid")[0].checked=true;//yes
          }else{
            document.getElementsByName("venue_is_valid")[1].checked=true;//false
          }
        }
        xhttp.open("GET", "venues_details.php?id="+id);
        xhttp.send();
    }
    function re_Search(){
      console.log("re_search");
      searchValue=document.getElementById("filter_Search").value;
      document.location='?search='+searchValue;
    }
  </script>
</body>

</html>
<?php

function  citiesSelect($name){
  ?>
              <select name="<?php echo $name; ?>" id="<?php echo $name; ?>" type="text" class="form-control"  >
                  <option value="Kelowna, B.C.">Kelowna, B.C.</option>
                  <option value="Oliver, B.C.">Oliver, B.C.</option>
                  <option value="Osoyoos, B.C.">Osoyoos, B.C.</option>
                  <option value="Penticton, B.C.">Penticton, B.C.</option>
                  <option value="Vernon, B.C.">Vernon, B.C.</option>
                  <option value="West Kelowna, B.C.">West Kelowna, B.C.</option>
                  <option value="Summerland, B.C.">Summerland, B.C.</option>
              </select>
  <?php
  }
function checkRemoteFile($url){
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$url);
      // don't download content
      curl_setopt($ch, CURLOPT_NOBODY, 1);
      curl_setopt($ch, CURLOPT_FAILONERROR, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

      $result = curl_exec($ch);
      curl_close($ch);
      if($result !== FALSE)
      {
          return true;
      }
      else
      {
          return false;
      }
  }

?>