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
        $str_sql = "SELECT user_id, username, password
                        FROM campuschat_users
                        WHERE campuschat_users.username='$username'
                        AND campuschat_users.password=MD5('$password')
                        LIMIT 1";
        if ( !$this->query ( $str_sql ) )
        {
            return mysql_error($this);
        }
        return $this->fetch ( $str_sql );
    }//end of user_login()
    
    /*
     * Function to get users profile information
     */
    function get_user_profile($user_id){
       $str_sql = "SELECT username, profile_pic 
                        FROM campuschat_users
                        WHERE user_id = $user_id"; 
       
       return $this->query($str_sql);
    }
    
    /*
     * Function to edit a users profile
     */
    function edit_user($user_id, $username, $password, $profile_pic){
        $str_sql = "UPDATE campuschat_users SET
                    username = '$username',
                    password = MD5('$password'), 
                    profile_pic = '$profile_pic' 
                    WHERE user_id = $user_id";
        
         return $this->query($str_sql);
    }
    
    /*
     * Function to search for a users 
     */
    
    function search_user($st){
        $str_sql = "SELECT username, profile_pic 
                        FROM campuschat_users
                        WHERE username LIKE '%$st%'";
        
        return $this->query($str_sql);
    }
       
}//end of USERS

//include_once 'contacts.php';
//$obj1 = new USERS();
//$obj2 = new CONTACTS();
//
//
//if($obj2->display_users_contacts(1)){
//    
//    while($row = $obj2->fetch()){
//        //echo $row['user_receiver'];
//        $receiver = intval($row['user_receiver']);
//        echo $receiver ;
//        $obj1->get_user_profile($receiver);
//        $row1 = $obj1->fetch();
//        echo $row1['username']. "<br>";
//
//    }
//}
// else {
//    echo 'could not ';
//}