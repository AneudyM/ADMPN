<?php
require_once("include/inc_database_info.php");
?>

<form name="searchbox" action="view_networks.php">
    <input name="search" type="text" placeholder="Search" />
    <input name="search_button" type="button" value="Search" />
</form>

<?php
$TableName="Network";
$sqlString= "SELECT * FROM $TableName";
$queryResult =$DBConnect->query($sqlString);

echo "<table border='1' cellpadding='5'>\n <tr><th>Network ID</th>"
        . "<th>Network Owner</th>"
        . "<th>Number of Subnets</th><th>Description</th></tr>";

while ($row = $queryResult->fetch_assoc()){
    echo"<tr><td>" . $row["network_id"]. "</td>
        <td>" . $row["network_owner"]. "</td>
        <td>" . $row["number_of_subnets"]. "</td>
        <td>" . $row["description"]. "</td></tr>\n";
            
}
 echo"</table>";
?>

<?php
$DBConnect->close();
?> 

