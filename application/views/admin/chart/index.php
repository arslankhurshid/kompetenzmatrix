<section>
    <div id="orderResult"></div>
    <h2>Netzdiagramm</h2>
    <?php echo form_open('', array('onsubmit' => 'return validate();')); ?>

    <div class="well carousel-search hidden-sm">

        <div id="dropdown" style="">

            <?php echo form_dropdown('title', $titles, $this->input->post('title') ? $this->input->post('title') : '$account->from_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="title_id" onchange="title_function()"'); ?>
            &nbsp;&nbsp;
            <?php echo form_dropdown('user', $users, $this->input->post('user') ? $this->input->post('user') : '$account->from_bank', 'class="btn btn-default dropdown-toggle btn-select2" id="user_id" onchange="some_function()"'); ?>
            &nbsp;&nbsp;

            <div class="clr"></div>
        </div>
        <div>
            <br>
        </div>
        <div id="buttons">
            <?php
//            echo form_button('button', 'Apply', 'class="btn btn-primary btn-xs" onClick="some_function()"');
            ?>

            <div class="clr"></div>
        </div>
    </div>
    <br>
    <?php echo form_close(); ?>
    <div id="chart">
        <canvas id="lineChart" width="600" height="400"></canvas>
    </div>


    <!--
        <div>
            <canvas id="lineChart" width="600" height="400"></canvas>
        </div>-->


</section>


<script>
    var myChart;
    var x = document.getElementsByClassName("chartjs-hidden-iframe");
    function some_function() {
        var labels = <?php echo $competency_labels; ?>;
        var drop_down = document.getElementById("user_id");
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo site_url('admin/chart/getCompetency/') ?>' + drop_down.value,
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {

                if (x.length != "")
                {
                myChart.destroy();
                }
                const CHART = document.getElementById("lineChart");
                        myChart = new Chart(CHART, {
                            type: 'radar',
                            data: {
                                labels: data.competency_labels,
                                datasets: [{
                                        label: "Ist",
                                        borderColor: "#00FF00",
                                        borderWidth: 0.1,
                                        data: data.userCompArray,
                                    },
                                    {
                                        label: "Stellenanforderungen",
                                        borderColor: "rgba(200,0,0,0.6)",
                                        backgroundColor: "rgba(0,0,0,0)",
                                        borderWidth: 2,
                                        data: data.jobsCompArray,
                                    }],
                            },
                            options: {
                                scale: {
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 4,
                                        stepSize: 1,
                                        callback: function (value) {
                                            if (value == 1) {
                                                return "Basic";
                                            }
                                            if (value == 2) {
                                                return "Intermediate";
                                            }
                                            if (value == 3) {
                                                return "Advance";
                                            }
                                            if (value == 4) {
                                                return "Expert";
                                            }
                                        }
                                    }
                                }
                            }
                        });

            },
            error: function (e) {
                console.info(e);
            },
        });
    }

    function title_function() {
        var labels = <?php echo $competency_labels; ?>;
        var drop_down = document.getElementById("title_id");
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo site_url('admin/chart/viewUsersChart/') ?>' + drop_down.value,
//            data: {data: $(dataString).serializeArray()},
            cache: false,
            success: function (data) {
                if (x.length != "")
                {
                    myChart.destroy();
                }
                const CHART = document.getElementById("lineChart");
                        myChart = new Chart(CHART, {
                            type: 'radar',
                            data: {
                                labels: labels,
                                datasets: data

                            },
                            options: {
                                scale: {
                                    ticks: {
                                        suggestedMin: 0,
                                        suggestedMax: 4,
                                        stepSize: 1,
                                        callback: function (value) {
                                            if (value == 1) {
                                                return "Basic";
                                            }
                                            if (value == 2) {
                                                return "Intermediate";
                                            }
                                            if (value == 3) {
                                                return "Advance";
                                            }
                                            if (value == 4) {
                                                return "Expert";
                                            }
                                        }
                                    }
                                }
                            }
                        });
            },
            error: function (e) {
                console.info(e);
            },
        });
    }

</script>

<script>
//    
//    $(window).load(function () {/*code here*/
//
//    var labels = <?php // echo $competency_labels;           ?>;
//            const CHART = document.getElementById("lineChart");
//            var barChart = new Chart(CHART, {
//                type: 'radar',
//                data: {
//                    labels: labels,
//                    datasets: [
//<?php // foreach ($listUser as $key => $val):           ?>
//                            {
//                                label: <?php // echo json_encode($key);           ?>,
////                                        borderColor: "#00FF00",
//                                borderWidth: 0.1,
//                                        data: <?php // echo json_encode($val);           ?>,
//                            },
//<?php // endforeach;           ?>
//                    ],
//                },
//                options: {
//                    scale: {
//                        ticks: {
//                            suggestedMin: 0,
//                            suggestedMax: 4,
//                            stepSize: 1,
//                            callback: function (value) {
//                                if (value == 1) {
//                                    return "Basic";
//                                }
//                                if (value == 2) {
//                                    return "Intermediate";
//                                }
//                                if (value == 3) {
//                                    return "Advance";
//                                }
//                                if (value == 4) {
//                                    return "Expert";
//                                }
//                            }
//                        }
//                    }
//                }
//            });
//    });
</script>

