<div class="modal fade" id="modal_update_profile" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo base_url(); ?>dashboard/users/update">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeModalLabel">O Shopping GSM SMS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="profile-body">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center">My Profile</h3>
                            </div>
                            <hr>
                            <?php if($this->session->flashdata('validation_errors')){ ?>
                                <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                                    <span class="badge badge-pill badge-danger">Error!</span>
                                    <?php echo $this->session->flashdata('validation_errors'); ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <aside class="profile-nav alt">
                                <section class="card">
                                    <div class="card-header user-header alt bg-dark">
                                        <div class="media">
                                            <div class="media-body">
                                                <h2 class="text-light display-6"><?php echo strtoupper($this->session->userdata('username')); ?></h2>
                                                <p>Level: <?php echo $this->session->userdata('level'); ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <a href="#"> <i class="fa fa-user"></i> <?php echo $this->session->userdata('fullname'); ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <a href="#"> <i class="ti ti-email"></i> <?php echo $this->session->userdata('email'); ?></a>
                                        </li>
                                    </ul>

                                </section>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-ban"></i> Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i> Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>