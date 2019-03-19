<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="./"><img src="<?php echo $this->template->Images(); ?>logo.png" alt="Logo"></a>
        </div>
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li <?php echo ($this->template->Vars('class') == 'dashboard' ? 'class="active"' : ''); ?>>
                    <a href="<?php echo base_url(); ?>dashboard"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                </li>
                <li <?php echo ($this->template->Vars('class') == 'SMS' ? 'class="active"' : ''); ?>>
                    <a href="<?php echo base_url(); ?>dashboard/sms"> <i class="menu-icon ti-email"></i>SMS </a>
                </li>
                <li <?php echo ($this->template->Vars('class') == 'contacts' ? 'class="active"' : ''); ?>>
                    <a href="<?php echo base_url(); ?>dashboard/contacts"> <i class="menu-icon ti-user"></i>Contacts </a>
                </li>
                <li <?php echo ($this->template->Vars('class') == 'users' ? 'class="active"' : ''); ?>>
                    <a href="<?php echo base_url(); ?>dashboard/users"> <i class="menu-icon fa fa-user"></i>Users </a>
                </li>
                <li class="menu-item-has-children dropdown <?php echo ($this->template->Vars('class') == 'permissions' ? 'show' : ''); ?>">
                    <a href="<?php echo base_url(); ?>dashboard/settings" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-settings"></i>Settings</a>
                    <ul class="sub-menu children dropdown-menu <?php echo ($this->template->Vars('class') == 'permissions' ? 'show' : ''); ?>">
                        <li <?php echo ($this->template->Vars('class') == 'permissions' ? 'class="active"' : ''); ?>><i class="menu-icon fa fa-lock"></i><a href="<?php echo base_url(); ?>dashboard/permissions">Permissions</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->