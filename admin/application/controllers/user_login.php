<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class User_login extends CI_Controller{
        private $css_arr;
        private $js_arr;
		private $base_url;
		private $header_arr;
        
        function __construct(){
			parent::__construct();
			
			$this->css_arr = $this->config->item('css_signup');
            $this->js_arr = $this->config->item('js');
			$this->base_url = $this->config->item('base_url');
			$this->header_arr = array(
				'css' => $this->css_arr,
                'js' => $this->js_arr,
				'base_url' => $this->base_url
			);
		}
		
        public function check_out(){
			if( isset( $_POST['submit'] ) ){
				$user = trim( $_POST['user'] );
				$password = md5( trim($_POST['password']) );
                
                if( empty($user) || empty($password) ){
                    $error_message = 1;
                    redirect( $this->header_arr['base_url']."user_login/check_out/", 'location' );
                }
                
				$data = array (
					'username' => $user, // admin
					'password' => $password // F93undMjaf
				);
				
				$this->load->model('check_out_mod/check_out_mod');
				$result = $this->check_out_mod->check_out_data($data);
                
				if($result){
					$this->session->set_userdata( array( 'username' => $data['username'] ) );
					redirect($this->header_arr['base_url'], 'location');
				}
			}
            
			$data['header'] = $this->header_arr;
			$this->load->view( 'check_out', $data );
		}
        
        public function log_out(){
			$this->session->sess_destroy();
			redirect( $this->header_arr['base_url']."user_login/check_out/", 'location' );
		}
    }
?>