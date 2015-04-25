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
Class USERS extends adb
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
     * Function to allow user to login
     */
    function user_login ( $username, $password )
    {
        $str_sql = "SELECT username, password 
                        FROM campuschat_users
                        WHERE campuschat_users.username='$username'
                        AND campuschat_users.password=MD5('$password')
                        LIMIT 1";
        if ( !$this->query ( $str_sql ) )
        {
            return mysql_error ( $this );
        }
        $this->fetch ( $str_sql );
    }//end of user_login()
    
    /*
     * Function to display list of users connection
     */
    function display_users_contacts ( )
    {
        $str_sql = "";
    }
    
}//end of USERS