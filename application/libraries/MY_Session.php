<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class My_Session extends CI_Session {
    /**
     * Force cleanup expired sessions.
     */
    function force_cleanup() 
    {
        if ($this->sess_use_database != TRUE)
        {
            return;
        }
        
        $expire = $this->now - $this->sess_expiration;

        $this->CI->db->where("last_activity < {$expire}");
        $this->CI->db->delete($this->sess_table_name);

        log_message('debug', 'Session garbage collection performed.');
    }
}
