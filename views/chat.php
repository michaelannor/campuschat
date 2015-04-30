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

       $(document).ready(function()
       {
         displayChats();
       });

       // Contact Pane Onclick Function
       $(function(){
         $("#contacts-click").click(function(){
           displayContacts();
         });
       });

       // Chat Pane Onclick Function
       $(function(){
         $("#chats-click").click(function(){
           displayChats();
         });
       });

       // Function to display all contacts
       function displayContacts(){
       var theUrl="../controllers/controller.php?cmd=1";
       var obj=sendRequest(theUrl);		//send request to the above url
       var contactcard = "";
       if(obj.result===1){					//check result
         for(var index in obj.contacts){
           contactcard += "<div id='"+ obj.contacts[index].user_id +"' class='section col s12'>";
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

         $("#contacts").html(contactcard);
       }else{
         //show error message
         alert("failed");
         // $("#divStatus").text("error while getting description");
         // $("#divStatus").css("backgroundColor","red");
       }
     }


     function displayChats(){
     var theUrl="../controllers/controller.php?cmd=1";
     var obj=sendRequest(theUrl);		//send request to the above url
     var chatcard = "";
     if(obj.result===1){					//check result
       for(var index in obj.contacts){
         chatcard += "<div id='"+ obj.contacts[index].user_id +"' class='section col s12'>";
         chatcard +=  "<div class='contactcardimg col s2'>";
         chatcard += "<img src='../assets/img/test.jpg' alt='' class='circle responsive-img'>";
         chatcard += "</div>";
         chatcard +="<div class='contactcardtext col s10'>";
         chatcard +="<h6 class='teal-text'>Message Sender" + "</h6>";
         chatcard +="<p>Snippet of message...</p>";
         chatcard +="</div>";
         chatcard +="<div class='divider col s12'></div><br><br><br><br>";
         chatcard +="</div>";
       }
      //  alert(contactcard);
       $("#chats").html(chatcard);

     }else{
       //show error message
       alert("failed");
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


        <div class="row">
  <div class="col s9 m5">
    <div class="card-panel teal">
      <span class="white-text">I am a very simple card. I am good at containing small bits of information.
      I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
      </span>
    </div>
  </div>
</div>


<div class="row" >
<div class="col s8 m5">
<div class="card-panel orange" style="float:right;">
<span class="white-text">I am a very simple card. I am good at containing small bits of information.
I am convenient because I require little markup to use effectively. I am similar to what is called a panel in other frameworks.
</span>
</div>
</div>
</div>



         <!-- <div class="col s12"> -->
           <!-- Tabs for Chats and Contacts -->

            <!-- <input > -->

            <!-- <div id="chatbox" class="row" style="position: fixed; bottom: 45px; right:24px;">
              <form class="col s12">
                <div class="row">
                  <div class="input-field col s12">
                    <textarea id="textarea1" class="materialize-textarea"></textarea>
                    <label for="textarea1">Textarea</label>
                  </div>
                </div>
              </form>

            </div> -->

        <div class="" style="bottom: 25px; right: 24px;">
        <div class="input-field col s11">
          <input id="email" type="email" class="validate">
          <!-- <label for="email">Email</label> -->
        </div>
        <div class="input-field col s1">
          <a style="float:right;" class="btn-floating waves-effect waves-light teal"><i class="mdi-content-send"></i></a>
          <!-- <label for="email">Email</label> -->
        </div>
      </div>
         <!-- </div> -->

     </div>













   </body>
 </html>
