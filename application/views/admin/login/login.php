<style>

    body { 
        background: url(../../public_html/images/company_logo.png) no-repeat left top fixed; 
        
        background-color: white;
/*        -webkit-background-size: cover;
        -moz-background-size: covCer;
        -o-background-size: cover;
        background-size: cover;*/
    }

    .panel-default {
        opacity: 0.9;
        margin-top:50px;
    }
    .form-group.last { margin-bottom:0px; }

</style>
<div class="panel-body">
    <?php if (isset($validation_error) && $validation_error !==''): ?>
        <div class="alert alert-danger" id="errordiv">
            <?php
            echo validation_errors();
            ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('errors')): ?>
        <div class="alert alert-danger" id="errordiv">

            <?php
            if ($this->session->flashdata('errors')) {
                echo $this->session->flashdata('errors');
            }
            ?>
        </div>

    <?php endif; ?>
    <?php echo form_open(); ?>
    <div class="form-group">
        <label for="inputEmail3" class="col-sm-3 control-label">
            Benutzername</label>
        <div class="col-sm-9">
            <input type="text" name="user_name" class="form-control" id="inputEmail3" placeholder="Benutzername" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">
            Passwort:</label>
        <div class="col-sm-9">
            <input type="password" name="user_hash" class="form-control" id="inputPassword3" placeholder="Passwort" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input type="checkbox"/>
                    Remember me
                </label>
            </div>
        </div>
    </div>

    <div class="form-group last">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-success btn-sm">
                Sign in</button>
            <button type="reset" class="btn btn-default btn-sm">
                Reset</button>
        </div>
    </div>
    <?php echo form_close(); ?>
    <?php
    if ($this->session->flashdata('success')) {
        echo $this->session->flashdata('success');
    }
    ?>
</div>

