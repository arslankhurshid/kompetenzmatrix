<?php $this->load->view('admin/components/page_head'); ?>
<div class="container">
    <div class="row">
        <div class="col-md-5 col-md-offset-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-lock"></span> Login</div>
                <p>Bitte geben Sie Ihren Benutzernamen und Ihr Passwort ein.</p>

                <?php $this->load->view($subview); // subview is set in Controller?>
                
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/components/page_tail'); ?>