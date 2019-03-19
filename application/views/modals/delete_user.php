<div class="modal fade" id="modal_del_user" tabindex="-1" role="dialog" aria-labelledby="largeModalLabel" aria-hidden="true">
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
                                <h3 class="text-center">Are you sure you want to delete this user?</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-primary delete-user-confirm">Yes</a>
                    <a href="javascript:void(0)" class="btn btn-secondary" data-dismiss="modal">No</a>
                </div>
            </form>
        </div>
    </div>
</div>