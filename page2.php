

    
      <?php 
      echo"<h3 style = 'color:#f4511e; text-align:center;' >Details </h3>";
      echo"<br/>\n";
      
     
      ?>

    
    
    <?php 
    require"sennecaconnect.php";
    // somehow get the job number when clicked and save it in the session. 
// i see how it is!! you mother fuckers!!! when we login, pretty sure we need to establish the jobs they have and save that somehow to put it over here...
if(isset($_GET['poo'])){
 $myvar = $_GET['poo'];
 //echo $myvar;
  }
  
 $checkinVar = pg_query($db, "SELECT status FROM job where pk_job =  $myvar");
 $checkVar = pg_fetch_row($checkinVar);
 //echo$checkVar[0];

$result= pg_query($db, "SELECT * FROM jobview where pk_job= $myvar ");//CHANGE!!!!!!!!
$location = pg_query($db,"SELECT address, city,state FROM jobview where pk_job =$myvar");//MATCH THE CHANGE!!!!!!


while ($row = pg_fetch_row($result)){

  echo "Problem:  $row[1]" ;
  echo "<br />\n";
  echo " Address: $row[2]";
  echo "<br />\n";
 
 
  echo "Customer: $row[6]";
  echo"<br/>\n";  
 echo"<br/>\n"; 
  echo"Priority: $row[9]";
  echo"<br/>\n";  
  echo "Due By: $row[14]";
  echo"<br/>\n";
  echo "Description: $row[16]";
   echo"<br/>\n";
   
     }
     //if not in progress setDisabled to true, else false 
  echo "<ons-button style = 'background-color:#f4511e' onclick='checkin(event)'    modifier='large' id='$myvar' >Check In </ons-button>";
  echo"<br>";
  if($checkVar[0]=='In Progress'){echo "<ons-button style = 'background-color:#f4511e' onclick='checkout(event)' modifier='large' id='$myvar' >Checkout </ons-button>";}

  //echo "<ons-button style = 'background-color:#f4511e' onclick='checkout(event)' modifier='large' id='$myvar' >Checkout </ons-button>";
      //echo "<input class='form-control btn-black' type='submit' value='CHECK IN' id='$myvar' onclick='checkin(event)'>";   
      //echo "<input class='form-control btn-black' type='submit' value='CHECK OUT' id='$myvar' onclick='checkout(event)'>"; 
      
  
      
   
     $loc=pg_fetch_row($location);
    
   echo "<a href = 'https://www.google.com/maps/search/$loc[0]$loc[1]$loc[2] 'style = ' text-align:center;'>JOB LOCATION</a>";
   echo "<br>";


   echo"<a href='seneca.php' style = ' text-align:center;'>JOB LIST</a>"

   ?>
   <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>

var checkin = function (event) {
   var poo = event.target.id
  
     
    $.ajax({url:"checkin.php",data: {"poo":poo}}).done(function(data){ $("#newdiv").html(data);});
             
      
   };

   var checkout = function (event) {
   var poo = event.target.id
  
 
    $.ajax({url:"checkout.php",data: {"poo":poo}}).done(function(data){ $("#newdiv").html(data);});
             
      
   };


   </script>
    
   
    <style>
    a:link, a:visited{
     color:white;
  background-color:#f4511e;
  padding: 14px 25px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
      }
    </style>
    
