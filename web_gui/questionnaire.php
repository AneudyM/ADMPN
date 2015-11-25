<?php
require_once("include/inc_database_info.php");
?>

<link rel="stylesheet" type="text/css" href="style.css" media="screen">
<div id="main">
    <?php include('include/inc_header.html') ?>
    
    <form name ="view_topology" action="view_subnet.php" method="post">
        <h3>Network has been created!!!</h3>
        <button name="topologyNumber"> View Created Topology </button>        
    </form>
    <?php include('include/inc_footer.html') ?>
</div>
    
<?php
$number_vlan = $_POST['number_vlan'];
$sqlString = "select networkId from NETWORK 
    order by networkId desc
    limit 1" ;
$queryResult = $DBConnect->query($sqlString);
while ($row = $queryResult->fetch_assoc()){
    $lastID = $row ["networkId"];    
    }    
$updateNetwork = "update NETWORK
        set numberOfSubnets='$number_vlan'
        where networkId='$lastID'";
$query = $DBConnect->query($updateNetwork);
?>

<?php
$DBConnect->close();
?>