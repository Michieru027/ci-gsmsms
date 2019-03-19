<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo @$template['title']; ?></title>

    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>normalize.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>themify-icons.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>cs-skin-elastic.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>lib/chosen/chosen.min.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>custom.css">
    <link rel="stylesheet" href="<?php echo $this->template->Scss(); ?>style.css">
    <link href="<?php echo $this->template->Css(); ?>lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <LINK REL="SHORTCUT ICON" HREF="<?php echo $this->template->Images(); ?>favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->template->FontAwesome(); ?>css/font-awesome.min.css">
    <?php echo (isset($template['metadata'])) ? $template['metadata']: '';?>

    <script>function base_url(){ return '<?php echo base_url(); ?>'; } function img_path(){ return '<?php echo $this->template->Img(); ?>'; }</script>
    <script src="<?php echo $this->template->Js() ;?>react-0.14.3/build/react.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>react-0.14.3/build/react-dom.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>react-0.14.3/build/react-dom-server.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>react-0.14.3/build/react-with-addons.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>react-0.14.3/build/browser.min.js"></script>
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>jquery-3.3.1.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>popper.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>plugins.js"></script>
    <script src="<?php echo $this->template->Js() ;?>main.js"></script>
    <script src="<?php echo $this->template->Js() ;?>lib/data-table/datatables.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>lib/data-table/datatables-init.js"></script>
    <script src="<?php echo $this->template->Js() ;?>lib/chosen/chosen.jquery.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>bootstrap3-typeahead.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>angular.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>angular-sanitize.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>angular-route.min.js"></script>
    <script src="<?php echo $this->template->Js() ;?>highcharts.js"></script>
    <script src="<?php echo $this->template->Js() ;?>common.js"></script>
    <?php if(isset($js)){ ?>
        <script src="<?php echo $this->template->Js() ;?><?php echo $js; ?>"></script>
    <?php } ?>
    <?php if(isset($react_js)){ ?>
        <script src="<?php echo $this->template->Js() ;?><?php echo $react_js; ?>" type="text/babel"></script>
    <?php } ?>
</head>
<body class="index">
<script>
    var loader_html =   '<div class="text-center reply-loader"> <img src="<?php echo $this->template->Images(); ?>logo-loader.gif" /></div>';
</script>
<?php echo $this->load->view('widgets/navigation'); ?>
<?php echo $this->load->view('widgets/right_panel'); ?>


