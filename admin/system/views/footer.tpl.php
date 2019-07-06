        <?php //require APP_PATH . '/system/views/right_sidebar.tpl.php';?>
        </div> <!-- end page-content -->
        <footer class="page-footer">
            <div class="font-13">2018 © <b><?php echo $this->name . ' ' . $this->version; ?></b> - 嘉兴领格信息技术有限公司 - All rights reserved.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
        </div><!-- content-wrapper -->
</div>
<!-- /.page-wrapper -->
<!-- BEGIN PAGA BACKDROPS-->
<!--<div class="sidenav-backdrop backdrop"></div>-->
<!--<div class="preloader-backdrop">-->
<!--    <div class="page-preloader">Loading</div>-->
<!--</div>-->
<!-- END PAGA BACKDROPS-->
<?php do_hooks('body_end'); ?>
<script src="<?php echo ASSETS_URL; ?>/js/popper.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/sweetalert2/sweetalert2.all.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/metisMenu/metisMenu.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/vendor/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_ADMIN_URL; ?>/js/app.js"></script>
<?php echo $this->printJS('footer'); ?>
<?php do_hooks('footer'); ?>
<script type="application/javascript">
    if (typeof page_end == 'function') {
        page_end();
    }
    $(document).ready(function(){

    });
</script>
</body>
</html>