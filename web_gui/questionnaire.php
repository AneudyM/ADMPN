<link rel="stylesheet" type="text/css" href="style.css" media="screen">

<?php
require_once("include/inc_database_info.php");

$number_vlan = $_POST['number_vlan'];
$topology_name = $_POST['name_topology'];
//Selects just recently created Network ID
$sqlString = "select networkId from NETWORK 
    order by networkId desc
    limit 1" ;
$queryResult = $DBConnect->query($sqlString);
$row  = $queryResult->fetch_array();
 //Updates Netowork Table, adding the number of VLANs 
$updateNetwork = "update NETWORK
        set numberOfSubnets='$number_vlan'
        where networkId='".$row ["networkId"]."'";
$query = $DBConnect->query($updateNetwork);
//Modifies th Topology Table and assings it to a network.
$nameTopology = "Insert into TOPOLOGY(topologyName,NETWORK_networkId) VALUES "
        . "('$topology_name', '".$row["networkId"]."')";
$querynameTopology = $DBConnect->query($nameTopology);

//Getting the TopologyID
$topologyID = "select topologyId from TOPOLOGY 
    order by topologyId desc
    limit 1" ;
$resultTopID = $DBConnect->query($topologyID);
$rowTopologyID  = $resultTopID->fetch_array();

//Assigns services to a node.
$service = array($_POST['ssh'], $_POST['telnet'], $_POST['http'], $_POST['ftp'], $_POST['imServer'], $_POST['mail'],
        $_POST['wireless_AP']);
$i = 0;
//Insert services into node table and assign an interface
while ($i < 7){
    if(isset($service[$i])){
        $insertServices = "Insert into NODE (hostname, NODE_TYPE_nodeTypeId, TOPOLOGY_topologyId, TOPOLOGY_NETWORK_networkid)"
        . "values ('".$topology_name."_".$service[$i]."','6','".$rowTopologyID ["topologyId"]."','".$row ["networkId"]."')";
        $DBConnect->query($insertServices);
        
        
        
    }
    
    $i++;
}
?>

<div id="main">
    <?php include('include/inc_header.html') ?>
    
    <form name ="view_topology" action="view_subnet.php" method="post">
        <h3>Topology has been created!!!</h3>
        <button name="topologyNumber"> View Created Topology </button>  
        <button name="newTopology"> Create a new Topology </button> 
        <input type="hidden" value="<?php echo $row ["networkId"]; ?>" name="getID"/>
    </form>
    <?php include('include/inc_footer.html') ?>
</div>

<?php
$DBConnect->close();
?>

