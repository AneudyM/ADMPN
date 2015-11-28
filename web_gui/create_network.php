<?php
require_once("include/inc_database_info.php");
?>

<?php
if ($DBConnect->connect_errno){
    echo "<p> Unable to connect to DB. </p>"
    ."<p> Error Code ".$DBConnect->connect_errno
     .       ": ". $DBConnect->connect_error . "</p>\n";
}
?>

<link rel="styles<?php
if ($DBConnect->connect_errno){
    echo "<p> Unable to connect to DB. </p>"
    ."<p> Error Code ".$DBConnect->connect_errno
     .       ": ". $DBConnect->connect_error . "</p>\n";
}
?>heet" type="text/css" href="style.css" media="screen">
<div id="main">
    
<?php
    $networkOwner = $_POST['networkOwner'];
    $networkDescription = $_POST['networkDescription'];
    $sqlString = "INSERT INTO NETWORK(networkOwner, networkDescription) VALUES"
            . "('$networkOwner', '$networkDescription')";
    $queryResult = $DBConnect->query($sqlString);
    
    $sqlselectID = "select networkId from NETWORK 
    order by networkId desc
    limit 1" ;    
    $queryResultID = $DBConnect->query($sqlselectID);
    $rowID  = $queryResultID->fetch_array();
    
    $sqlpublicIP = "Select publicIP from PUBLIC_IP_POOL where available='1'"
            . "limit 1";    
    $queryPublicIP = $DBConnect->query($sqlpublicIP);
    $rowIP = $queryPublicIP->fetch_array();
    
    $sqlassignIP = "Update NETWORK set publicIPAddress='".$rowIP['publicIP']."' "
            . "where networkId=".$rowID['networkId']."";
    $queryassignIP = $DBConnect->query($sqlassignIP);
    
    $sqlnotavaiIP = "Update PUBLIC_IP_POOL set available='0' where "
            . "publicIP='".$rowIP['publicIP']."'";    
    $querynoAvail = $DBConnect->query($sqlnotavaiIP);
    
    include ('include/inc_header.html');
    echo "<br>";
    echo "The network <b>".$networkOwner."</b> has been successfully created.";
    echo "<br>";
    echo "Description: <b>".$networkDescription."</b>.";
    include ('include/inc_questionnaire.html');
    
?>
</div>

<?php
$DBConnect->close();
?> 
