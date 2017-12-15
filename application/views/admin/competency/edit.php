<h3><?php echo empty($competency->ID) ? 'Neue Kompetenz' : 'Bearbeiten:' . '&nbsp' . $competency->NAME ?></h3>
<?php if (isset($validation_error) && $validation_error !== ''): ?>
    <div class="alert alert-danger" id="errordiv">
        <?php echo validation_errors() ?>
    </div>
<?php endif; ?>
<?php echo form_open(); ?>
<table class="table">
    <tr>
        <td>Fachbereich:</td>
        <td><?php echo form_dropdown('parent_id', $competency_without_parents, $this->input->post('parent_id') ? $this->input->post('parent_id') : $competency->PARENT_ID, 'class="btn btn-default dropdown-toggle btn-select2" id="my_id"'); ?></td>
    </tr>
    <tr>
        <td>Kompetenz Name:</td>
        <td><?php echo form_input('name', set_value('name', $competency->NAME), 'id="my_id"'); ?></td>
    </tr>

    <tr>
        <td></td>
        <td><?php echo form_submit('submit', 'Save', 'class="btn btn-primary"'); ?></td>
    </tr>

</table>
<?php echo form_close(); ?>
<script>

    $("form").submit(function () {
        var drop_down = document.getElementById("my_id").value;
        console.info(drop_down);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo site_url('admin/competency/validateCompetencyName/') ?>' + drop_down.value,
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {
                console.info(data);


            },
            error: function (e) {
                console.info(e);
            },
        });
//        alert("Submitted");
    });

    function validate()
    {
        var drop_down = $("input").val(text);
        console.info(drop_down);

        $.post('<?php echo site_url('admin/competency/validateCompetencyName/'); ?>' + drop_down.value, function (data) {

            console.info(data);
//            var $el = $("#my_id2");
//            $el.empty(); // remove old options
//            $.each(JSON.parse(data), function (key, value) {
//
//                $('#my_id2').append($('<option>').text(value).attr('value', key));
//
////                console.log(key + ":" + value)
//            })
        });

    }

</script>