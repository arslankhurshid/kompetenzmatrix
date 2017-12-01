<?php $this->load->view('admin/components/page_head'); ?>
<body>
    <?php // echo $meta_title; ?>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navigation" href="#">
                    <img id="" src="<?php echo site_url('public_html/images/company_logo.png') ?>" style="border: 0; float: left; margin-right: 155px; width: 100px" /> </a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="<?php echo base_url('/admin/dashboard'); ?>">Mitarbeiter</a></li>
                <li><?php echo anchor('admin/competency', 'Kompetenz'); ?></li>
                <li><?php echo anchor('admin/competency/order', 'Kompetenzen sortieren'); ?></li>
                <li><?php echo anchor('admin/jobtitle', 'Stellenbezeichnung'); ?></li>
                <li><?php echo anchor('admin/chart', 'Netzdiagramm'); ?></li>

            </ul>
        </div>
    </nav>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" id="messageDiv">

            <?php
            echo $this->session->flashdata('success');
            ?>
        </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <!--main column-->
            <div class="col-md-8">
                <section>
                    <?php $this->load->view($subview); // subview is set in Controller?>
                </section>
            </div>
            <!--            <div class="pull-left">
                            <section>
            
                            </section>
                        </div>-->
            <!--Side bar-->
            <div>
                <section class="col-md-4">
                    <?php
//                    print_r($this->session);
                    $user_name = $this->session->name;
                    echo "<a href='mailto:" . $user_name . "'>" . '<span class="glyphicon glyphicon-user"></span>' . '&nbsp;' . $user_name;
//                    echo mailto('".$email."', '<span class="glyphicon glyphicon-user"></span> $email'); 
                    ?> <br>
                    <?php echo anchor('admin/login/logout', '<span class="glyphicon glyphicon-off"></span> Abmelden'); ?> <br>
                </section>
            </div>
        </div>
    </div>
    <?php $this->load->view('admin/components/page_tail'); ?>

    <script>

        $('#messageDiv').delay(2000).fadeOut(400);


    </script>
