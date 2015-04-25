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
     $cmd = $_REQUEST[ 'cmd' ];

     switch ( $cmd )
     {
         case 1:
             user_login_control ( );
             break;

         case 2:
             display_users_contact_control ( );
             break;

         default :
             echo '{"result":0, "message": "Invalid Command Entered"}';
             break;
     }//end of switch()
}


function user_login_control ( )
{
    if ( isset ( $_REQUEST['username'] ) && isset ( $_REQUEST['password'] ) )
    {
        include_once '../models/users.php';
        $obj = new USERS ( );
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];
        if ( !$row = $obj->user_login ( $username, $password ) )
        {
            echo '{"result":0, "message":"Login Error"}';
        }
        else
        {
            session_start ( );
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_id'] = $row['username'];
            echo '{"result":1, "message":"Correct Details"}';
        }
    }
}//end of user_login()



/*
 * Function to control the user contact display
 * and the contacts home
 */
function display_users_contact_control ( )
{
    if ( isset ( $_SESSION ) )
    {
        include_once '../models/users.php';
        $obj = new USERS ( );
        $user_id = $_SESSION['user_id'];
        if ( $obj->display_users_contacts ( $user_id ) )
        {
           $row = $obj->fetch ( );
           echo '{"result":1,"contacts": [';
           while ( $row )
           {
               json_encode($row);
               if ( $row = $obj->fetch ( ) )
               {
                   echo ',';
               }
           }
           echo ']}';
        }
        else
        {
             echo '{"result":0,"message":"Failed to display contacts"}';
        }
    }
}//end of display_users_contact()
