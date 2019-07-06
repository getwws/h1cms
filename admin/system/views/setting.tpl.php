<?php get_header(); ?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">

        </div>
        <h1><?php echo $this->title;?></h1>
        <ol class="breadcrumb">
            <?php foreach ($this->breadcrumbs as $breadcrumb){ ?>
                <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'];?> <?php echo $breadcrumb['title'];?></a></li>
            <?php } ?>
        </ol>
    </div>
</div>

<form action="" method="post">
            <!-- Page Content -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox ibox-default ">
                        <ul class="nav nav-tabs tabs-line" data-toggle="tabs" role="tablist">
                            <li class="nav-item ">
                                <a class="nav-link active" data-toggle="tab" href="#generate">常规设置</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " data-toggle="tab" href="#mailsettings">邮件设置</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link " data-toggle="tab" href="#fileupload">附件设置</a>
                            </li>
                        </ul>
                        <div class="ibox-body tab-content">
                            <div class="tab-pane active" id="generate" role="tabpanel">

                                <div class="row justify-content-center py-20">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label" for="site.sitename">网站名称</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="site.sitename"
                                                       name="site[sitename]"
                                                       value="<?php echo $options['site.sitename']; ?>"
                                                       placeholder="请输入网站名称">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label" for="site.title">网站名称</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="site.title"
                                                       name="site[title]"
                                                       value="<?php echo $options['site.title']; ?>"
                                                       placeholder="请输入网站标题">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label"
                                                   for="site.meta_keywords">网页关键词</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="site.meta_keywords"
                                                       name="site[meta_keywords]"
                                                       value="<?php echo $options['site.meta_keywords']; ?>"
                                                       placeholder="请输入网页名称">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label"
                                                   for="site.meta_description">网页描述</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="site.meta_description"
                                                       name="site[meta_description]"
                                                       value="<?php echo $options['site.meta_description']; ?>"
                                                       placeholder="请输入网页描述">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label" for="site.icp_number">ICP备案号</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="site.icp_number"
                                                       name="site[icp_number]"
                                                       value="<?php echo $options['site.icp_number']; ?>"
                                                       placeholder="请输入ICP备案号">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-lg-9 text-center">
                                                <button type="submit" class="btn btn-primary">保存</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="mailsettings" role="tabpanel">
                                <div class="row justify-content-center py-20">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="mail.protocol" class="col-lg-3 col-form-label">发送协议</label>
                                            <div class="col-lg-7">
                                                <label class="css-control css-control-primary css-radio">
                                                    <input type="radio" class="css-control-input" name="mail[protocol]"
                                                           value="mail" <?php echo $options['mail.protocol'] == 'mail' ? 'checked' : ''; ?>>
                                                    <span class="css-control-indicator"></span> Mail
                                                </label>
                                                <label class="css-control css-control-primary css-radio">
                                                    <input type="radio" class="css-control-input" name="mail[protocol]"
                                                           value="smtp" <?php echo $options['mail.protocol'] == 'smtp' ? 'checked' : ''; ?> >
                                                    <span class="css-control-indicator"></span> SMTP
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail.hostname" class="col-lg-3 col-form-label">SMTP 主机名</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="mail.hostname"
                                                       name="mail[hostname]"
                                                       value="<?php echo $options['mail.hostname']; ?>"
                                                       placeholder="SMTP主机名">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="mail.username" class="col-lg-3 col-form-label">用户名</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="mail.username"
                                                       name="mail[username]"
                                                       value="<?php echo $options['mail.username']; ?>"
                                                       placeholder="SMTP用户名">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail.password" class="col-lg-3 col-form-label">密码</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="mail.password"
                                                       name="mail[password]"
                                                       value="<?php echo $options['mail.password']; ?>"
                                                       placeholder="SMTP密码">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail.port" class="col-lg-3 col-form-label">SMTP 端口</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="mail.port" name="mail[port]"
                                                       value="<?php echo ifOr($options['mail.port'], 25); ?>"
                                                       placeholder="SMTP端口 默认25">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail.timeout" class="col-lg-3 col-form-label">SMTP
                                                Timeout</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="mail.timeout"
                                                       name="mail[timeout]"
                                                       value="<?php
                                                       echo get_default($options['mail.timeout'], 10);
                                                       ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 text-center">
                                                <button type="submit" class="btn btn-primary">保存</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="fileupload" role="tabpanel">
                                <div class="row justify-content-center py-20">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label for="upload.status" class="col-lg-3 col-form-label">文件上传</label>
                                            <div class="col-lg-7">
                                                <label class="css-control css-control-primary css-radio">
                                                    <input type="radio" class="css-control-input" name="upload[status]"
                                                           value="enabled" <?php echo ifOr(($options['upload.status'] != 'disabled' || $options['upload.status'] == 'enabled'), 'checked'); ?>>
                                                    <span class="css-control-indicator"></span> 允许上传
                                                </label>
                                                <label class="css-control css-control-primary css-radio">
                                                    <input type="radio" class="css-control-input" name="upload[status]"
                                                           value="disabled" <?php echo $options['upload.status'] == 'disabled' ? 'checked' : ''; ?> >
                                                    <span class="css-control-indicator"></span> 禁止上传
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="upload.upload_dir"
                                                   class="col-lg-3 col-form-label">文件上传路径</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="upload.upload_dir"
                                                       name="upload[upload_dir]"
                                                       value="<?php echo $options['upload.upload_dir']; ?>"
                                                       placeholder="留空默认上传到默认目录">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="upload.baseurl" class="col-lg-3 col-form-label">附件访问地址</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="upload.baseurl"
                                                       name="upload[baseurl]"
                                                       value="<?php echo $options['upload.baseurl']; ?>"
                                                       placeholder="留空默认 或者 (http://img.yourdomain.com/)">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail.username" class="col-lg-3 col-form-label">允许上传的图片类型</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="upload.ext_img"
                                                       name="upload[ext_img]"
                                                       value="<?php echo $options['upload.ext_img']; ?>"
                                                       placeholder="图片扩展名 jpg,png">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="mail.username" class="col-lg-3 col-form-label">允许上传的文件类型</label>
                                            <div class="col-lg-7">
                                                <input type="text" class="form-control" id="upload.ext_file"
                                                       name="upload[ext_file]"
                                                       value="<?php echo $options['upload.ext_file']; ?>"
                                                       placeholder="扩展名使用逗号隔开">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-lg-9 text-center">
                                                <button type="submit" class="btn btn-primary">保存</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </form>

<?php get_footer(); ?>

