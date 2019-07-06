<?php get_header();
add_breadcrumb('文章管理', url_for('/node/'), '<i class="fa fa-clone"></i>');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a class="btn btn-success " href="<?php echo url_for('/node/page.php?action=add'); ?>"><i class="fa fa-plus"></i> 添加单页</a>
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
            <div class="card card-default">
                <div class="card-body">
                    <!-- Search -->
                    <?php
                    $search_list = [
                        'id' => '<i class="fa fa-fw fa-dot-circle-o mr-3"></i>文章ID',
                        'title' => '<i class="fa fa-fw fa-file mr-3"></i>文章标题'
                    ];
                    $search_type_default = input_get('st', 'title');
                    if (!key_exists($search_type_default, $search_list)) {
                        $search_type_default = 'title';
                    }
                    ?>
                    <div class="form-group">
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend" id="search_type_input">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $search_list[$search_type_default]; ?>
                                </button>
                                <ul class="dropdown-menu">
                                    <?php foreach ($search_list as $name => $html) { ?>
                                        <li><a class="dropdown-item" href="javascript:void(0)"
                                               data-type="<?php echo $name; ?>"><?php echo $html; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <input type="text" class="form-control" placeholder="搜索..." name="s" id="s"
                                   value="<?php echo input_get('s'); ?>">
                            <input name="st" value="<?php echo $search_type_default; ?>" id="st" type="hidden"/>


                        </div>
                    </div>
                    <!-- Orders Table -->
                    <table class="table table-hover table-striped table-vcenter">
                        <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th>文章标题</th>
                            <th style="width: 10%">浏览次数</th>
                            <th style="width: 15%">添加时间</th>
                            <th style="width: 5%">状态</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        while ($node = $nodes->fetchObject()) {
                            ?>
                            <tr>
                                <td>
                                    <a class="font-w600"
                                       href="<?php echo url_for('/node/page.php?action=edit', ['id' => $node->node_id]); ?>"><?php echo $node->node_id; ?></a>
                                </td>
                                <td>
                                    <a class="font-w600"
                                       href="<?php echo url_for('/node/page.php?action=edit', ['id' => $node->node_id]); ?>"><?php echo $node->title; ?></a>
                                </td>

                                <td>
                                    <?php echo $node->click_count; ?>
                                </td>
                                <td>
                                    <span class="text-black"><?php echo format_date($node->created_at, 'Y-m-d H:i'); ?></span>
                                </td>
                                <td><?php \system\admin\Status::node($node->node_status); ?></td>
                                <td class="actions">
                                    <a class="btn btn-default btn-sm" data-toggle="tooltip"
                                       title="编辑"
                                       href="<?php echo url_for('/node/page.php?action=edit', ['id' => $node->node_id]); ?>">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-default btn-sm" data-toggle="tooltip"
                                       title="删除" href="javascript:void(0);"
                                       onclick="delete_node('<?php echo $node->title; ?>',<?php echo $node->node_id; ?>);">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>


                        </tbody>
                    </table>
                    <!-- END Orders Table -->
                    <!-- Navigation -->
                    <nav>
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
            $(this).parent().parent().prev().html($(this).html() + '  <span class="caret"></span>');
            $('#st').val($(this).attr('data-type'));
        })

    });


    function delete_node(title, id) {
        swal({
            title: "确认删除此文章吗?",
            text: title,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '确认删除',
            cancelButtonText: '取消'
        }).then(function (result) {
            $.post('<?php echo url_for('/node/page.php?action=delete'); ?>', {id: id}, function (data) {
                swal({text: data.message, type: data.type}).then(function () {
                    location.reload();
                });
            }, 'json');
        }, function (ds) {
        });
    }
</script>
<?php get_footer(); ?>

