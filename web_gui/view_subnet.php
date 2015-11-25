<?php
require_once("include/inc_database_info.php");
?>

<link rel="stylesheet" type="text/css" href="style.css" media="screen">
<div id="main">
    <?php include('include/inc_header.html') ?><br>
    <h3>View Topology</h3><br>
    <?php include('include/inc_footer.html') ?>
    
</div>

<?php
    $networkID = $_GET['network'];
    $sqlstring = "Select network_owner from Network where network_id= $networkID"; 
    $queryResult = $DBConnect->query($sqlstring); 
    
    while ($row = $queryResult->fetch_assoc()){
    echo "<p> Network:  ".$row ["networkOwner"]."</p>";
    }
    echo "<p><b> Topologies of the selected Network </b></p>";
    echo "<table border='1' cellpadding='5'>\n <tr><th>Number</th>"
        . "<th>Name</th>"
        . "<th>IP Address Range</th><th>Default Gateway</th>"
        . "<th>Active</th><th>Decription</th></tr>";
    
    
?>  
    
<?php
$DBConnect->close();
?>
