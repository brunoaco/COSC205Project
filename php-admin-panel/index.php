<?php include './src/credentials.php';?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="./src/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include './header.php' ?>
    <div class="content-wrapper">

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>
                  <p>New Orders</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            

          <?php
          $servername = $local_servername;
          $username = $local_username;
          $password = $local_password;
          //echo $servername." / ".$username." / ".$password;
          
          // Create connection
          $conn = new mysqli($servername, $username, $password);
          
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          //echo "Connected successfully";
          $sql = "select (t1.ammount/t2.ammount)*100 as percent ".
                  "from (SELECT count(id) as ammount FROM test.test_table group by some_type) as t1 , ".
                  "(select count(id) as ammount from test.test_table) as t2 limit 1;";
          //echo $sql."<br>";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              //echo "id: " . $row["id"]. " - some_type: " . $row["some_type"]. " - some_text: " . $row["some_text"]. "<br>";
              $br1_result= $row["percent"];
              //echo $br1_result."<<--";
            }
          } else {
            //echo "0 results";
            $result= 0;
          }
          
          $conn->close();
          ?>
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><?php echo number_format($br1_result,2);?><sup style="font-size: 20px">%</sup></h3>
                  <p>Test Rate</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>

            
            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>
                  <p>User Registrations</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                  <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            
            <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>65</h3>
                  <p>Unique Visitors</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info
                  <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
          </div>

        </div>
      </section>

    </div>
    <?php include './footer.php'; ?>
  </div>
  <script src="./src/js/jquery.min.js"></script>
  <script src="./src/js/bootstrap.bundle.min.js"></script>
  <script src="./src/js/adminlte.min.js"></script>
</body>

</html>