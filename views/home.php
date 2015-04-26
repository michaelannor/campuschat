<?php
session_start();
 	if(!isset($_SESSION['user_id'])){
 		header("location: login.php");
 		exit();
 	}
   else{
    //  echo $_SESSION['user_id'];
   }
 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <!--Import materialize.css-->
     <link type="text/css" rel="stylesheet" href="../assets/css/materialize.min.css"  media="screen,projection"/>

     <!--Let browser know website is optimized for mobile-->
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   </head>

   <body>
     <!--Import jQuery before materialize.js-->
     <script type="text/javascript" src="../assets/js/jquery-2.1.3.min.js"></script>
     <script type="text/javascript" src="../assets/js/materialize.js"></script>

     <script>
       // Function to send ajax request
       function sendRequest(u){
         // Send request to server
         //u a url as a string
         //async is type of request
         var obj=$.ajax({url:u,async:false});
         //Convert the JSON string to object
         var result=$.parseJSON(obj.responseText);
         return result;	//return object
       }

      //  $(document).ready(function()
      //  {
      //    displayContacts();
      //  });

       // Contact Pane Onclick Function
       $(function(){
         $("#contacts-click").click(function(){
           displayContacts();
         });
       });

       // Function to validate users
       function displayContacts(){
       var theUrl="../controllers/controller.php?cmd=2";
       var obj=sendRequest(theUrl);		//send request to the above url
       var contactcard = "";
       if(obj.result===1){					//check result
         for(var index in obj.contacts){
           contactcard += "<div class='section col s12'>";
           contactcard +=  "<div class='contactcardimg col s2'>";
           contactcard += "<img src='../assets/img/test.jpg' alt='' class='circle responsive-img'>";
           contactcard += "</div>";
           contactcard +="<div class='contactcardtext col s10'>";
           contactcard +="<h6 class='teal-text'>" + obj.contacts[index].username + "</h6>";
           contactcard +="<p>Status: Offline</p>";
           contactcard +="</div>";
           contactcard +="<div class='divider col s12'></div><br><br><br><br>";
           contactcard +="</div>";
         }
        //  alert(contactcard);
         $("#contacts").html(contactcard);
        //  alert("after");
        //  window.location.replace("home.php");
         //$("#divDesc").text(obj.desc);		//set div with the description from the result
         //$("#divDesc").css("top",event.y);	//set the location of the div
         //$("#divDesc").css("left",event.x);
         //$("#divDesc").show();				//show the div element
       }else{
         //show error message
         alert("failed");
         // $("#divStatus").text("error while getting description");
         // $("#divStatus").css("backgroundColor","red");
       }
     }


       </script>

    <!-- Navigation Menu -->
    <nav>
       <div class="nav-wrapper teal">
         <a href="#!" class="brand-logo"></a>
         <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
         <ul class="right hide-on-med-and-down">
    <!--
           <li><a href="sass.html">Sass</a></li>
           <li><a href="components.html">Components</a></li>
           <li><a href="javascript.html">Javascript</a></li>
           <li><a href="mobile.html">Mobile</a></li>
    -->
         </ul>
         <ul class="side-nav" id="mobile-demo">
           <li><a href=""></a></li>
               </ul>
       </div>
     </nav>


     <div class="row">

      <div class="row">
         <div class="col s12">
           <!-- Tabs for Chats and Contacts -->
           <ul class="tabs ">
             <li id="chats-click" class="tab col s4"><a class="active" href="#chats">Chats</a></li>
             <li id="contacts-click" class="tab col s4"><a href="#contacts">Contacts</a></li>
           </ul>
         </div>

         <!-- Chat Tab Contents -->
         <div id="chats" class="col s12">

         </div>

         <!-- Contact Tab Contents -->
         <div id="contacts" class="col s12">

          <!-- <div class="section col s12">
            <div class="contactcardimg col s2">
                <img src="../assets/img/test.jpg" alt="" class="circle responsive-img">
            </div>

            <div class="contactcardtext col s10">
              <h6 class="teal-text">Contact Name 2</h6>
              <p>Status: Offline</p>
            </div>
            <div class="divider col s12"></div><br><br><br><br>
          </div>


          <div class="section row col s12">
            <div class="contactcardimg col s2">
                <img src="../assets/img/test.jpg" alt="" class="circle responsive-img">
            </div>

            <div class="contactcardtext col s10">
              <h6 class="teal-text">Contact Name 2</h6>
              <p>Status: Offline</p>
            </div>
            <div class="divider col s12"></div><br><br><br><br>
          </div> -->

       </div>
     </div>













   </body>
 </html>
