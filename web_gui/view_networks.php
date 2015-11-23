<?php
require_once("include/inc_database_info.php");
?>

<form name="searchbox" action="view_networks.php">
    <input name="search" type="text" placeholder="Search" />
    <input name="search_button" type="button" value="Search" />
</form>

<?php
$TableName="Network";
$sqlString="SELECT * FROM $TableName";
$queryResult =$DBConnect->query($sqlString);
echo "<table border='1' cellpadding = '5'><tr><th>Network ID</th>"
        . "<th>Network Owner</th>"
        . "<th>Number of Subnets</th><th>Description</th></tr></table>";
while (($row = $queryResult->fetch_row()) !==FALSE){
    echo"<tr><td>{$row["network_id"]}</td>";
    echo"<tr><td>{$row["network_owner"]}</td>";
    echo"<tr><td>{$row["number_of_subnets"]}</td>";
    echo"<tr><td>{$row["description"]}</td>";
    
}
 echo"</table>";
?>

<?php
$DBConnect->close();
?> 

