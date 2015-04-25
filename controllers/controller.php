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
             user_login ( );
             break;

         default :
             echo '{"result":0, "message": "Invalid Command Entered"}';
             break;
     }//end of switch()
}


/*
 * Function to
 */
function user_login ( )
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
            $user_id = $row['user_id'];
            $_SESSION['user_id'] = $user_id;
            echo '{"result":1, "message":"Correct Details"}';
        }
    }
}//end of user_login()
