<?php get_header(); ?>
<div class="page-content fade-in-up">

    <!-- Page Content -->
    <div class="row ">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-link"></i> <?php echo __('快捷菜单'); ?></h4>
                    <a class="btn btn-default" href="<?php echo url_for('/node/page.php'); ?>">
                        <i class="fa fa-file-text"></i> <?php echo __('单页管理'); ?>
                    </a>
                    <a class="btn btn-default" href="<?php echo url_for('/node/index.php'); ?>">
                        <i class="fa fa-pencil-square-o"></i> <?php echo __('文章管理'); ?>
                    </a>
                    <a class="btn btn-default" href="<?php echo url_for('/node/category.php'); ?>">
                        <i class="fa fa-list-alt"></i> <?php echo __('分类管理'); ?>
                    </a>
                    <a class="btn btn-default" href="<?php echo url_for('/products/'); ?>">
                        <i class="fa fa-cubes"></i> <?php echo __('产品管理'); ?>
                    </a>
                    <a class="btn btn-default" href="<?php echo url_for('/users/'); ?>">
                        <i class="fa fa-users"></i> <?php echo __('用户管理'); ?>
                    </a>
                    <a class="btn btn-default" href="<?php echo url_for('/system/setting.php'); ?>">
                        <i class="fa fa-cog"></i> <?php echo __('系统设置'); ?>
                    </a>
                    <a class="btn btn-default" href="<?php echo url_for('/appearance/theme.php'); ?>">
                        <i class="fa  fa-magic"></i> <?php echo __('主题设置'); ?>
                    </a>

                </div>
            </div>


        </div>
    </div>


    <div class="row pt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-info"></i> <?php echo __('系统信息'); ?></h4>
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-bordered">
                            <tbody>
                            <tr>
                                <td>H1CMS版本</td>
                                <td><?php echo HMVC_VERSION; ?></td>
                                <td>数据库</td>
                                <td><?php echo \getw\Arr::get($db_info, 'driver', ''), ' ', \getw\Arr::get($db_info, 'version', ''); ?></td>
                            </tr>
                            <tr>
                                <td>PHP版本</td>
                                <td><?php echo PHP_VERSION, '(' . php_sapi_name() . ')'; ?></td>
                                <td>图形库</td>
                                <td>GD库版本 <?php
                                    echo ifOr(defined('GD_VERSION'), constant('GD_VERSION'), '不支持');
                                    ?>
                                    Imagick <?php echo ifOr(class_exists('Imagick'), '支持', '不支持');
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>默认语言</td>
                                <td><?php echo get_option('system.language'); ?></td>
                                <td>站点模板：</td>
                                <td><?php echo get_option('system.theme', 'default'); ?></td>
                            </tr>
                            <tr>
                                <td>时区</td>
                                <td><?php echo date_default_timezone_get(); ?></td>
                                <td>文件上传限制</td>
                                <td><?php echo ini_get('upload_max_filesize'); ?></td>
                            </tr>
                            <tr>
                                <td>服务器</td>
                                <td><?php echo PHP_OS, ' ', php_uname("m"); ?></td>
                                <td>Web 服务器：</td>
                                <td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <div class="row pt-2">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-support"></i> <?php echo __('开发者信息'); ?></h4>
                    <dl class="dl-horizontal">
                        <dt><?php echo __('H1CMS官网'); ?></dt>
                        <dd>http://www.h1cms.com</dd>
                        <dt>开发者信息</dt>
                        <dd>嘉兴领格信息技术有限公司，并保留所有权利。</dd>
                        <dt><?php echo __('Bug反馈'); ?></dt>
                        <dd>bugs@h1cms.com</dd>
                        <dt>系统使用协议</dt>
                        <dd>H1CMS License 1.0 <br/>http://www.h1cms.com/licenses/LICENSE-1.0.html<br/>
                            （您可以免费使用H1CMS系统，允许二次开发及商用，但必须保留相关版权信息。）
                        </dd>
                    </dl>
                </div>
            </div>
        </div>

    </div>
    <!-- END Page Content -->


</div>
<?php get_footer(); ?>

