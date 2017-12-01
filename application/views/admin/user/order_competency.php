<?php
//echo "<pre>";
//print_r($compArray);
//echo "</pre>";
echo '<section>';
if (count($compArray)) {
    echo '<div class="form-group">
            <label class="">Fachbereich & Kompetenzen</label>
                <ul id="tree1">';

    foreach ($compArray as $key => $value) {

        $selected = 'checked';
        ?>

        <div class="col-md-1">
            <input type="checkbox" name="parent_competencies[]" value="<?php echo $key; ?>" <?php echo $selected; ?> style="display: none">
        </div>
        <div class="col-md-7">
            <label><?php echo $value['NAME']; ?></label>
        </div>
        <ul id="tree1">
              <?php if (isset($value['CHILD']) && !empty($value['CHILD'])){?>
            <label><?php foreach ($value['CHILD'] as $k => $val) { ?>
                    <li class="col-md-12" style="margin-top: 10px;">
                        <div class="col-md-1">
                            <input type="checkbox" name="competencies[]" value="<?php echo $k; ?>" <?php echo $selected; ?> style="display: none">
                        </div>

                        <div class="col-md-7">
                            <label><?php echo $val; ?></label>
                        </div>
                        <div class="col-md-4">
                            <select name="competency-<?php echo $k ?>[]" class="form-control">

                                <?php
                                foreach ($skills as $dataKey => $dataVal) {
//               
                                    ?>
                                    <option value = "<?php echo $dataKey ?>" <?php
                                    if (isset($selectedArray[$k]) && $dataKey == $selectedArray[$k]) {
                                        echo 'selected';
                                    } else {
                                        echo '';
                                    }
                                    ?>><?php echo $dataVal ?></option>
                                            <?php
//                                  
                                        }
                                        ?>

                            </select>

                        </div>

                    <?php }
                    ?></li></label>


        </ul><?php } ?>
        <?php
    }
    echo '</ul></div>';
}
echo '</section>';
