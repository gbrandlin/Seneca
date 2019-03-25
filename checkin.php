<?php
require('sennecaconnect.php');
if(isset($_GET['poo'])){
 $myvar = $_GET['poo'];
 
  }
// now to run the query that says that this employee has checked in to this particular job....

 $res= pg_query($db," SELECT checkin($myvar)");


 ?>