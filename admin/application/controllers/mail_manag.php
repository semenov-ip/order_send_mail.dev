<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mail_manag extends CI_Controller {
		private $css_arr;
		private $js_arr;
		private $base_url;
		private $header_arr;
		
		function __construct(){
			parent::__construct();
			
			/*
			 * Определяем основные параметры heder - заголовков
			 * дополнительные css, js указываем в config.php файле
			*/
            $this->css_arr = $this->config->item('css_admin');
            $this->js_arr = $this->config->item('js');
			$this->base_url = $this->config->item('base_url');
            
			$this->header_arr = array(
				'css' => $this->css_arr,
				'js' => $this->js_arr,
				'base_url' => $this->base_url
			);
            
            // Проверка на пользователя в administrator
            if(!$this->session->userdata('username')){
                redirect( $this->header_arr['base_url']."user_login/check_out/", 'location' );
            }
		}
        
        // Главная страница
        function index(){
            
            // Необходимо выводить все mail, со статистикой.
            $this->load->model("mail_crud/mail_crud_mod");
            $mail_data = $this->mail_crud_mod->mail_view_mod();
            
            $data['mail_data'] = $mail_data;
            $data['manag_pag'] = "/body/manag_pag";
            $data['header'] = $this->header_arr;
			$this->load->view( 'admin', $data );
        }
        
        // Страница со статистикой
        function statistics(){
            // Необходимо выводить все mail, со статистикой.
            $this->load->model("mail_crud/mail_crud_mod");
            $mail_data = $this->mail_crud_mod->mail_view_mod();
            
            // Запускаем model статистики.
            $this->load->model("mail_crud/mail_crud_mod");
            for($i=0; $i < count($mail_data); $i++){

                // Колличество записей на сегодня.
                $today_where = array(
                    'data_send >=' => mktime(0, 0, 0, date("m"), date("d"), date("Y")),
                    'data_send <=' =>  mktime(0, 0, 0, date("m"), date("d")+1, date("Y")),
                    'id_ml' => $mail_data[$i]['id']
                );

                // Колличество записей за вчера
                $yesterday_where = array(
                    'data_send >=' => mktime(0, 0, 0, date("m"), date("d")-1, date("Y")),
                    'data_send <=' =>  mktime(0, 0, 0, date("m"), date("d"), date("Y")),
                    'id_ml' => $mail_data[$i]['id']
                );
                
                // Колличество записей за неделю
                $week_where = array(
                    'data_send >=' => mktime(0, 0, 0, date("m"), date("d")-7, date("Y")),
                    'data_send <=' =>  mktime(0, 0, 0, date("m"), date("d"), date("Y")),
                    'id_ml' => $mail_data[$i]['id']
                );
                
                // Колличество записей за месяц
                $month_where = array(
                    'data_send >=' => mktime(0, 0, 0, date("m")-1, date("d"), date("Y")),
                    'data_send <=' =>  mktime(0, 0, 0, date("m"), date("d"), date("Y")),
                    'id_ml' => $mail_data[$i]['id']
                );
                
                // Колличество всего записей
                $all_where = array(
                    'id_ml' => $mail_data[$i]['id']
                );
                
                $mail_data[$i]['today'] = $this->mail_crud_mod->mail_today_mod($today_where);
                $mail_data[$i]['yesterday'] = $this->mail_crud_mod->mail_today_mod($yesterday_where);
                $mail_data[$i]['week'] = $this->mail_crud_mod->mail_today_mod($week_where);
                $mail_data[$i]['month'] = $this->mail_crud_mod->mail_today_mod($month_where);
                $mail_data[$i]['all'] = $this->mail_crud_mod->mail_today_mod($all_where);
            }
            
            //echo"<pre>";print_r($mail_data);echo"</pre>";
            $data['mail_data'] = $mail_data;
            $data['manag_pag'] = "/body/statistics_pag";
            $data['header'] = $this->header_arr;
			$this->load->view( 'admin', $data );
        }
        
        /*
         * Изменение статуса mail
         * ajax запро
        */
        function on_off(){
            if(isset($_POST['on_off']) && isset($_POST['id'])){
                $data_where = array(
                    'id' => htmlspecialchars($_POST['id'])
                );
                
                $data = array(
                    'on_off' => htmlspecialchars(trim($_POST['on_off'])),
                );
                
                $this->load->model("mail_crud/mail_crud_mod");
                $query = $this->mail_crud_mod->on_off_mod($data, $data_where);
                
                if(!$query){
                    echo "Произошла ошибка!";
                }
            } else {
                redirect('/', 'refresh');
            }
        }
        
        /*
         * Добавление данных в БД
         * ajax запрос
        */
        function add_mail(){
            if(isset($_POST['mail'])){
                $data = array(
                    'mail' => htmlspecialchars(trim($_POST['mail']))
                );
                
                $this->load->model('mail_crud/mail_crud_mod');
                $query = $this->mail_crud_mod->mail_add_mod($data);
                if(!$query){
                    echo "Произошла ошибка!";
                }
            }else{
                redirect('/', 'refresh');
            }
        }
        
        /*
         * Редактирование данных в БД
         * ajax запрос
        */
        function edit_mail(){
            if(isset($_POST['id']) && isset($_POST['mail'])){
                $data_where = array(
                    'id' => trim($_POST['id'])
                );
                
                $data = array(
                    'mail' => htmlspecialchars(trim($_POST['mail'])),
                );
                
                $this->load->model("mail_crud/mail_crud_mod");
                $query = $this->mail_crud_mod->edit_mod($data, $data_where);
                
                if(!$query){
                    echo "Произошла ошибка!";
                }
            }else{
                redirect('/', 'refresh');
            }
        }
        
        /*
         * Удаление данных в БД
         * ajax запрос
        */
        function delet_mail(){
            if(isset($_POST['id'])){
                $data_where = array(
                    'id' => trim($_POST['id'])
                );
                
                $this->load->model('mail_crud/mail_crud_mod');
                $query = $this->mail_crud_mod->delet_mod($data_where);
                if(!$query){
                    echo "Произошла ошибка!";
                }
            }else{
                redirect('/', 'refresh');
            }
        }
    }
	
	
	
	
/* End of file mail_manag.php */