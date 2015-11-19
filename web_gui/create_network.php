<link rel="stylesheet" type="text/css" href="style.css" media="screen">
<div id="main">
<?php
    $networkOwner = $_POST['networkOwner'];
    $networkDescription = $_POST['networkDescription'];
    include ('include/inc_header.html');
    echo "<br>";
    echo "The network <b>".$networkOwner."</b> has been successfully created.";
    echo "<br>";
    echo "Description: <b>".$networkDescription."</b>.";
?>

</div>
  
