<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="description" content="GETCMS" />
    <meta name="author" content="" />
    <meta name="keywords" content="" />
    <title><?php echo get_option('site.sitename') ?> - <?php echo get_option('site.title') ?></title>

    <!-- Animate.css -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/css/icomoon.css">
    <link rel="stylesheet" type="text/css" href="<?php echo THEME_URL; ?>/css/bootstrap.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/css/superfish.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="<?php echo THEME_URL; ?>/css/style.css">

    <!-- Modernizr JS -->
    <script src="<?php echo THEME_URL; ?>/js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="<?php echo THEME_URL; ?>/js/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div id="fh5co-wrapper">
    <div id="fh5co-page">
        <div id="fh5co-header">
            <header id="fh5co-header-section">
                <div class="container">
                    <div class="nav-header">
                        <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
                        <h1 id="fh5co-logo"><a href="<?php echo url_for('/');?>">GetCMS</a></h1>
                        <!-- START #fh5co-menu-wrap -->
                        <nav id="fh5co-menu-wrap" role="navigation">
                            <ul class="sf-menu" id="fh5co-primary-menu">
                                <li class="active">
                                    <a href="<?php echo url_for('/');?>">首页</a>
                                </li>
                                <?php $menu = new \system\component\Menu();
                                $allmenu = $menu->getAll(0);
                                ?>
                                <?php
                                foreach ($allmenu as $menu) {
                                    ?>
                                    <li  >
                                        <a href="<?php echo $menu->url; ?>" <?php if(isset($menu->children) && !empty($menu->children)){ echo 'class="fh5co-sub-ddown"'; }?>><?php echo $menu->title; ?></a>
                                        <?php if(isset($menu->children) && !empty($menu->children)){ ?>
                                            <ul class="fh5co-sub-menu">
                                                <?php foreach($menu->children as $childmenu){?>
                                                    <li >
                                                        <a href="<?php echo url_for($childmenu->url); ?>" <?php if(isset($childmenu->children)){ echo 'class="fh5co-sub-ddown"'; }?> ><?php echo $childmenu->title; ?></a>
                                                        <?php if(isset($childmenu->children)){ ?>
                                                            <ul class="fh5co-sub-menu">
                                                                <?php foreach($childmenu->children as $threechild){?>
                                                                    <li><a href="<?php echo $threechild->url; ?>"><?php echo $threechild->title; ?></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        <?php } ?>
                                                    </li>
                                                <?php } ?>

                                            </ul>
                                        <?php } ?>
                                    </li>
                                <?php } //end foreach ?>


                            </ul>
                        </nav>
                    </div>
                </div>
            </header>

        </div>
