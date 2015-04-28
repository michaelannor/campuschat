<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Checking if a command is set before proceeding
 */
if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'cmd' ) )
{
     $cmd = filter_input ( INPUT_GET, 'cmd' );     //Storing the command into a variable

     switch ( $cmd )
     {
         case 1:
             user_contacts_control ( );          //Call to the user_contacts_control function
             break;

         case 2:
             edit_user_control ( );
             break;
         
         case 3:
             user_chats_control ( );
             break;
         
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
 * Function to create an instance of the users class
 */
function get_user_model( )
{
    require_once '../models/users.php';     //Including the file users.php
    $obj = new USERS ( );       //Creating an instance of the class users in users.php
    return $obj;
}//end of get_users_model


/*
 * Function to control the user contact display
 * and the contacts home
 */
function user_contacts_control ( )
{
  session_start ( );
    if ( isset ( $_SESSION['user_id'] ) )
    {
        require_once '../models/contacts.php';
        $obj2 = new CONTACTS ( );
        $obj1 = get_user_model ( );
//        $user_id = filter_input (INPUT_GET, 'id');
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


/*
 * Function to control the editing of a users profile
 */
function edit_user_control ( )
{
    session_start ( );
    if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'uername') &&
         filter_input (INPUT_GET, 'password') &&filter_input (INPUT_GET, 'profile_pic') )
    {
        $obj = get_user_model( );
        $user_id = $_SESSION['user_id'];
        $username = filter_input ( INPUT_GET, 'username' );
        $password = filter_input ( INPUT_GET, 'password' );
        $profile_pic = filter_input ( INPUT_GET, 'profile_pic' );

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
 * Function to control and dispay the users chat contacts
 */
function user_chats_control ( )
{
    session_start ( );
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