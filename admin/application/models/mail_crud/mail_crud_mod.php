<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Mail_crud_mod extends CI_Model{
        public $mail_db;
        public $statistics_db;
        
        function __construct(){
            parent::__construct();
            
            // Определяем таблицы БД
            $this->mail_db = "mail_manag";
            $this->statistics_db = "statistics_mail";
        }
        
        function mail_view_mod(){
            $data_result = false;
            $this->db->order_by('id', "asc");
            $query = $this->db->get($this->mail_db);
            if($query->num_rows() > 0){
                foreach($query->result_array() as $row){
                    $data_result[] = $row;
                }
            }
            return $data_result;
        }
        
        function on_off_mod($data, $data_where){
            $query = false;
            if(is_array($data) && is_array($data_where)){
                $this->db->where($data_where);
                $query = $this->db->update($this->mail_db, $data);
            }
            return $query;
        }
        
        function mail_add_mod($data){
            $query = false;
            if(is_array($data)){
                $query = $this->db->insert($this->mail_db, $data);
            }
            return $query;
        }
        
        function edit_mod($data, $data_where){
            $query = false;
            if(is_array($data) && is_array($data_where)){
                $this->db->where($data_where);
                $query = $this->db->update($this->mail_db, $data);
            }
            return $query;
        }
        
        function delet_mod($data_where){
            $query = false;
            if(is_array($data_where)){
                $this->db->where($data_where);
                $this->db->from($this->mail_db);
                $query = $this->db->delete();
            }
            return $query;
        }
        
        /**
         * Операции по работе с отправкой данных
        */
        function mail_send_mod($data_where){
            $data_result=false;
            
            if(is_array($data_where)){
                $this->db->where($data_where);
                $this->db->limit(1);
                $query = $this->db->get($this->mail_db);
                
                if($query->num_rows() == 1){
                    foreach($query->result() as $row){
                        $data_result = $row->mail;
                        
                        $this->db->where("id", $row->id);
                        $this->db->update($this->mail_db, array("status_send" => "1"));
                        
                        // Делаем запись в БД с пометкой времени
                        $data_statistic = array(
                            'id_ml' => $row->id,
                            'data_send' => time()
                        );
                        $this->statistics_data($data_statistic);
                    }
                } else {
                    $this->db->update($this->mail_db, array('status_send' => 0));
                    return $this->mail_send_mod($data_where);
                }
            }
            
            return $data_result;
        }
        
        function statistics_data($data_statistic){
            if(is_array($data_statistic)){
                $this->db->insert($this->statistics_db, $data_statistic);
            }
        }
        
        /**
         * Статистические запросы
        */
        function mail_today_mod($today_where){
            $result_count = 0;
            if(is_array($today_where)){
                $this->db->where($today_where);
                $query = $this->db->get($this->statistics_db);
                $result_count = $query->num_rows();
            }
            return $result_count;
        }
    }