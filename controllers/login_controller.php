<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( filter_input ( INPUT_GET, 'cmd') )
{
    $cmd = filter_input ( INPUT_GET, 'cmd' );
    
    switch ( $cmd )
    {
        case 1:
            user_login_control ( );
            break;

        default:
            echo '{"result":0, "message": "Invalid Command Entered"}';
            break;
    }//end of switch
}//end of if


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
 * Function to control the users login
 */
function user_login_control ( )
{
    //Checking if username and password is set before proceeding
    if ( filter_input ( INPUT_GET,'username') && filter_input ( INPUT_GET,'password' ) )
    {
        $obj = get_user_model ( );
        $username = filter_input (INPUT_GET,'username');      //Getting the username from the url
        $password = filter_input ( INPUT_GET,'password');      //Getting the password from the url
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