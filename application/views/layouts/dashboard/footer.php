<?php echo $this->load->view('modals/profile'); ?>
<?php echo $this->load->view('modals/create_sms'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("table#data-table, table#sms-data-table").DataTable({'aaSorting':[[4,'desc']]});
        $("table#contacts-data-table").DataTable({'aaSorting':[[0,'desc']]});

        $(".standardSelect").chosen({
            disable_search_threshold: 10,
            no_results_text: "Oops, nothing found!",
            width: "100%"
        });

    });
</script>