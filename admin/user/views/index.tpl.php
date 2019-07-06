<?php get_header();
add_breadcrumb('文章管理', url_for('/node/'), '');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="button" class="btn btn-success "
                    onclick="redirect('<?php echo url_for('/user/index.php?action=add'); ?>');">
                <i class="fa fa-plus mr-5"></i>添加用户
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

    <div class="ibox">
        <div class="ibox-body">
            <!-- Search -->
            <div class="form-group">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="搜索..." name="s"
                           id="s">
                    <input name="st" value="username" id="st" type="hidden"/>
                    <div class="input-group-btn" id="search_type_input">
                        <button type="button" data-toggle="dropdown" class="btn btn-sm btn-primary dropdown-toggle"
                                aria-expanded="false"><i class="fa fa-fw fa-user"></i>用户名 <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)" data-type="uid">
                                    <i class="fa fa-fw fa-star mr-5"></i>用户ID
                                </a></li>
                            <li><a href="javascript:void(0)" data-type="username">
                                    <i class="fa fa-fw fa-user mr-5"></i>用户名
                                </a></li>
                            <li><a href="javascript:void(0)" data-type="email">
                                    <i class="fa fa-fw fa-envelope-o mr-5"></i>Email
                                </a></li>
                        </ul>
                    </div>


                </div>
            </div>

            <!-- END Search -->
        </div>
        <div class="ibox-body">
            <!-- Orders Table -->
            <div class="table-responsive">

                <table class="table table-striped table-borderless table-hover table-vcenter">
                    <thead class="thead-default">
                    <tr>
                        <th style="width: 50px;">ID</th>

                        <th class="text-center" style="width: 70px;"><i class="fa fa-user"></i></th>
                        <th>用户名</th>
                        <th>Email</th>
                        <th>昵称</th>
                        <th>最后登录时间</th>
                        <th>状态</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php
                    while ($user = $users->fetchObject()) {
                        ?>
                        <tr>
                            <td>

                                <a class="font-w600"
                                   href="<?php echo url_for('/user/index.php?action=view', ['id' => $user->id]); ?>"><?php echo $user->id; ?></a>
                            </td>
                            <td class="text-center"><?php get_avatar($user->avatar, 32); ?></td>
                            <td>
                                <a class="font-w600"
                                   href="<?php echo url_for('/user/index.php?action=view', ['id' => $user->id]); ?>"><?php echo $user->username; ?></a>
                            </td>
                            <td><a class="font-w600"
                                   href="<?php echo url_for('/user/index.php?action=view', ['id' => $user->id]); ?>"><?php echo $user->email; ?></a>
                            </td>
                            <td>
                                <?php echo $user->display_name; ?>
                            </td>
                            <td>
                                <span class="text-black"><?php echo format_date($user->lasttime, 'Y-m-d'); ?></span>
                            </td>
                            <td><?php \system\admin\Status::user($user->status); ?></td>
                            <td class="actions">
                                    <a class="icon" data-toggle="tooltip"
                                       title="编辑"
                                       href="<?php echo url_for('/user/?action=edit', ['id' => $user->id]); ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="icon" data-toggle="tooltip"
                                       title="删除" href="javascript:void(0);"
                                       onclick="delete_user('<?php echo $user->display_name; ?>',<?php echo $user->id; ?>);">
                                        <i class="fa fa-trash "></i>
                                    </a>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>
                <!-- END Orders Table -->
            </div>

            <!-- Navigation -->
            <nav>
                <?php echo $pagehelper->render(7, 'pagination  justify-content-center'); ?>

            </nav>
            <!-- END Navigation -->
        </div>
    </div>
    <!-- END Orders -->
</form>

<script>
    $(function () {
        $('#search_type_input .dropdown-menu a').on('click', function () {
            $(this).parent().parent().prev().html($(this).html() + '  <span class="caret"></span>');
            $('#st').val($(this).attr('data-type'));
        })

    });

    function delete_user(title, id) {
        swal({
            title: "确认删除此用户吗?",
            text: title,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '确认删除',
            cancelButtonText: '取消'
        }).then(function (result) {
            $.post('<?php echo url_for('/user/index.php?action=delete'); ?>', {id: id}, function (data) {
                swal({text: data.message, type: data.type}).then(function () {
                    location.reload();
                });
            }, 'json');
        }, function (ds) {
        });
    }
</script>
<?php get_footer(); ?>

