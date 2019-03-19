<div class="login-wrapper">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="<?php echo base_url(); ?>">
                        <img class="align-content" src="<?php echo $this->template->Images(); ?>logo.png" alt=""> GSM SMS
                    </a>
                </div>
                <div class="login-form">
                    <?php if($this->session->flashdata('validation_error')){ ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('validation_error'); ?>
                        </div>
                    <?php } ?>
                    <form method="post" action="<?php echo base_url(); ?>login/submit">
                        <div class="form-group">
                            <input required type="text" class="form-control" id="gsm_username" name="gsm_username" aria-describedby="emailHelp" placeholder="Enter username">
                        </div>
                        <div class="form-group">
                            <input required type="password" class="form-control" id="gsm_password" name="gsm_password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30"><i class="fa fa-user"></i> Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
