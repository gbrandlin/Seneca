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
                 <div class="center" style="font-size:x-large; color:#f4511e;">SENECA</div>
                         </ons-toolbar>

<ons-tabbar swipeable position="auto">
    <ons-tab  page="tab1.html" label="Home" icon="ion-home, material:md-home" active>
    </ons-tab>
    <ons-tab page="tab2.html" label="Profile" icon="md-face" >
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



//$checkIn = pg_query($db)

//the problem is that the pk_id of the user is not the same as the forgein key so I need to do a query when logging in to save that as well. 
//^old problem

// new problem\/
//var_dump ($datares); 



$row = pg_fetch_all($datares);
//var_dump( $row);
if(is_array($row)){

// $checkinVar = pg_query($db, "SELECT status FROM job where pk_job =  $id");
//$chVR= pg_fetch_all($checkinVar);
 
// foreach($chVR as $array){
//$myass = $array['status'];
//$newvar = json_decode($myass);
//if($newvar ='[{"status":"In Progress"}]') {echo "style='background-color:#4511e'";} 
//echo $newvar;
//}
echo"<div id=res></div>";

foreach ($row as $array) {
$data = $array['pk_job'];
$id= json_decode($data);
 


 //echo$checkVar[0];
 //if($checkVar[0] ='In Progress') {echo "<ons-card style = 'background-color:#f4511e'>";} 
echo"<ons-card>";
 $checkinVar = pg_query($db, "SELECT status FROM job where pk_job =  $id");
 $checkVar = pg_fetch_row($checkinVar);
 if($checkVar[0]=='In Progress'){ echo$checkVar[0];}
echo  "<ons-ripple color='#f4511e' ></ons-ripple>";
  echo " <div id= '$id' onclick='customPush2(event)'  > "; 
                
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
    
  }else{
echo "NO JOBS LISTED";}
  //right now getting whole row from jobqueue 1/ only want select variables such as customer name and prolem and time 
 

 ?>
  </ul>


           
<template id="tab2.html">
    <ons-page id="Settings">
        <p style="text-align: center;">
        This is where the employee can access thier personal information
        <?php
              $empdata= pg_query($db, "SELECT * FROM employee where pk_employee =  $_SESSION[fk_emp]");
              while($row=pg_fetch_row($empdata)){
              echo"Name: $row[2] $row[3]";


              }
              ?>
        <ons-button onclick="  window.location.href = 'senecalogout.php'; " modifier='small' style = 'background-color:#f4511e'  >LOGOUT </ons-button>
        <!-- <a href = senecalogout.php >LOGOUT</a>;-->

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
                 <div class="center" style="font-size:x-large; color:#f4511e;">SENECA</div>
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



