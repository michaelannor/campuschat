<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Including files
 */
include_once 'adb.php';

/*
 * Creating the class for users
 */
Class CONTACTS extends adb
{
    
    /*
     * Constructor for users
     */
    function _construct ( )
    {
        $this->establish_connection ( );        
    }//end of _construct()
    
    
    /*
     * Destructor for users
     */
    function _destruct ( )
    {
         $this->close_connection ( );        
    }//end of _destruct()
    
    
    /*
     * Function to display list of users connection
     */
    function display_users_contacts($user_id )
    {
        $str_sql = "SELECT user_receiver
                FROM campuschat_contacts
                where user_sender = $user_id";
        
        return $this->query($str_sql);
    }
    
    
    /*
     * Function to add contacts
     */
    function add_contact($user_sender, $user_receiver)
    {
        $str_sql = "INSERT INTO campuschat_contacts SET
                    user_sender = $user_sender,
                    user_receiver = $user_receiver";
        
        return $this->query($str_sql);
    }
    
    
    /*
     * Function to delete contact
     */
    function delete_contact($user_sender, $user_receiver)
    {
        $str_sql = "DELETE FROM campuschat_contacts
                where user_sender = $user_sender and
                user_receiver = $user_receiver";
        
        return $this->query($str_sql);
    }
}

