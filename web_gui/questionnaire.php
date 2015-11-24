<?php
require_once("include/inc_database_info.php");
?>

    
<?php
$number_vlan = $_POST("number_vlan");
$networkOwner = $_POST['networkOwner'];
$networkDescription = $_POST['networkDescription'];
$sqlString= "select network_id from Network where network_owner='$networkOwner'"
        . "and description='$networkDescription'";
$queryResult =$DBConnect->query($sqlString);
$row = $queryResult->fetch_assoc();
$vlan = $row["network_id"];
$insertingVLAN = "update Network set number_of_subnets='$number_vlan' where "
        . "network_id='$vlan'";

     echo "<p> $vlan </p>";
?>

<?php
$DBConnect->close();
?>