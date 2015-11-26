<?php
require_once("include/inc_database_info.php");
?>

<link rel="stylesheet" type="text/css" href="style.css" media="screen">
<div id="main">
    <?php include('include/inc_header.html') ?>
    
    <form name ="view_topology" action="view_subnet.php" method="post">
        <h3>Topology has been created!!!</h3>
        <button name="topologyNumber"> View Created Topology </button>  
        <button name="newTopology"> Create a new Topology </button> 
        <input type="text" value="NONO" name="getID"/>
    </form>
    <?php include('include/inc_footer.html') ?>
</div>
    
<?php
$number_vlan = $_POST['number_vlan'];
$topology_name = $_POST['name_topology'];
$sqlString = "select networkId from NETWORK 
    order by networkId desc
    limit 1" ;
$queryResult = $DBConnect->query($sqlString);
$row  = $queryResult->fetch_array();
  
$updateNetwork = "update NETWORK
        set numberOfSubnets='$number_vlan'
        where networkId='".$row ["networkId"]."'";
$query = $DBConnect->query($updateNetwork);
$nameTopology = "Insert into TOPOLOGY(topologyName,NETWORK_networkId) VALUES "
        . "('$topology_name', '".$row["networkId"]."')";
$querynameTopology = $DBConnect->query($nameTopology);

?>

<?php
$DBConnect->close();
?>

