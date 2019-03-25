<?php
require('sennecaconnect.php');
if(isset($_GET['poo'])){
 $myvar = $_GET['poo'];
 
  }
// now to run the query that says that this employee has checked in to this particular job....

 //$res= pg_query($db," SELECT checkout($myvar)");
 //need to add STATUS to checkout query
 // add a drop done form for the status of the job being checked out of.

?>
  <ons-list>
    <ons-list-item tappable>
      <label class="left">
        <ons-radio name="color" input-id="radio-1" checked></ons-radio>
      </label>
      <label for="radio-1" class="center">
        Complete
      </label>
    </ons-list-item>
    <ons-list-item tappable>
      <label class="left">
        <ons-radio name="color" input-id="radio-2"></ons-radio>
      </label>
      <label for="radio-2" class="center">
        In Progress
      </label>
    </ons-list-item>
  </ons-list>

  <section style="padding: 8px">
   
    <ons-button onclick="checkout(event)" modifier="large" >Update Job </ons-button>
  </section>


  <script>
   var checkout = function (event) {
   var poo = event.target.id
  
  var done = document.getElementById('radio-1').value;
  var inprog = document.getElementById('radio-2').value;

  alert(done);
  alert(inprog);

   <?php 
   $res= pg_query($db," SELECT checkout($myvar,'Completed')");

   //header("location: seneca.php");
   ?>
             
      
   };

  </script>



