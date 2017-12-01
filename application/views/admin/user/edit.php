<h3><?php echo empty($user->ID) ? 'Mitarbeiter Stammdaten' : 'Bearbeiten:' . '&nbsp' . $user->FNAME ?></h3>
<?php if (isset($validation_error) && $validation_error !==''): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<?php 
//echo "<pre>";
//print_r($compArray);
//echo "</pre>";
?>
<table class="table">
    <tr>
        <td>Vorname:</td>
        <td><?php echo form_input('fname', set_value('fname', $user->FNAME)); ?></td>
    </tr>
    <tr>
        <td>Nachname:</td>
        <td><?php echo form_input('lname', set_value('lname', $user->LNAME)); ?></td>
    </tr>
    <tr>
        <td>Stellenbezeichnung:</td>
        <td><?php echo form_dropdown('job_title_id', $job_title, $this->input->post('job_title_id') ? $this->input->post('job_title_id') : $user->JOB_TITLE_ID, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?></td>
    </tr>
    <tr>
        <td>Geburtsdatum:</td>
        <td><?php echo form_input('dob', set_value('dob', $user->DOB), 'class="datepicker"'); ?></td>
    </tr>
    <tr>
        <td>Wohnort:</td>
        <td><?php echo form_input('address', set_value('address', $user->ADDRESS)); ?></td>
    </tr>
    <tr>
        <td>Ausbildung:</td>
        <td><?php echo form_input('ausbildung', set_value('ausbildung', $user->AUSBILDUNG)); ?></td>
    </tr>

    <tr>
        <td></td>
        <td></td>
    </tr>

</table>
<div id="competency">

</div>
<?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?>
<?php echo form_close(); ?>

<script>
    $(function () {

        $('.datepicker').datepicker({format: 'dd.mm.yyyy'});

    });

    var drop_down = document.getElementById("my_id");
    $(function () {

        $.post('<?php echo site_url('admin/dashboard/order_competency/'), isset($user->ID) ? $user->ID :''; ?>', {dataType: "json"}, function (data) {
            console.info(data);
            $("#competency").html('');
            $("#competency").html(data);
//            var $el = $("#my_id2");
//            $el.empty(); // remove old options
//            $.each(JSON.parse(data), function (key, value) {
//
//                $('#my_id2').append($('<option>').text(value).attr('value', key));
//
//                console.log(key + ":" + value)
//            })
        });
    })
            ;


</script>
