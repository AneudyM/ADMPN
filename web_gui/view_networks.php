<?php
require_once("include/inc_database_info.php");
?>

<form name="searchbox" action="view_networks.php">
    <input name="search" type="text" placeholder="Search" />
    <input name="search_button" type="button" value="Search" />
</form>

<?php

$TableName="NETWORK";
$sqlString= "SELECT * FROM $TableName";
$queryResult =$DBConnect->query($sqlString);

echo "<table border='1' cellpadding='5'>\n <tr><th>Network ID</th>"
        . "<th>Network Owner</th>"
        . "<th>Number of Subnets</th><th>Description</th></tr>";

while ($row = $queryResult->fetch_assoc()){
    $networkID = $row["networkId"];
    echo"<tr><td> <a href='view_subnet.php?network=$networkID'>" . $networkID. " </a></td>
        <td>" . $row["networkOwner"]. "</td>
        <td>" . $row["numberOfSubnets"]. "</td>
        <td>" . $row["networkDescription"]. "</td></tr>\n";
            
}
 echo"</table>";
?>

<?php
$DBConnect->close();
?> 

