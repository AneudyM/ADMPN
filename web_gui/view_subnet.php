<?php
require_once("include/inc_database_info.php");
?>

<link rel="stylesheet" type="text/css" href="style.css" media="screen">
<div id="main">
    <?php include('include/inc_header.html') ?><br>
    <h3>View Network Topology</h3>
    
    
    <?php
    $networkID = $_GET['network'];
    $sqlstring = "Select networkOwner from NETWORK where networkId='$networkID'"; 
    $queryResult = $DBConnect->query($sqlstring); 
    $sqlTopology = "select * from TOPOLOGY where NETWORK_networkId='$networkID'";
    $queryTopology = $DBConnect->query($sqlTopology);
    
    while ($row = $queryResult->fetch_assoc()){
        echo "<p> Network:  ".$row ["networkOwner"]."</p>";
    }
    echo "<p><b> Topologies of the selected Network </b></p>";
    echo "<table id='tableTopology' border='1' cellpadding='5' align='center'>\n <tr>"
        . "<th>Number</th>"
        . "<th>Name</th>"
        . "<th>IP Address Range</th>"
        . "<th>Description</th>"
        . "<th>Active</th></tr>";
    
    while ($row = $queryTopology->fetch_assoc()){
    echo"<tr><td>" . $row["topologyId"]. " <a href='update_topology.php?edit="
            .$row["topologyId"]."'>Update Value</a> </td>
        <td>" . $row["topologyName"]. "</td>
        <td>" . $row["topologyIP"]. "</td>
            <td>" . $row["topologyDescription"]. "</td>
        <td>" . $row["topologyStatus"]. "</td></tr>\n";
    }
    
    echo "</table>";
    ?>  
    
    <br><br>
    <?php include('include/inc_footer.html') ?>
</div>


    
<?php
$DBConnect->close();
?>
