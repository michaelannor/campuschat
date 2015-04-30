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
Class MESSAGES extends adb
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
     * Function to get the messages of between a sender and a user
     */
    function get_user_messages($msg_sender, $msg_receiver){
        
        $str_sql = "SELECT * from campuschat_messages where
                   msg_sender = $msg_sender and msg_receiver = $msg_receiver";
        
        return $this->query($str_sql);
    }
    
    /*
     * Function to delete messages from a particular user
     */
    function delete_user_messages($msg_sender, $msg_receiver){
        $str_sql = "DELETE from campuschat_messages where
                   msg_sender = $msg_sender and msg_receiver = $msg_receiver";
        
        return $this->query($str_sql);
    }
    
    /*
     * Function to delete selected messages
     */
    function delete_message($msg_id){
        $str_sql = "DELETE from campuschat_messages where
                   msg_id = $msg_id";
        
        return $this->query($str_sql);
    }
    
    /*
     * Function to send meseeages
     */
    function send_message($msg_text, $msg_sender, $msg_receiver, $msg_type){
        $str_sql = "INSERT into campuschat_messages SET
                   msg_text = '$msg_text',
                   msg_sender =  $msg_sender,
                   msg_receiver = $msg_receiver,
                   msg_type = '$msg_type'";
        
        return $this->query($str_sql);
    }
    
    /*
     * Function to get chat history of user
     */
    function get_chat_history($user_id){
        $str_sql = "SELECT distinct msg_sender, msg_receiver, COUNT(msg_text), timestamp
                    FROM campuschat_messages GROUP BY msg_receiver 
                    HAVING msg_sender = $user_id or msg_receiver = $user_id
                    ORDER BY timestamp DESC";
        
        return $this->query($str_sql);
    }
}

//$obj = new MESSAGES();
//$obj->get_chat_history(1);
//$obj->send_message('HEY man', 4, 2, 'TEXT');
//$row = $obj->fetch();
//
//while ($row){
//    echo $row['msg_sender']."<br>";
//    $row = $obj->fetch();
//}
