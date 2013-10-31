<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Catalog_crud extends CI_Model{
        private $table_db;
        
        function __construct(){
            parent::__construct();
            // Наз-ие таблицы
            $this->table_db = "catalog";
        }
        
        /**
         * Добавление данных
        */
        function catalog_add($data_arr){
            $result = false;
            if( is_array($data_arr) ){
                $result = $this->db->insert( $this->table_db, $data_arr );
            }
            return $result;
        }
        
        /**
         * Извлечение данных
        */
        function catalog_extract(){
            $result = false;
            $this->db->order_by('id_cat', "desc");
            $query = $this->db->get($this->table_db);
            if($query->num_rows() > 0){
                foreach( $query->result() as $row ){
                    $result[] = array(
                        'id_cat' => $row->id_cat,
                        'catalog_image' => $row->catalog_image,
                        'catalog_name' => $row->catalog_name,
                        'catalog_description' => $row->catalog_description
                    );
                }
            }
            return $result;
        }
        
        /**
         * Извлекаем данные по эллементу id
        */
        function catalog_extract_id($id_where){
            $result = false;
            if( is_array($id_where) ){
                $this->db->where($id_where);
                $query = $this->db->get($this->table_db);
                if($query->num_rows() == 1){
                    foreach( $query->result() as $row ){
                        $result = array(
                            'id_cat' => $row->id_cat,
                            'catalog_image' => $row->catalog_image,
                            'catalog_name' => $row->catalog_name,
                            'catalog_description' => $row->catalog_description
                        );
                    }
                }
            }
            return $result;
        }
        
        /**
         * Изменяем поле каталога
        */
        function catalog_add_id( $id_where, $data_arr ){
            $result = false;
            if( is_array($data_arr) ){
                $this->db->where($id_where);
                $result = $this->db->update( $this->table_db, $data_arr );
            }
            return $result;
        }
        
        /**
         * Удаление данных
        */
        function catalog_dell($where_id){
            $result=false;
            if( is_array($where_id) ){
                foreach( $where_id as $data ){
                    $this->db->where($data);
                    $result = $this->db->delete($this->table_db);
                }
            }
            return $result;
        }
    }