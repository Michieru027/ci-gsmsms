<?php
    $notif_data =   System::generate_notification();
?>

<div ng-app="dashboardAppController" ng-controller="dashboardAppController">
    <div ng-show="loader" class="container text-center ajax-loader">
        <div class="col-lg-12 col-md-12 col-xs-12">
            <img src="<?php echo $this->template->Images(); ?>logo-loader.gif" /> Loading data...
        </div>
    </div>

    <div ng-show="notif" ng-class="notif_class" class="sufee-alert alert with-close  alert-dismissible fade show success-capture-data">
        <span class="badge badge-pill " ng-class="notif_badge" ng-bind-html="notif_header"></span>
        <span ng-class="notif_class" ng-bind-html="notif_content"></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="dashboard-content" ng-show="content">
        <div class="card-group">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">New Users</div>
                                <div class="stat-digit new-gsm-sms-users"><?php echo (array_key_exists('user', $notif_data) ? $notif_data['notif_data']['user'] : 0); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-comment text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">New SMS/Thread</div>
                                <div class="stat-digit new-sms-captured" ng-bind="new_sms"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-one">
                            <div class="stat-icon dib"><i class="ti-email text-primary border-primary"></i></div>
                            <div class="stat-content dib">
                                <div class="stat-text">Unread Messages</div>
                                <div class="stat-digit sms-unread" ng-bind="unread_sms"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-group">
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-user text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">GSM SMS Users</div>
                                    <div class="stat-text users-database">Total: <?php echo $total_users; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-server text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">SMS in Database</div>
                                    <div class="stat-text sms-database">Total: <span ng-bind="total_sms"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-four">
                            <div class="stat-icon dib">
                                <i class="ti-email text-muted"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-heading">Opened Messages</div>
                                    <div class="stat-text sms-read">Total: <span ng-bind="opened_sms"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
