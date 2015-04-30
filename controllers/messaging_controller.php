<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
if ( isset ( $_SESSION['user_id'] ) && filter_input ( INPUT_GET, 'cmd' ) )
{
    $cmd_sanitize = filter_input ( INPUT_GET, 'cmd' );
    $cmd = intval ( $cmd_sanitize );
    
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
        
        case 4:
            user_delete_messages ( );
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
    require_once '../models/messages.php';     //Including the file users.php
    $obj = new MESSAGES ( );       //Creating an instance of the class users in users.php
    return $obj;
}//end of get_users_model


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
    $obj = $msg_text = $msg_sender = $msg_receiver = $msg_type = '';
    if ( isset ( $_SESSION ['user_id'] ) && filter_input ( INPUT_GET, 'msg_text' ) &&
            filter_input ( INPUT_GET, 'msg_receiver' ) && filter_input ( INPUT_GET, 'msg_type' ) )
    {
        $obj = get_user_model ( );
        $user_id_sanitize = sanitizeString ( $_SESSION['user_id'] );
        $user_id = intval ( $user_id_sanitize );
        $msg_text = sanitizeString ( filter_input(INPUT_GET, 'msg_text' ) );
        $msg_receiver = sanitizeString ( filter_input(INPUT_GET, 'msg_receiver' ) );
        $msg_type = sanitizeString ( filter_input(INPUT_GET, 'msg_type' ) );

        if ( $obj->send_message ( $msg_text, $user_id, $msg_receiver, $msg_type ) )
        {
            echo '{"result":1,"message":"Message sent"}';
        }
        else
        {
            echo '{"result":0, "message":"Message not sent"}';
        }
    }
    else
    {
        echo '{"result":0, "message":"Variables not set thus user_id, msg_text, msg_sender, msg_receiver, msg_type"}';
    }
}//end of user_sending_message()


/*
 * Function to control a user receiving a message
 */
function user_receiving_message ( )
{
    
}//end of user_receiving_message()


/*
 * Function to control the deletion of a message
 */
function user_delete_messages ( )
{
    if ( isset ( $_SESSION ['user_id'] ) && filter_input ( INPUT_GET, 'msg_receiver' ) )
    {
        $obj = get_user_model ( );
        $user_id_sanitize = sanitizeString ( $_SESSION['user_id'] );
        $user_id = intval ( $user_id_sanitize );
        $msg_receiver = sanitizeString ( filter_input(INPUT_GET, 'msg_receiver' ) );
        
        if ( $obj->delete_user_messages ( $user_id, $msg_receiver ) )
        {
            echo '{"result":1,"message":"Messages deleted"}';
        }
        else
        {
            echo '{"result":0, "message":"Messages not deleted"}';
        }
    }
    else
    {
        echo '{"result":0, "message":"Variables not set thus user_id, msg_sender, msg_receiver"}';
    }
}//end of user_delete_message()

