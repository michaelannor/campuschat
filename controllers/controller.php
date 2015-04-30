<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Checking if a command is set before proceeding
 */
<<<<<<< HEAD
session_start();
if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'cmd' ) )
{
     $cmd_sanitize = sanitizeString ( filter_input ( INPUT_GET, 'cmd' ) );     //Storing the command into a variable
     $cmd = intval ( $cmd_sanitize );
=======
if ( isset ( $_REQUEST [ 'cmd' ] ) )
{
     $cmd = $_REQUEST[ 'cmd' ];     //Storing the command into a variable
     
>>>>>>> origin/kennethBranch
     switch ( $cmd )
     {
         case 1:
             user_contacts_control ( );          //Call to the user_contacts_control function
             break;
         
         case 2:
<<<<<<< HEAD
             edit_user_control ( );
=======
             user_contacts_control ( );          //Call to the user_contacts_control function

>>>>>>> origin/kennethBranch
             break;
         
         case 3:
             user_chats_control ( );
             break;
         
<<<<<<< HEAD
=======
         case 4:
             search_user_control ( );
             break;


>>>>>>> origin/kennethBranch
         default :
             echo '{"result":0, "message": "Invalid Command Entered"}';
             break;
     }//end of switch()
}
else
{
    echo '{"result":0, "message": "user_id or cmd not set"}';
}

/*
<<<<<<< HEAD
 * Function to sanitize command sent
=======
<<<<<<< HEAD
 * Function to 
=======
 * Function to create an instance of the users class
>>>>>>> fredrickBranch
>>>>>>> origin/kennethBranch
 */
function sanitizeString ( $val )
{
    $val = stripslashes ( $val );
    $val = strip_tags ( $val );
    $val = htmlentities ( $val );
    return $val;
}//end of sanitizeString()


/*
 * Function to create an instance of the users class
 */
<<<<<<< HEAD
function get_user_model( )
{
    require_once '../models/users.php';     //Including the file users.php
    $obj = new USERS ( );       //Creating an instance of the class users in users.php
    return $obj;
}//end of get_users_model
=======
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

>>>>>>> origin/kennethBranch

/*
 * Function to control the user contact display
 * and the contacts home
 */
function user_contacts_control ( )
{
<<<<<<< HEAD
    $obj1 = $obj2 = $user_id = $row = $row1 = '';
    $user_id = $user_id_santize = '';
=======
  session_start();
>>>>>>> origin/kennethBranch
    if ( isset ( $_SESSION['user_id'] ) )
    {
        require_once '../models/contacts.php';
        $obj2 = new CONTACTS ( );
        $obj1 = get_user_model ( );
<<<<<<< HEAD
//        $user_id = filter_input (INPUT_GET, 'id');
        $user_id_sanitize = sanitizeString ( $_SESSION['user_id'] );        //Retrieving the value in the session and assigning it to a new variable
        $user_id = intval ( $user_id_sanitize );
        
=======

//        $user_id = filter_input (INPUT_GET, 'id');


        $user_id = $_SESSION['user_id'];        //Retrieving the value in the session and assigning it to a new variable
>>>>>>> origin/kennethBranch
        if ( $obj2->display_users_contacts ( $user_id ) )
          {
           $row = $obj2->fetch ( );       //Fetching the result
           echo '{"result":1,"contacts": [';
           while ( $row )
           {
<<<<<<< HEAD
               $receiver_id = intval ( $row['user_receiver'] );

               if ( $obj1->get_user_profile ( $receiver_id ) )
               {
                   while ( $row1 =  $obj1->fetch ( ) )
                   {
                       echo '{"user_id":"'.$row['user_receiver'].'", "username":"'.$row1['username'].'","profile_pic":"'.$row1['profile_pic'].'", "status":"'.$row1['status'].'"}';
                   }
               }

               if ( $row = $obj2->fetch ( ) )
=======
               json_encode($row);       //Converting the row to a json format
               if ( $row = $obj->fetch ( ) )
>>>>>>> origin/kennethBranch
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


/*
 * Function to control the editing of a users profile
 */
function edit_user_control ( )
{
<<<<<<< HEAD
    $obj = $user_id = $username = $password = $profile_pic = '';
    $user_id_sanitize = '';
    if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'uername') &&
         filter_input (INPUT_GET, 'password') &&filter_input (INPUT_GET, 'profile_pic') )
=======
    session_start();
    if ( isset ( $_SESSION['user_id'] ) && filter_input (INPUT_GET, 'uername') &&
         filter_input (INPUT_GET, 'password') &&filter_input (INPUT_GET, 'profile_pic'))
>>>>>>> origin/kennethBranch
    {
        $obj = get_user_model( );
        $user_id_sanitize = sanitizeString ( $_SESSION['user_id'] );
        $username = sanitizeString ( filter_input ( INPUT_GET, 'username' ) );
        $password = sanitizeString ( filter_input ( INPUT_GET, 'password' ) );
        $profile_pic = sanitizeString ( filter_input ( INPUT_GET, 'profile_pic' ) );
        
        $user_id = intval ( $user_id_sanitize );

        if ( $obj->edit_user ( $user_id, $username, $password, $profile_pic ) )
        { 
            echo '{"result":1,"message":"User profile successfully updated"}';
        }
        else
        {
            echo '{"result":0,"message":"Failed to update user profile"}';
        }
    }
    else
    {
        echo '{"result":0,"message":"All fields are not set"}';
    }
}//end of edit_user_control()


/*
<<<<<<< HEAD
 * Function to control and dispay the users chat contacts
 */
function user_chats_control ( )
{
    if ( isset ( $_SESSION['user_id'] ) )
    {
        $obj = get_user_model ( );
        print("Not implemented yet");
    }
    else
    {
        echo '{"result":0, "message":"User id not in session"}';
    }
}//end of user_chats_control()
=======
 * Function to control the searching of a new user
 */
function search_user_control ( )
{
    session_start();
    $obj = get_user_model( );
}//search_user_control()

>>>>>>> origin/kennethBranch
