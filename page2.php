

    
      <?php 
      echo"Details ";
      
     
      ?>

    
    
    <?php 
    require"sennecaconnect.php";
    // somehow get the job number when clicked and save it in the session. 
// i see how it is!! you mother fuckers!!! when we login, pretty sure we need to establish the jobs they have and save that somehow to put it over here...
if(isset($_GET['poo'])){
 $myvar = $_GET['poo'];
 //echo $myvar;
  }
  
 
 
$result= pg_query($db, "SELECT * FROM jobview where pk_job= $myvar ");//CHANGE!!!!!!!!
$location = pg_query($db,"SELECT address, city,state FROM jobview where pk_job =$myvar");//MATCH THE CHANGE!!!!!!


while ($row = pg_fetch_row($result)){
  echo "Problem:  $row[1]" ;
  echo "<br />\n";
  echo " Address: $row[2]";
  echo "<br />\n";
  echo "City: $row[3]";
  echo"<br/>\n";
  echo "State: $row[4]";
  echo"<br/>\n";
  echo "ZipCode: $row[5]";
  echo"<br/>\n";
  echo "Customer: $row[6]";
  echo"<br/>\n"; 
  echo "Payment Method: $row[8]";
  echo"<br/>\n";
  echo"Priority: $row[9]";
  echo"<br/>\n";
  echo "Start Time: $row[13]";
  echo"<br/>\n";
  echo "Due By: $row[14]";
  echo"<br/>\n";
  echo "Description: $row[16]";
   echo"<br/>\n";
     }

  
 echo "<ons-button onclick='checkout(event)' modifier='small' id='$myvar' >Checkout </ons-button>";
 echo"<br>";
 echo "<ons-button onclick='checkin(event)' modifier='small' id='$myvar' >Check In </ons-button>";
      //echo "<input class='form-control btn-black' type='submit' value='CHECK IN' id='$myvar' onclick='checkin(event)'>";   
      //echo "<input class='form-control btn-black' type='submit' value='CHECK OUT' id='$myvar' onclick='checkout(event)'>"; 
      
  
      
   
     $loc=pg_fetch_row($location);
    
   echo "<a href = 'https://www.google.com/maps/search/$loc[0]$loc[1]$loc[2] '>JOB LOCATION</a>";


   echo"<a href='seneca.php'>JOBS LIST</a>"

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
    
   
    
    
