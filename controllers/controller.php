<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Checking if a command is set before proceeding
 */
if ( isset ( $_REQUEST [ 'cmd' ] ) )
{
     $cmd = $_REQUEST[ 'cmd' ];     //Storing the command into a variable
     
     switch ( $cmd )
     {
         case 1:
             user_login_control ( );        //Call to the user_login_control function
             break;
         
         case 2:
             user_contacts_control ( );          //Call to the user_contacts_control function
             break;            

         default :
             echo '{"result":0, "message": "Invalid Command Entered"}';
             break;
     }//end of switch()
}


/*
 * Function to 
 */
function get_user_model( )
{
    include_once '../models/users.php';     //Including the file users.php
    $obj = new USERS ( );       //Creating an instance of the class users in users.php
    return $obj;
}//end of get_users_model


/*
 * Function to control the users login
 */
function user_login_control ( )
{ 
    //Checking if username and password is set before proceeding
    if ( isset ( $_REQUEST['username'] ) && isset ( $_REQUEST['password'] ) )
    {
        $obj = get_user_model ( );
        $username = $_REQUEST['username'];      //Getting the username from the url
        $password = $_REQUEST['password'];      //Getting the password from the url
        $row = $obj->user_login ( $username, $password );
        if ( !$row )
        {
            echo '{"result":0, "message":"Login Error"}';       //Showing an error message in json format
        }
        else
        {
            session_start ( );      //Starting a session
            $_SESSION['user_id'] = $row['user_id'];     //Storing the user's id into a session variable
            $_SESSION['username'] = $row['username'];        //Storing the username into a session variable
            echo '{"result":1, "message":"Correct Details"}';       //Showing a success message in json format
        }
    }
    else
    {
        echo '{"result":0, "message":"Username and Password not set"}'; 
    }
}//end of user_login()


/*
 * Function to control the user contact display
 * and the contacts home
 */
function user_contacts_control ( )
{
    if ( isset ( $_SESSION['user_id'] ) )
    {
        include_once '../models/contacts.php';
        $obj2 = new CONTACTS ( );
        $obj1 = get_user_model ( );
//        $user_id = $_REQUEST['id'];
        $user_id = $_SESSION['user_id'];        //Retrieving the value in the session and assigning it to a new variable
        if ( $obj2->display_users_contacts ( $user_id ) )
          {
           $row = $obj2->fetch ( );       //Fetching the result
           echo '{"result":1,"contacts": [';
           while ( $row )
           {
               $receiver_id = intval ( $row['user_receiver'] );
               
               if ( $obj1->get_user_profile ( $receiver_id ) )
               {
                   while ( $row1 =  $obj1->fetch ( ) )
                   {
                       echo '{"user_id":"'.$row['user_receiver'].'", "username":"'.$row1['username'].'"}';
                   }
               }

               if ( $row = $obj2->fetch ( ) )
               {
                   echo ',';
               }
           }
           echo ']}';       //end of json format
        }
        else
        {
             echo '{"result":0,"message":"Failed to display contacts"}';        //Showing an error message in json format
        }
    }
    else
    {
        echo '{"result":0,"message":"Session for user id is not set"}';
    }
}//end of display_users_contact()