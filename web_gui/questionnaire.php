<link rel="stylesheet" type="text/css" href="style.css" media="screen">

<?php
require_once("include/inc_database_info.php");
require_once("include/library.php");

         $number_vlan = $_POST['number_vlan'];
       $topology_name = $_POST['name_topology'];
         $topology_ip = $_POST['ip_topology'];
       $topology_mask = $_POST['netmask_topology'];
$topology_description = $_POST['description_topology'];

$networkID = mysql_insert_id();

 //Updates Netowork Table, adding the number of VLANs 
$updateNetwork = "UPDATE NETWORK
                     SET numberOfSubnets='$number_vlan'
                   WHERE networkId='$networkID'";
$DBConnect->query($updateNetwork);

# Get next available private IP
$nextPrivateIP = getNextPrivateIP($DBConnect);
#Creates Topology
$topologyID = createTopology($DBConnect, $topology_name, $nextPrivateIP, $topology_description, $networkID);
updatePrivateIPStatus($topologyID, $DBConnect);
$routerHostname = $topology_name."_Router";
$switchHostname = $topology_name."_Switch";

$topologyIP = getTopologyIP($topologyID);
$topologyOctet= explode('.', $topologyIP);
$routerIP = $topologyOctet[0].".".$topologyOctet[1].".0.1";

$routerID = createRouter($DBConnect, $routerHostname, $networkID, $topologyID);
$switchID = createSwitch($switchHostname, $DBConnect, $topologyID, $networkID);
attachInterfaceTo($routerID, $switchID, $DBConnect, $routerIP);


//Assigns services to a node.
$service = array($_POST['ssh'], 
                 $_POST['telnet'],
                 $_POST['http'], 
                 $_POST['ftp'],
                 $_POST['imServer'],
                 $_POST['mail']);
$i = 0;
//Insert services into node table and assign an interface
while ($i < 7){
    if(isset($service[$i])){
        $hostname= $topology_name."_".$service[$i]."";
        $nodeID = createService($hostname, $DBConnect, $topologyID, $networkID);
        $ipAddress = $topologyOctet[0].".".$topologyOctet[1].".1.".($i+2)."";
        attachInterfaceTo($nodeID, $switchID, $DBConnect, $ipAddress);
    }    
    $i++;
}
for($j=0; $j< $number_vlan;$j++ )
{
    $departmentName = $_POST['dptName_'.$j];
    $departmentHost = $_POST['noHost_'.$j];
    $vlanIpAddress = $topologyOctet[0].".".$topologyOctet[1].".".($j+1).".0";
    
    for($k=0; $k<$departmentHost; $k++){
        $pcHostname = $departmentName."_".$k."";
        $pcID = createWorkstation($DBConnect, $pcHostname, $networkID, $topologyID);        
        $vlanIP = createVlan($DBConnect, $departmentName, $vlanIpAddress, $switchID);
        $vlanIPOctet = explode('.', $vlanIpAddress);
        $pcIP = $vlanIPOctet[0].".".$vlanIPOctet[1].".".$vlanIPOctet[2].".".($k+2)."";
        attachInterfaceTo($pcID, $switchID, $DBConnect, $pcIP);
    }
}

$DBConnect->close();
?>

<div id="main">
    <?php include('include/inc_header.html') ?>
    
    <form name ="view_topology" action="view_subnet.php" method="post">
        <h3>Topology has been created!!!</h3>
        <button name="topologyNumber"> View Created Topology </button>  
        <button name="newTopology"> Create a new Topology </button> 
        <input type="hidden" value="<?php echo $networkID; ?>" name="getID"/>
    </form>
    <?php include('include/inc_footer.html') ?>
</div>

