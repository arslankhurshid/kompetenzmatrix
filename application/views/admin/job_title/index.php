<section>
    <h2>Stellenbezeichnung</h2>
    <?php echo anchor('admin/jobtitle/edit', '<span class="glyphicon glyphicon-plus"> </span>Erstellen'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <br>
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <td >Stellenbezeichnung</td>
                            <td>Bearbeiten</td>
                            <td>Löschen</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($job_titles)) :
                            foreach ($job_titles as $title):
                                ?>
                                <tr>
                                    <td><?php echo anchor('admin/jobtitle/edit/' . $title->ID, $title->TITLE); ?> </td>
                                    <!--<td><?php // echo $title['parent_competency_name'] ?></td>-->
                                    <!--<td><?php // echo $title['competency_name'] ?></td>-->
                                    <td><?php echo btn_edit('admin/jobtitle/edit/' . $title->ID) ?></td>
                                    <td><?php echo btn_delete('admin/jobtitle/delete/' . $title->ID) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3"> Keine Stellenbezeichnung.</td>
                            </tr>

                        <?php endif; ?>

                </table>
            </div>
        </div>
    </div>
</section>