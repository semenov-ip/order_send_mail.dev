<div class="number_z">
    <h5>Управление почтовыеми адресами</h5>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <td width="500px;">Почтовые адрес</td>
            <td width="100">Вкл./Выкл.</td>
            <td width="100">Редактировать</td>
            <td width="100">Удалить</td>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($mail_data)){
            foreach($mail_data as $value){?>
                <tr>
                    <td class="read_mail_<?php echo $value['id']; ?>"><?php echo (!empty($value['mail'])) ? $value['mail'] : ""; ?></td>
                    <td>
                        <div class="switch">
                            <input onclick="onOff(<?php echo $value['id']; ?>);" type="checkbox" <?php echo ($value['on_off'] == 0) ? "" : "checked"; ?> class="on_off_<?php echo $value['id']; ?>" />
                            <label></label>
                        </div>
                    </td>
                    <td>
                        <a class="link_read" id_mail = "<?php echo $value['id']; ?>" href="javascript:void(0);"><i class="icon-pencil"></i></a>
                    </td>
                    <td>
                        <i class="icon-trash" onclick="deletMail(<?php echo $value['id']; ?>);"></i>
                    </td>
                </tr>
        <?php } } ?>
        <tr class="form_add">
            <td colspan="5">
                <form class="form-inline">
                    <div class="input-append">
                        <input name="mail" class="span3" id="appendedInputButton" size="16" type="text">
                        <input type="submit" class="btn" value="Добавить" onclick="addMail(this.form, event);">
                    </div>
                </form>
            </td>
        </tr>
    </tbody>
</table>