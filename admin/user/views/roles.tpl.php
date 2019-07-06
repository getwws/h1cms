<?php get_header();
add_breadcrumb('角色管理', url_for('/user/roles.php'), '');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="button" class="btn btn-success " onclick="redirect('<?php echo url_for('/user/roles.php?action=add'); ?>');">
                <i class="fa fa-plus mr-2"></i>添加角色
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

<form action="" method="get">

    <div class="ibox ibox-default">

            <div class="ibox-body">
                <!-- Orders Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-borderless table-hover table-vcenter">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>角色名称</th>
                            <th>描述</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($role = $roles->fetchObject()) {
                            ?>
                            <tr>
                                <td><?php echo $role->id; ?></td>

                                <td><?php echo $role->title; ?></td>
                                <td>
                                    <?php echo $role->description; ?>
                                </td>
                                <td class="actions">

                                        <a class="btn btn-default btn-sm" data-toggle="tooltip" title="编辑"
                                           href="<?php echo url_for('/user/roles.php?action=edit', ['id' => $role->id]); ?>">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a class="btn btn-default btn-sm" data-toggle="tooltip" title="删除" href="javascript:void(0);"
                                           onclick="delete_role('<?php echo $role->title; ?>',<?php echo $role->id; ?>);">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                </td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                    <!-- END Orders Table -->
                </div>
                <!-- Navigation -->
                <nav >
                    <?php echo $pagehelper->render(7, 'pagination justify-content-center'); ?>
                </nav>

                <!-- END Navigation -->
            </div>
        </div>
        <!-- END Orders -->

</form>

<script>
    $(function () {
        $('#search_type_input .dropdown-menu a').on('click', function () {
            $(this).parent().prev().prev().html($(this).html());
            $('#st').val($(this).attr('data-type'));
        })

    });

    function delete_role(title, id) {
        swal({
            title: "确认删除此角色吗?",
            text: title,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '确认删除',
            cancelButtonText: '取消'
        }).then(function (result) {
            $.post('<?php echo url_for('/user/roles.php?action=delete'); ?>', {id: id}, function (data) {
                swal({text: data.message, type: data.type}).then(function () {
                    location.reload();
                });
            }, 'json');
        }, function (ds) {
        });
    }
</script>
<?php get_footer(); ?>

