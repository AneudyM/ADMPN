<?php
require_once("include/inc_database_info.php");
?>


<link rel="stylesheet" type="text/css" href="style.css" media="screen">
<div id="main">
<?php
    $networkOwner = $_POST['networkOwner'];
    $networkDescription = $_POST['networkDescription'];
    $TableName = "Network";
    $sqlString = "INSERT INTO $TableName(network_owner, description) VALUES('$networkOwner', '$networkDescription')";
  
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
