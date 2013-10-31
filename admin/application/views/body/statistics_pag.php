<div class="number_z">
    <h5>Статистика заказов</h5>
</div>
<table class="table table-bordered">
    <thead>
        <tr>
            <td width="500px;">Почтовые адрес</td>
            <td width="100">За сегодня</td>
            <td width="100">За вчера</td>
            <td width="100">За неделю</td>
            <td width="100">За месяц</td>
            <td width="100">Всего</td>
        </tr>
    </thead>
    <tbody>
        <?php if(is_array($mail_data)){
            foreach($mail_data as $value){?>
                <tr>
                    <td><?php echo (!empty($value['mail'])) ? $value['mail'] : ""; ?></td>
                    <td><?php echo (!empty($value['today'])) ? $value['today'] : ""; ?></td>
                    <td><?php echo (!empty($value['yesterday'])) ? $value['yesterday'] : ""; ?></td>
                    <td><?php echo (!empty($value['week'])) ? $value['week'] : ""; ?></td>
                    <td><?php echo (!empty($value['month'])) ? $value['month'] : ""; ?></td>
                    <td><?php echo (!empty($value['all'])) ? $value['all'] : ""; ?></td>
                </tr>
        <?php } } ?>
    </tbody>
</table>