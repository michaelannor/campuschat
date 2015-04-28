<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start ( );
if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'cmd') )
{
    $cmd = $cmd_sanitize = '';
    $cmd_sanitize = sanitizeString ( filter_input ( INPUT_GET, 'cmd' ) );
    $cmd = intval ( $cmd_sanitize );
 
    switch ( $cmd )
    {
        case 1:
            search_user_control ( );
            break;

        default:
            echo '{"result":0, "message": "Invalid Command Entered"}';
            break;
    }//end of switch
    
}
else
{
    echo '{"result":0, "message": "user_id or cmd not set"}';
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
 * Function to control the searching of a new user
 */
function search_user_control ( )
{
    $obj = $search = $row = '';
    
    if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'search' ) )
    {
        $obj = get_user_model( );
        $search = sanitizeString ( filter_input ( INPUT_GET, 'search' ) );
        
        if ( $obj->search_user ( $search ) )
        {
            echo '{"result":0, "contacts":[';
            $row = $obj->fetch ( );
            while ( $row )
            {
                echo json_encode ( $row );
                if ( $row = $obj->fetch ( ) )
                {
                    echo ',';
                }
            }
            echo ']}';
        }
        else
        {
            echo '{"result":0, "message":"Failed to search"}';
        }
    }
    else
    {
        echo '{"result":0, "message":"User id not in session or no search variable passed"}';
    }
}//search_user_control()