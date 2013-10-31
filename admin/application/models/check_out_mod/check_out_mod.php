<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Check_out_mod extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        function check_out_data($data){
            $result = false;
            if( !empty($data) ){
                $this->db->where( $data );
                $query = $this->db->get('users');
                
                if( $query->num_rows > 0 ){
                    $result = true;
                }
            }
            return $result;
        }
    }