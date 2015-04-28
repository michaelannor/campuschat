<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'cmd' ) )
{
    $cmd = filter_input ( INPUT_GET, 'cmd' );
    
    switch ( $cmd )
    {
        case 1:
            user_load_history ( );
            break;
        
        case 2:
            user_sending_message ( );
            break;
        
        case 3:
            user_receiving_message ( );
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
 * Function to load chat history of a user and another user
 */
function user_load_history ( )
{
    
}//end of user_load_history()


/*
 * Function to control a user sending a message
 */
function user_sending_message ( )
{
    
}//end of user_sending_message()


/*
 * Function to control a user receiving a message
 */
function user_receiving_message ( )
{
    
}//end of user_receiving_message()

