<?php
class Auth extends CI_Controller{
    
    function __construct() {
        parent::__construct();
        $this->load->model('m_auth');
    }
    
    function login() {
        if(isset($_POST['submit'])) {
            
            // proses login
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $hasil    = $this->m_auth->login($username,$password);
            if($hasil==1) {

                // terakhir login
                $this->db->where('username',$username);
                $this->db->update('operator',array('last_login'=>date('Y-m-d')));
                $this->session->set_userdata(array('status_login'=>'oke','username'=>$username));
                redirect('Dashboard');
            }
            else{
                redirect('Auth/login');
            }
        }
        else{
            chek_session_login();
            $this->load->view('v_login');
        }
    }
    
    function logout() {
        $this->session->sess_destroy();
        redirect('Auth/login');
    }
}

?>
