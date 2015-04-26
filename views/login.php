<!DOCTYPE html>
  <html>
    <head>
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="../assets/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>


    </head>

    <body class="teal darken-1">
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

        // Function to validate users
        function validateLogin(user, pass){
				var theUrl="../controllers/controller.php?cmd=1&username="+user+"&password="+pass;
				var obj=sendRequest(theUrl);		//send request to the above url
				if(obj.result==1){					//check result
          window.location.replace("home.php");
					//$("#divDesc").text(obj.desc);		//set div with the description from the result
					//$("#divDesc").css("top",event.y);	//set the location of the div
					//$("#divDesc").css("left",event.x);
					//$("#divDesc").show();				//show the div element
				}else{
					//show error message
          alert("login failed");
					// $("#divStatus").text("error while getting description");
					// $("#divStatus").css("backgroundColor","red");
				}
			}

      // Login Button Onclick Function
      $(function(){
        $("#loginbtn").click(function(){

          console.log($("#username").val());

          validateLogin($("#username").val(), $("#password").val())
        });
      });

      // Cancel Button Onclick Function
      $(function(){
        $("#cancelbtn").click(function(){
          // alert();
          $('#username').val('');
          $('#password').val('');
        });
      });

      </script>

    </head>

    <body class="teal darken-1">


      <div class="row">
            <div class="col s12 m5">
              <!-- Div for Login Card -->
              <div class="card-panel" style="width: 90%;
                height: 310px;
                position: absolute;
                top:0;
                bottom: 0;
                left: 0;
                right: 0;
                margin: auto;"
              >
              <span class="teal-text">
                <div class="row">
                  <div class="row">
                      <form class="col s12">
                        <div class="row">
                          <div class="input-field col s12">
                           <h5>Log In</h5>
                          </div>
                            <!-- Username Input -->
                          <div class="input-field col s12">
                            <input id="username" type="text" class="validate">
                            <label for="username">Username</label>
                          </div>

                          <!-- Password Input -->
                          <div class="input-field col s12">
                            <input id="password" type="password" class="validate">
                            <label for="password">Password</label>
                          </div>

                          <!-- Login and Cancel Buttons -->
                          <div class="input-field col s12">
                              <!-- Login Button -->
                              <h6 id="loginbtn" style="float:right;">
                                <span style="color: #009688 !important; ">
                                  LOGIN
                                </span>
                              </h6>
                              <span></span>
                              <!-- Cancel Button -->
                              <h6 id="cancelbtn" style="float:right; padding-right:30px;" class="grey-text">
                                CANCEL
                              </h6>
                          </div>
                        </div>
                        <div class="row">
                </span>
              </div>
            </div>
          </div>
    </body>
  </html>
