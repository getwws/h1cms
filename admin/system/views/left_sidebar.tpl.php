<nav class="page-sidebar " id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex ">
            <div>
                <?php echo get_avatar(\system\Auth::user()->avatar,45); ?>
            </div>
            <div class="admin-info">
                <div class="font-strong"><?php echo \system\Auth::user()->display_name ; ?></div><small>Administrator</small></div>
        </div>



        <?php do_hooks('left_sidebar_begin'); ?>
        <ul class="side-menu metismenu ">

            <?php $this->build_nav(); ?>

        </ul>
        <?php do_hooks('left_sidebar_end'); ?>



    </div>
</nav>

