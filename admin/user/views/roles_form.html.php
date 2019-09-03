<?php register_assets_plugins('jquery-validation'); ?>
<?php get_header();
add_breadcrumb('角色管理', url_for('/user/roles.php'), '');
?>
<form action="" method="post" class="jq-validate form-horizontal">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo url_for('/user/roles.php'); ?>" class="btn btn-space btn-default"
               data-toggle="tooltip"><i class="fa fa-reply"></i> 返回</a>
            <button type="submit" class="btn btn-space btn-primary" data-toggle="tooltip"><i class="fa fa-save"></i>保存
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

        <div class="col-md-12">
            <div class="ibox ibox-default">
                <div class="ibox-head">
                    <div class="ibox-title"><i class="fa fa-edit"></i> <?php echo isset($role) ? '修改':'添加'; ?>角色</div>
                </div>
                <div class="ibox-body">
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="role-title">角色名称</label>
                                <div class="col-lg-7">
                                    <input type="text" class="form-control" id="role-title"
                                           name="role[title]"
                                           value="<?php echo $role->title; ?>" placeholder="请输入角色名称">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label" for="role-description">角色描述</label>
                                <div class="col-lg-7">
                                <textarea rows="3" class="form-control" id="role-description"
                                          name="role[description]"
                                          placeholder="请输入角色描述"><?php echo $role->description; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Shipping Address -->
    </div>

</form>

<script>
    function page_end() {
        jquery_validator({
                'role[title]': {
                    required: true,
                    minlength: 1
                }
            },
            {
                'role[title]':{
                    required: '请输入角色名称',
                    minlength: '请输入角色名称'
                }
            }
        );
    }
</script>
<?php get_footer(); ?>

