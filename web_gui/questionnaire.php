<link rel="stylesheet" type="text/css" href="style.css" media="screen">

<?php
require_once("include/inc_database_info.php");

$number_vlan = $_POST['number_vlan'];
$topology_name = $_POST['name_topology'];
$topology_ip = $_POST['ip_topology'];
$topology_mask = $_POST['netmask_topology'];
$topology_description = $_POST['description_topology'];
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
$nameTopology = "Insert into TOPOLOGY(topologyName,topologyIP, topologyNetmask,"
        . "NETWORK_networkId, topologyDescription) VALUES ('$topology_name', "
        . "'$topology_ip', '$topology_mask','".$row["networkId"]."', '$topology_description')";
$querynameTopology = $DBConnect->query($nameTopology);

//Getting the TopologyID
$topologyID = "select * from TOPOLOGY 
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
        
        $findNoteType = "select nodeId from NODE 
        order by nodeId desc 
        limit 1" ;
        $nodeID = $DBConnect->query($findNoteType);
        $rowNodeId = $nodeID->fetch_array();
        
        $insertInterface = "Insert into INTERFACE(int_ip_address, int_netmask, NODE_nodeId)"
                . "values('$topology_ip'.10.".$i."','$topology_mask','".$rowNodeId["nodeId"]."')";
        //Services will always have VLAN 10
        $DBConnect->query($insertInterface);
        $i++;
    }    
}
for($j=0; $j< $number_vlan;$j++ )
{
    $departmentName = $_POST['dptName_'.$j];
    $departmentHost = $_POST['noHost_'.$j];
    $departmentIP = $_POST['ipRange_'.$j];
    
    for($k=0; $k<$departmentHost; $k++){
        $createNode = "INSERT INTO NODE(hostname,NODE_TYPE_nodeTypeId, TOPOLOGY_topologyId, TOPOLOGY_NETWORK_networkid)"
                . "VALUES ('".$departmentName."_".$k."','5','".$rowTopologyID ["topologyId"]."','".$row ["networkId"]."')";
        $DBConnect->query($createNode);
        
    }
    
    $insertVLAN = "Insert into VLAN(vlan_description, vlan_ip_address, NETWORK_nodeId)"
            . "VALUES ('$departmentName', $departmentIP,'". $rowNodeId["nodeId"]."')";
    //Needs to add the VLAN to a switch.
    
}
//Inserting Departments


$DBConnect->close();
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

