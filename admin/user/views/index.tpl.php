<?php get_header();
add_breadcrumb('文章管理', url_for('/node/'), '');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <button type="button" class="btn btn-success "
                    onclick="redirect('<?php echo url_for('/user/index.php?action=add'); ?>');">
                <i class="fa fa-plus"></i> 添加用户
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

    <div class="card  table-responsive">
        <div class="card-body">
            <!-- Search -->
            <?php
            $search_list = [
                'uid' => '<i class="fa fa-fw fa-star mr-5"></i>用户ID',
                'username' => '<i class="fa fa-fw fa-user mr-5"></i>用户名',
                'email' => '<i class="fa fa-fw fa-envelope-o mr-5"></i>Email'
            ];
            $search_type_default = input_get('st', 'title');
            if (!key_exists($search_type_default, $search_list)) {
                $search_type_default = 'username';
            }
            ?>
            <div class="form-group">
                <div class="input-group input-group-sm" id="search_type_input">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $search_list[$search_type_default]; ?></button>
                        <div class="dropdown-menu">
                            <?php foreach ($search_list as $name => $html) { ?>
                                <li><a class="dropdown-item" href="javascript:void(0)"
                                       data-type="<?php echo $name; ?>"><?php echo $html; ?></a></li>
                            <?php } ?>
                        </div>
                    </div>

                    <input type="text" class="form-control" placeholder="搜索..." name="s" id="s"
                           value="<?php echo input_get('s'); ?>">
                    <input name="st" value="<?php echo $search_type_default; ?>" id="st" type="hidden"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">搜索</button>
                    </div>

                </div>
            </div>



            <table class="table table-hover table-striped table-vcenter table-bordered">
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
                                <a class="btn btn-default btn-sm" data-toggle="tooltip"
                                   title="编辑"
                                   href="<?php echo url_for('/user/?action=edit', ['id' => $user->id]); ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a class="btn btn-default btn-sm" data-toggle="tooltip"
                                   title="删除" href="javascript:void(0);"
                                   onclick="delete_user('<?php echo $user->display_name; ?>',<?php echo $user->id; ?>);">
                                    <i class="fa fa-trash "></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>


                    </tbody>
                </table>


            <!-- Navigation -->
            <nav>
                <?php echo $pagehelper->render(7, 'pagination  justify-content-center'); ?>

            </nav>


            <!-- END Search -->
        </div>

    </div>
    <!-- END Orders -->
</form>

<script>
    $(function () {
        $('#search_type_input .dropdown-menu a').on('click', function () {
            $(this).parent().parent().prev().html($(this).html());
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

