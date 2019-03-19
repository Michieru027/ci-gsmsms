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
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo $this->template->Css(); ?>cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="<?php echo $this->template->Scss(); ?>style.css">
    <?php echo (isset($template['metadata_css']))? $template['metadata_css']: '';?>
    <LINK REL="SHORTCUT ICON" HREF="<?php echo $this->template->Images(); ?>favicon.ico" type="image/x-icon" />
    <script type="text/javascript" src="<?php echo $this->template->Js() ;?>jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->template->Js() ;?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->template->Js() ;?>jquery.easing.min.js"></script>
    <script type="text/javascript" src="<?php echo $this->template->Js() ;?>scrolling-nav.js"></script>
    <script type="text/javascript" src="<?php echo $this->template->Js() ;?>wow.min.js"></script>
    <script>function base_url(){ return '<?php echo base_url(); ?>'; } function img_path(){ return '<?php echo $this->template->Img(); ?>'; }</script>
    <script type="text/javascript" src="<?php echo $this->template->Js() ;?>global.js"></script>
    <?php echo (isset($template['metadata_js']))? $template['metadata_js']: '';?>
    <?php echo (isset($template['metadata']))? $template['metadata']: '';?>
</head>
<body class="bg-dark">

