<?php
use PHPUnit\Framework\TestCase;
//require 'db_operations.php'; // Include the procedural script

$local_servername = "localhost";
$local_username = "root";
$local_password = "mysql";
$local_db="isotalent";

$before=0;
$after=0;
$inserted_id=0;


class DbOperationsTest extends TestCase {
    private $mysqli;

    protected function setUp(): void {
        $this->mysqli = new mysqli($local_servername, $local_username, $local_password, $local_db);
        $this->mysqli->query("CREATE TEMPORARY TABLE users (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(50))");
    }

    public function testGetAfterCount() {
        $this->mysqli->query( $sql="INSERT INTO `transportations`".
            " ( `name`, `logo`, `address`, ".
            " `city`, `postal_code`, `phone`, ".
            " `email`, `photo1`, `photo2`, ".
            " `photo3`, `description`, `review_stars`, ".
            " `review_desc`, `vehicle_capacities`, `wheel_chair_accessible_vehicles`) ".
            " VALUES ".
            " ('deleteme','','',".
            " '','','2503003858',".
            " 'brunoaco@gmail.com','pic1.png','pic2.png',".
            " 'pic3.png','description','0',".
            " '','4','0')");
        //$result = getUserCount($this->mysqli);
        $result = $this->mysqli;
        $after= $result;
    }
    public function testGetLastId() {
        $result=$this->mysqli->query( $sql="SELECT max(ID) as id FROM `transportations`;");
        $inserted_id= $result;
    }
    public function testDestroyLastId($id) {
        $result=$this->mysqli->query( $sql="delete FROM `transportations` where ID=".$id.";");
        $inserted_id= $result;
    }
    public function testGetPreviousCount() {
        $result=$this->mysqli->query("select id from transportations;");
        //$count = getUserCount($this->mysqli);
        $before=$reult;//$count;
    }
}

//$this->setUp();
$this->testGetPreviousCount();
$this->testGetAfterCount();
$this->assertEquals($before+1, $after);
$this->testGetLastId();
$this->testDestroyLastId($inserted_id);
?>
