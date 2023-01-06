<?php
class M_auth extends CI_Model{
    
    function login($username,$password) {
        $chek = $this->db->get_where('operator',array('username'=> $username,'password'=> md5($password)));
        if($chek->num_rows()>0) {
            return 1;
        }
        else{
            return 0;
        }
    }
}