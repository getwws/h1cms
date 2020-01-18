<?php

use system\model\Node;

register_assets_plugins('jquery-validation');
register_assets_plugins('summernote');
register_assets_plugins('flatpickr');
register_assets_plugins('themify-icons');
?>
<?php get_header();
add_breadcrumb('文章管理', url_for('/node/'), '');
?>
<form action="" method="post" class="jq-validate form-horizontal">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo url_for('/node/index.php'); ?>" class="btn btn-secondary"
               data-toggle="tooltip"><i class="fa fa-reply"></i> 返回</a>
            <button type="submit" class="btn btn-space btn-primary" data-toggle="tooltip"><i
                        class="fa fa-save"></i>保存
            </button>
        </div>
        <h1><?php echo $this->title;?></h1>
        <ol class="breadcrumb">
            <?php foreach ($this->breadcrumbs as $breadcrumb){ ?>
                <li class="breadcrumb-item"><a href="<?php echo $breadcrumb['link'];?>"><?php echo $breadcrumb['icon'];?> <?php echo $breadcrumb['title'];?></a></li>
            <?php } ?>
        </ol>
    </div>
</div>



    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ibox-default">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-pencil"></i> <?php echo ifOr(input_get('id', false) == true, '修改文章', '添加文章') ?>
                    </div>
                    <div class="ibox-tools">
<!--                        <a class="ibox-collapse"><i class="fa fa-minus"></i></a>-->
<!--                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>-->
                    </div>
                </div>
                <div class="ibox-body">
                    <ul class="nav nav-tabs" data-toggle="tabs" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" data-toggle="tab" href="#btabs-alt-static-home">基本信息</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#btabs-alt-static-profile">常规设置</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active  p-10" id="btabs-alt-static-home" role="tabpanel">

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label rigth-label" for="language-title">文章标题</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="language-title"
                                           name="language[<?php echo H_DEFAULT_LANGUAGE; ?>][title]"
                                           value="<?php echo $language->title; ?>" placeholder="请输入文章标题">
                                </div>
                            </div>
                            <div class="form-group row required">
                                <label class="col-sm-2 col-form-label rigth-label" for="node_slug" >SEO Url</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="node_slug"
                                           name="node[slug]"
                                           value="<?php echo $node->slug; ?>" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label rigth-label" for="language-content">文章内容</label>
                                <div class="col-sm-10">
                                        <textarea id="language-content-<?php echo H_DEFAULT_LANGUAGE; ?>"
                                                  data-upload="<?php echo url_for('/filemanager/upload.php'); ?>"
                                                  name="language[<?php echo H_DEFAULT_LANGUAGE; ?>][content]"><?php echo $language->content; ?></textarea>
                                </div>


                            </div>

                        </div>
                        <div class="tab-pane p-10" id="btabs-alt-static-profile" role="tabpanel">

                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label rigth-label" for="node-parent_id">上级分类</label>
                                <div class="col-lg-7">
                                    <select class="form-control input-sm" id="node-parent_id" name="parent_id">
                                        <option value="0">请选择上级分类</option>
                                        <?php
                                        $path = [];
                                        $pid = 0;
                                        $category_basepath = rtrim($category->path, "{$category->category_id}");
                                        foreach ($categories as $cat) {
                                            if ($cat->parent_id != $pid) {
                                                $path = array_slice($path, 0, $cat->parent_id);
                                            }
                                            $path[$cat->parent_id] = $cat->title;
                                            $pid = $cat->parent_id;
                                            ?>
                                            <option value="<?php echo $cat->category_id; ?>" <?php echo ifOr($cat->category_id == $relationships->category_id, 'selected'); ?>><?php echo join(' > ', $path); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label rigth-label" for="node-click-count">点击数</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="node-click-count"
                                           name="node[click_count]"
                                           value="<?php echo $node->click_count ? $node->click_count : 0; ?>"
                                           placeholder="文章点击数">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label rigth-label"
                                       for="node-comment-count">文章回复数</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="node-comment-count"
                                           name="node[comment_count]"
                                           value="<?php echo $node->comment_count ? $node->comment_count : 0; ?>"
                                           placeholder="文章回复数">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label rigth-label" for="node-node-status-1">文章状态</label>
                                <div class="col-lg-7 pt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="node-node-status-1" name="node[node_status]"
                                               class="custom-control-input"
                                               value="<?php echo Node::NODE_STATUS_PUBLISH; ?>" <?php echo ($node->node_status === 'publish' || is_null($node->node_status)) ? 'checked' : ''; ?> >
                                        <label class="custom-control-label" for="node-node-status-1">发布</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="node-node-status-2" name="node[node_status]"
                                               class="custom-control-input"
                                               value="<?php echo Node::NODE_STATUS_DRAFT; ?>" <?php echo $node->node_status === Node::NODE_STATUS_DRAFT ? 'checked' : ''; ?> >
                                        <label class="custom-control-label" for="node-node-status-2">草稿</label>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label rigth-label"
                                       for="node-comment-status-1">评论</label>
                                <div class="col-lg-7 pt-2">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="node-comment-status-1"
                                               name="node[comment_status]" class="custom-control-input"
                                               value="open" <?php echo ($node->comment_status === 'open' || is_null($node->comment_status)) ? 'checked' : ''; ?> >
                                        <label class="custom-control-label" for="node-comment-status-1">开启</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">

                                        <input type="radio" id="node-comment-status-2" class="custom-control-input"
                                               name="node[comment_status]"
                                               value="close" <?php echo $node->comment_status === 'close' ? 'checked' : ''; ?> >
                                        <label class="custom-control-label" for="node-comment-status-2">关闭</label>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-2 col-form-label rigth-label" for="node-node-date">发布时间</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control ui-datetimepicker"
                                           id="node-node-date"
                                           name="node[node_date]"
                                           value="<?php echo $node->node_date ? format_date($node->node_date, 'Y-m-d H:i:s') : date('Y-m-d H:i:s'); ?>"/>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div> <!-- end block-->
        </div>

    </div>

</form>


<script>
    $(function () {
        //editor
        $.summernote.options.toolbar.push(['style', ['add-text-tags']]);
        $('#language-content-<?php echo H_DEFAULT_LANGUAGE; ?>').summernote({
            lang: 'zh-CN',
            height: "300px",
            callbacks: {
                onImageUpload: function (files, editor, welEditable) {
                    url = $(this).data('upload'); //path is defined as data attribute for  textarea
                    sendFile(files[0], url, $(this));
                }
            }
        });

        $('.ui-datetimepicker').flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d H:i",
            locale: "zh"
        });
        $('#language-title').blur(function(){
            $.get('<?php echo url_for('/node/index.php?action=generateurl') ?>&title='+$(this).val(),function(title){
                $('#node_slug').val(title);
            });
        });

        //validator
        jquery_validator(
            {
                'language[<?php echo H_DEFAULT_LANGUAGE; ?>][title]': {
                    required: true,
                    minlength: 1
                }
            },
            {
                'language[<?php echo H_DEFAULT_LANGUAGE; ?>][title]': {
                    required: '请输入文章标题',
                    minlength: '请输入文章标题'
                }
            }, function (form) {
                form.submit();
            }
        );


    });

</script>
<?php get_footer(); ?>
