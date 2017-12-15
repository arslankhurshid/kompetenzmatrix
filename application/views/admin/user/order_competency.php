<?php
//echo "<pre>";
//print_r($jobCompArray);
//echo "</pre>";

echo '<section>';
if (count($compArray)) {
    echo '<div class="form-group">'
            
            .isset($jobCompArray) && !empty($jobCompArray) ? '<label for="stelle" style="width: 200px; float: left; margin: 0 200px 20px 0;"><span>Fachbereich & Kompetenzen</span></label><label for="stelle" style="width: 100px; float: right; margin: 0 20px 0 0;"><span>Stellenanforderungen</span></label>': '<label for="stelle" style="width: 200px; float: left; margin: 0 200px 20px 0;"><span>Fachbereich & Kompetenzen</span></label>'.
            
                '<ul id="tree1">';

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
            <?php if (isset($value['CHILD']) && !empty($value['CHILD'])) { ?>
                <label><?php foreach ($value['CHILD'] as $k => $val) { ?>
                        <li class="col-md-12" style="margin-top: 10px;">
                            <div class="col-md-1">
                                <input type="checkbox" name="competencies[]" value="<?php echo $k; ?>" <?php echo $selected; ?> style="display: none">
                            </div>

                            <div class="col-md-6">
                                <label><?php echo $val; ?></label>
                            </div>
                            <div class="col-md-3">
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
                            <!--<div class="col-xs-6">-->
                            <?php if (isset($jobCompArray) && !empty($jobCompArray)) {
                                ?>
                                <!--<div class="row">-->
                                <label>
                                    <?php
                                    foreach ($jobCompArray as $job_index => $jobSkilVal) {
                                        if ($job_index == $k) {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-10" style="background-color:lavenderblush">
                                                    <?php echo $jobSkilVal; ?>
                                                </div>
                                            </div>
                                        </label>
                                        <!--</div>-->
                                        <?php
                                    }
                                }
                            }
                            ?>
                            <!--</div>-->

                        <?php }
                        ?></li></label>


            </ul><?php } ?>
        <?php
    }
    echo '</ul></div>';
}
echo '</section>';
