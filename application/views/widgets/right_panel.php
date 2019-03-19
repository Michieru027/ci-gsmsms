<?php
    $notif_data =   System::generate_notification();
?>
<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header">

        <div class="header-menu">

            <div class="col-sm-7">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                <div class="header-left">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modal_create_sms">New SMS <i class="fa fa-envelope"></i></button>
<!--                    <div class="dropdown for-notification">-->
<!--                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                            <i class="fa fa-bell"></i>-->
<!--                            <span class="count bg-danger">--><?php //echo $notif_data['total_notif']; ?><!--</span>-->
<!--                        </button>-->
<!--                        <div class="dropdown-menu" aria-labelledby="notification">-->
<!--                            --><?php //echo $notif_data['notif_html']; ?>
<!--                        </div>-->
<!--                    </div>-->

<!--                    <div class="dropdown for-message">-->
<!--                        <button class="btn btn-secondary dropdown-toggle" type="button"-->
<!--                                id="message"-->
<!--                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                            <i class="ti-email"></i>-->
<!--                            <span class="count bg-primary">9</span>-->
<!--                        </button>-->
<!--                        <div id="sms_notification" class="dropdown-menu" aria-labelledby="message">-->
<!--                            <p class="red">You have 4 Mails</p>-->
<!--                            <a class="dropdown-item media bg-flat-color-1" href="#">-->
<!--                                <span class="message media-body">-->
<!--                                    <span class="name float-left">Jonathan Smith</span>-->
<!--                                    <span class="time float-right">Just now</span>-->
<!--                                        <p>Hello, this is an example msg</p>-->
<!--                                </span>-->
<!--                            </a>-->
<!--                            <a class="dropdown-item media bg-flat-color-4" href="#">-->
<!--                                <span class="message media-body">-->
<!--                                    <span class="name float-left">Jack Sanders</span>-->
<!--                                    <span class="time float-right">5 minutes ago</span>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur</p>-->
<!--                                </span>-->
<!--                            </a>-->
<!--                            <a class="dropdown-item media bg-flat-color-5" href="#">-->
<!--                                <span class="message media-body">-->
<!--                                    <span class="name float-left">Cheryl Wheeler</span>-->
<!--                                    <span class="time float-right">10 minutes ago</span>-->
<!--                                        <p>Hello, this is an example msg</p>-->
<!--                                </span>-->
<!--                            </a>-->
<!--                            <a class="dropdown-item media bg-flat-color-3" href="#">-->
<!--                                <span class="message media-body">-->
<!--                                    <span class="name float-left">Rachel Santos</span>-->
<!--                                    <span class="time float-right">15 minutes ago</span>-->
<!--                                        <p>Lorem ipsum dolor sit amet, consectetur</p>-->
<!--                                </span>-->
<!--                            </a>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>

            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="user-avatar rounded-circle" src="<?php echo $this->template->Images(); ?>ologo.png">
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#modal_update_profile"><i class="fa fa- user"></i>My Profile</a>

                        <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                        <a class="nav-link" href="<?php echo base_url(); ?>logout"><i class="fa fa-power -off"></i>Logout</a>
                    </div>
                </div>

                <div class="language-select dropdown" id="language-select">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"  id="language" aria-haspopup="true" aria-expanded="true">
                        <i class="flag-icon flag-icon-us"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="language" >
                        <div class="dropdown-item">
                            <span class="flag-icon flag-icon-fr"></span>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-es"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-us"></i>
                        </div>
                        <div class="dropdown-item">
                            <i class="flag-icon flag-icon-it"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </header><!-- /header -->
    <!-- Header-->

    <div class="breadcrumbs">
        <div class="col-sm-4">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1>O Shopping GSM SMS</h1>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="page-header float-right">
                <div class="page-title">
<!--                    <ol class="breadcrumb text-right">-->
<!--                        <li><a href="#">Dashboard</a></li>-->
<!--                        <li><a href="#">Table</a></li>-->
<!--                        <li class="active">Basic table</li>-->
<!--                    </ol>-->
                </div>
            </div>
        </div>
    </div>

    <div style="<?php echo ($this->session->flashdata('validation_success')) ? 'display:block' : 'display:none'; ?>" class="sufee-alert alert with-close alert-success alert-dismissible fade show" style="display:none;">
        <span class="badge badge-pill badge-success">Success</span>
        <span class="success-msg"><?php echo $this->session->flashdata('validation_success'); ?></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div style="<?php echo ($this->session->flashdata('validation_errors')) ? 'display:block' : 'display:none'; ?>" class="sufee-alert alert with-close alert-danger alert-dismissible fade show fail-capture-data" style="display:none;">
        <span class="badge badge-pill badge-danger">Failed</span>
        <span class="error-msg"><?php echo $this->session->flashdata('validation_errors'); ?></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>