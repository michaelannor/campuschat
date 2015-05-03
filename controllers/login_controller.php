<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ( filter_input ( INPUT_GET, 'cmd') )
{
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitizeString ( filter_input ( INPUT_GET, 'cmd' ) );
    $cmd = intval ( $cmd_sanitize );
    
    switch ( $cmd )
    {
        case 1:
            user_login_control ( );
            break;
        
        case 2:
            user_signup_control ( );
            break;

        default:
            echo '{"result":0, "message": "Invalid Command Entered"}';
            break;
    }//end of switch
}
else
{
    echo '{"result":0, "message": "cmd not set"}';
}


/*
 * Function to sanitize command sent
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
    $obj = $username = $password = $row = '';
    //Checking if username and password is set before proceeding
    if ( filter_input ( INPUT_GET,'username') && filter_input ( INPUT_GET,'password' ) )
    {
        $obj = get_user_model ( );
        $username = sanitizeString ( filter_input (INPUT_GET,'username') );      //Getting the username from the url
        $password = sanitizeString ( filter_input ( INPUT_GET,'password') );      //Getting the password from the url
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
 * Function to control a user signing up
 */
function user_signup_control ( )
{
    $obj = $username = $password = $profile_pic = $status = '';
    if ( filter_input ( INPUT_GET, 'username' ) && filter_input ( INPUT_GET, 'password' ) &&
            filter_input ( INPUT_GET, 'profile_pic' ) && filter_input ( INPUT_GET, 'status' ) )
    {
        $obj = get_user_model ( );
        $username = sanitizeString ( filter_input ( INPUT_GET, 'username' ) );
        $password = sanitizeString ( filter_input ( INPUT_GET, 'password' ) );
        $profile_pic = sanitizeString ( filter_input ( INPUT_GET, 'profile_pic' ) );
        $status = sanitizeString ( filter_input ( INPUT_GET, 'status' ) );
//        $row = $obj->add_user ( $username, $password, $profile_pic, $status );
        if (  !$obj->add_user ( $username, $password, $profile_pic, $status ) )
        {
            echo '{"result":1,"message":"Signup Successful"}';
        }
        else
        {
            echo '{"result":0, "message":"Failed to signup"}';
        }
    }
    else
    {
        echo '{"result":0, "message":"Username, password and profile_pic not set"}';
    }
}//end of user_signup_control()