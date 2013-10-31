<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class Mail_send extends CI_Controller {
        
        function __construct(){
			parent::__construct();
		}
        
        function send(){
            if(isset($_POST['email'])){
                $data_where = array(
                    'on_off' => 1,
                    'status_send' => 0
                );
                $this->load->model("mail_crud/mail_crud_mod");
                $email = $this->mail_crud_mod->mail_send_mod($data_where);
                
                $template = '
                    Как Вас зовут?
                    '.$_POST['name'].'
                    
                    Ваш Email*
                    '.$_POST['email'].'
                    
                    Ваш возраст?
                    '.$_POST['age'].'
                    
                    Опишите проблему
                    '.$_POST['message'];
                
                $subject = "Новая заявка";
                
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    mail($email, $subject, $template,
                        "From: ".$_POST['email']."\r\n"
                        ."Reply-To: ".$_POST['email']."\r\n"
                        ."Content-type: text/plain; charset=utf-8\r\n"
                        ."X-Mailer: PHP/" . phpversion());
                    
                    header("Location: /help/send.html");
                }
            }
        }
    }