<section>
    <h2>Mitarbeiter</h2>
    <?php echo anchor('admin/dashboard/edit', '<span class="glyphicon glyphicon-plus"> </span>Erstellen'); ?>

    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <br>
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td >Stellenbezeichnung</td>
                            <td >Geburtsdatum</td>

                            <td >Ausbildung</td>
                            <td>Bearbeiten</td>
                            <td>Löschen</td>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
//                        echo "<pre>";
//                        print_r($users);
//                        echo "</pre>";
                        if (count($users)) :
                            foreach ($users as $user):
                                ?>
                                <tr>
                                    <td><?php echo anchor('admin/dashboard/edit/' . $user->ID, $user->FNAME . " " . $user->LNAME); ?> </td>
                                    <td><?php echo $user->USER_TITLE; ?></td>
                                    <td><?php echo $user->DOB ?></td>
                                    <td><?php echo $user->AUSBILDUNG ?></td>
                                    <td><?php echo btn_edit('admin/dashboard/edit/' . $user->ID) ?></td>
                                    <td><?php echo btn_delete('admin/dashboard/delete/' . $user->ID) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3"> We could not find any users.</td>
                            </tr>

                        <?php endif; ?>
                        

                </table>
                <?php
                        if (isset($links)) {
                            echo $links;
                        }
                        ?>
            </div>
        </div>
    </div>
</section>