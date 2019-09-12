<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->full_title; ?></title>
    <meta name="description" content="<?php echo $this->description; ?>">
    <meta name="author" content="HMVC.CN">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>/vendor/bootstrap/css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="<?php echo ASSETS_ADMIN_URL; ?>/css/main.css" media="screen">

    <script src="<?php echo ASSETS_URL; ?>/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="<?php echo ASSETS_URL; ?>/js/pace.min.js"></script>
    <?php echo $this->printCSS('header'); ?>
    <?php echo $this->printJS('header'); ?>
    <?php do_hooks('header'); ?>
    <script>var ADMIN_BASEURL='<?php echo ADMIN_BASE_URL ?>';</script>
    <?php if(DEBUG){ echo page()->phpdebugbar->getJavascriptRenderer()->renderHead(); } ?>
</head>
<body class="fixed-navbar fixed-layout">
<?php do_hooks('body_begin'); ?>
<div class="page-wrapper">
    <?php
    require APP_PATH . '/system/views/top_header.tpl.php';
    ?>

    <?php require APP_PATH . '/system/views/left_sidebar.tpl.php'; ?>
    <div class="content-wrapper">
        <div class="page-content">
