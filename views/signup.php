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
         var obj=$.ajax({url:u,async:false});
         var result=$.parseJSON(obj.responseText);
         return result;	//return object
       }

       $(document).ready(function()
       {
        //  displayChats();
       });

       // Contact Pane Onclick Function
       $(function(){
         $("#signupbtn").click(function(){
           signUp(
             $("#username").val(),
             $("#password").val(),
             $("#profile_pic").val(),
             $("#status").val()
           );
           //displayContacts();
           validateLogin($("#username").val(), $("#password").val());
          //  window.location.replace("home.php");
         });
       });

       // Chat Pane Onclick Function
       $(function(){
         $("#cancelbtn").click(function(){
          //  displayChats();
          window.location.replace("login.php");
         });
       });

       // Function to signup user
       function signUp(user, pass, pic, stat){
       var theUrl="../controllers/login_controller.php?cmd=2&username="+user+"&password="+pass+"&profile_pic="+pic+"&status="+stat;
       var obj=sendRequest(theUrl);		//send request to the above url

       if(obj.result===1){					//check result
          alert(obj.message);
          window.location.replace("home.php");
         }

        //  $("#contacts").html(contactcard);
       else{
         // show error message
         alert(obj.message);
         // $("#divStatus").text("error while getting description");
         // $("#divStatus").css("backgroundColor","red");
       }
     }


     function validateLogin(user, pass){
     var theUrl="../controllers/login_controller.php?cmd=1&username="+user+"&password="+pass;
     var obj=sendRequest(theUrl);		//send request to the above url
     if(obj.result==1){					//check result
       window.location.replace("home.php");
       //$("#divDesc").text(obj.desc);		//set div with the description from the result
       //$("#divDesc").css("top",event.y);	//set the location of the div
       //$("#divDesc").css("left",event.x);
       //$("#divDesc").show();				//show the div element
     }else{
       //show error message
       // alert("login failed");
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
           <!-- Tabs for Chats and Contacts --><div class="col s12"><br></div>
           <div class="row">
               <form class="col s12">
                 <div class="row">

                   <div class="input-field col s12">
                     <input id="username" type="text" class="validate">
                     <label for="username">Username</label>
                   </div>
                 </div>

                 <div class="row">

                   <div class="input-field col s12">
                     <input id="password" type="password" class="validate">
                     <label for="password">Password</label>
                   </div>
                 </div>

                 <div class="row">
                   <div class="input-field col s12">
                     <input id="profile_pic" type="text" class="validate">
                     <label for="profile_pic">Profile Picture</label>

                   </div>
                 </div>
                 <div class="row">
                   <div class="input-field col s12">
                     <input id="status" type="text" class="validate">
                     <label for="status">Status</label>
                   </div>
                 </div>
           <!--Social      -->

           <h6 id="signupbtn" style="float:right;"><span style="color: #009688 !important; padding-right:10px;">SIGN UP</span></h6>
           <h6 id="cancelbtn" style="float:right;"><span style="color: #009688 !important; padding-right:10px;">CANCEL &nbsp;&nbsp;&nbsp;&nbsp;</span></h6>
               </form>
             </div>






         </div>

         <!-- Chat Tab Contents -->
         <!-- <div id="chats" class="col s12">

         </div> -->

         <!-- Contact Tab Contents -->
         <!-- <div id="contacts" class="col s12"> -->

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

       <!-- </div> -->
     </div>













   </body>
 </html>
