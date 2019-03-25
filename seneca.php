<?php

session_start();
if(isset($_SESSION['isActive']) && $_SESSION['isActive'] === true ) {
   
   require('sennecaconnect.php');
   
 

 ?>

 

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>

    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <!--<link rel="stylesheet" href ="./onsen-css-components.min.css">
     <link rel="stylesheet" href ="./onsen-css-components.css">
      <link rel="stylesheet" href ="./theme.css">-->

   <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
    
      
          

        <meta charset="utf-8" />
       
           
</head>
<body>
 <ons-navigator id="myNavigator">
        <ons-page>
      
 <ons-toolbar>
                 <div class="center" style="font-size:x-large">SENECA TEST</div>
                         </ons-toolbar>

<ons-tabbar swipeable position="auto">
    <ons-tab page="tab1.html" label="Home" icon="ion-home, material:md-home" active>
    </ons-tab>
    <ons-tab page="tab2.html" label="Settings" icon="md-settings" >
    </ons-tab>
    
</ons-tabbar>
</ons-navigator>
</ons-page>


<template id="tab1.html">
    <ons-page id="Home">
        <p style="text-align: center;">        
        </p>
        <ons-pull-hook id="pull-hook">
        
        </ons-pull-hook>
        <ul class="list" id='newdiv'>
            
    
<?php
   
 

$datares= pg_query($db, "SELECT * FROM jobqueueview where fk_employee =  $_SESSION[fk_emp]");

//if fk_emp is not in job queueview, then show no jobs listed ELSE 
//if($datares = '!null'){

 //echo"nothing here";}
//else{
//the problem is that the pk_id of the user is not the same as the forgein key so I need to do a query when logging in to save that as well. 

$row = pg_fetch_all($datares);
echo"<div id=res></div>";

foreach ($row as $array) {
$data = $array['pk_job'];
$id= json_decode($data);
 
echo"<ons-card>";
  echo " <div id= '$id' onclick='customPush2(event)'> "; 
                  
  echo  $array['etastart'] ;
  echo "<br />\n";
  echo  $array['dueby'];
  echo "<br />\n";
  echo $array['customername'];
  echo"<br/>\n";
  echo $array['type']; 
  echo"</div>";
  echo"</ons-card>";
  //need to work on making it dynamic...
  //this while loop works, does show all info execpt for name in first row, only need select info so the query needs to change, this query will work on the job detail page. 
    }
  //}
  //right now getting whole row from jobqueue 1/ only want select variables such as customer name and prolem and time 
 ?>
  </ul>


           
<template id="tab2.html">
    <ons-page id="Settings">
        <p style="text-align: center;">
        This is where the employee can access thier personal information
              
        <ons-button onclick="  window.location.href = 'senecalogout.php'; " modifier='small'  >LOGOUT </ons-button>
        <!-- <a href = senecalogout.php >LOGOUT</a>;-->

        </p>
    </ons-page>
</template>


<template id="tab3.html">
    <ons-page id="connection">
        <p>
        if we have a connection, this page will let us know...
           

		<?php
   
 
$result = pg_query($db, "SELECT * FROM jobboardview");

while ($row = pg_fetch_row($result)) {
  echo "Job: $row[0]  etastart: $row[1]   Due by: $row[2]" ;
  echo "<br />\n";
}

?>
        </p>
    </ons-page>


    </template>

  
  <template id="page2.html">
  <ons-page id="page2">
    <ons-toolbar>
     
      <?php 
      echo"Details ";
     
      ?>
</div>
    </ons-toolbar>
    <p>
    
    
    <?php 

    // somehow get the job number when clicked and save it in the session. 
// i see how it is!! you mother fuckers!!! when we login, pretty sure we need to establish the jobs they have and save that somehow to put it over here...
if(isset($_GET['poo'])){
 $myvar = $_GET['poo'];
 echo $myvar;
  }
  
  echo "<script>document.writeln(poo);</script>";
 
$result= pg_query($db, "SELECT * FROM jobview where pk_job= $myvar ");//CHANGE!!!!!!!!
$location = pg_query($db,"SELECT address, city,state FROM jobview where pk_job =$myvar");//MATCH THE CHANGE!!!!!!
//$job = pg_query($db_connection,"SELECT address, city,state FROM jobview where pk_job=2 ");

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
     }

     echo"<button>CHECK IN</button>";
     $loc=pg_fetch_row($location);
    var_dump( $loc[0]);
   echo "<a href = 'https://www.google.com/maps/search/$loc[0] $loc[1] $loc[2] '>JOB LOCATION</a>";
    ?>
    </p>
    
    </ons-page>
    </template>


<script>
ons.ready(function() {
    var pullHook = document.getElementById('pull-hook');

    pullHook.addEventListener('changestate', function(event) {
        var message = '';

        switch (event.state) {
            case 'initial':

                break;
            case 'preaction':
                break;
                case ' action ':
                message = 'Loading...';
                
                break;
        }

        pullHook.innerHTML = message;
    });

    pullHook.onAction = function(done) {
    location.reload();
        setTimeout(done, 1000);
    };
});

</script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script>

var customPush2 = function (event) {
   var poo = event.target.id
  
 
    $.ajax({url:"page2.php",data: {"poo":poo}}).done(function(data){ $("#newdiv").html(data);});
             
      
   };

   </script>





</body>
</html>



<?php  } else


 { ?>
 <!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
    
      
          

        <meta charset="utf-8" />
       
           
</head>
 <body>
 <ons-navigator id="myNavigator">
        <ons-page>
      
 <ons-toolbar>
                 <div class="center" style="font-size:x-large">SENECA</div>
                         </ons-toolbar>

<div class='row'>
    <div class="col-lg-4"></div>

    <div class="col-lg-4" id='contentCenter'>



      <div class='well well-lg'>
      <form action='Secenalogin.php' method='POST' >
        <div class="form-group well ">
          <label for="email"></label>
          <input type="text" class="form-control"  placeholder="USER NAME" required name='user'>
          <label for="password"></label>
          <input type="password" class="form-control"  placeholder='PASSWORD' required name='password'>
        </div>
        <input class='form-control btn-black' type="submit" value='LOG IN' id='submit'>
      </form>
    </div>

    <div class="col-lg-4"></div>
</div>

<?php } 



