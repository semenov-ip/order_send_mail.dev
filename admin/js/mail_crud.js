    /*
     * Добавление mail в БД
    */
    function addMail(form, event){
        event.preventDefault();
        
        var mail = form['mail'].value;
        if( mail.length > 1 ){
            $.ajax({
                type : "POST",
                url : "/admin/mail_manag/add_mail/",
                data : "mail=" + mail,
                success : function(data){
                    if( data.length > 1 ){
                        return alert(data);
                    } else {
                        return location.reload();
                    }
                }
            });
        } else {
            alert("Необходимо ввсети в поле email.");
        }
    }
    
    /*
     * Включение и выключение
    */
    function onOff(id){
        var on_off = Number($(".on_off_" + id).is(":checked"));
        
        $.ajax({
            type : "POST",
            url : "/admin/mail_manag/on_off/",
            data : "id=" + id + "&on_off=" + on_off,
            success : function(data){
                if( data.length > 1 ){
                    return alert(data);
                }
                return true;
            }
        });
    }
    
    /*
     * Удаление mail
    */
    function deletMail(id){
        if( id.length != 0 ){
            if(confirm("Вы действительно хотите удалить почтовый адрес без возврата.")){
                $.ajax({
                    type : "POST",
                    url : "/admin/mail_manag/delet_mail/",
                    data : "id=" + id,
                    success : function(data){
                        if( data.length > 1 ){
                            return alert(data);
                        } else {
                            return location.reload();
                        }
                    }
                });
            }
        }
    }
    
    /*
     * Редактирование mail
    */
    $(document).ready(function(){
        $('.link_read').toggle(
            function(){
                id = $(this).attr("id_mail");
                var mail = $(".read_mail_" + id).html();
                $(".read_mail_" + id).html("<input type='text' name='mail' value='" + mail + "' onBlur='readMailSave(" + id + ", 1)' />");
            },
            function(){
                id = $(this).attr("id_mail");
                var mail = $(".read_mail_" + id + " input[name=mail]").val();
                if(mail == undefined){
                    return false;
                } else {
                    return readMailSave(id, mail);
                }
            }
        );
        
        // Подсветка строк таблицы
        $(function (){
            $('table.table-bordered').find('tr').not(':first').hover(
                function () {
                    $(this).addClass('act_table');
                },
                function () {
                    $(this).removeClass('act_table');
                }
            );
        });
    });
    
    function readMailSave(id, mail){
        if(mail === 1){
            mail = $(".read_mail_" + id + " input[name=mail]").val();
        }
        if(mail.length > 1){
            $(".read_mail_" + id).html(mail);
            $.ajax({
                type : "POST",
                url : "/admin/mail_manag/edit_mail/",
                data : "id=" + id + "&mail=" + mail,
                success : function(data){
                    if( data.length > 1 ){
                        return alert(data);
                    }
                    return true;
                }
            });
        } else {
            alert("Необходимо ввести корректный почтовый адрес");
        }
    }
    
    
    
    
    
    
    
    
    
    
    