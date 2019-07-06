<?php get_header();
add_breadcrumb('文章管理', url_for('/node/'), '');
add_breadcrumb('分类管理', url_for('/node/'), '');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a class="btn btn-success " href="<?php echo url_for('/node/category.php?action=add'); ?>">
                <i class="fa fa-plus"></i> 添加分类
            </a>
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

        <div class="card-body table-responsive">
            <!-- Orders Table -->
            <table class="table table-striped table-borderless table-hover table-vcenter" id="datatable">
                <thead class="thead-default">
                <tr>
                    <th class="">分类名称</th>
                    <th class="">排序</th>
                    <th class="">状态</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php
                function printtable($categories, $parent_id = 0, $path = [])
                {
                    foreach ($categories as $category) {
                        if ($category->parent_id != $parent_id) {
                            $path = array_slice($path, 0, $category->parent_id);
                        }
                        $path[$category->parent_id] = $category->title;
                        $pid = $category->parent_id;
                        $title = join(' > ', $path);
                        ?>
                        <tr>
                            <td class="font-w400"><?php echo $title; ?></td>
                            <td>
                                <?php echo $category->sort_order; ?>
                            </td>

                            <td><?php \system\admin\Status::common($category->status); ?></td>
                            <td class="actions">
                                <a class="btn btn-default btn-sm" data-toggle="tooltip"
                                   title="编辑"
                                   href="<?php echo url_for('/node/category.php?action=edit', ['id' => $category->category_id]); ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a class="btn btn-default btn-sm" data-toggle="tooltip"
                                   title="删除" href="javascript:void(0);"
                                   onclick="delete_category('<?php echo $title; ?>',<?php echo $category->category_id; ?>);">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        if (isset($category->children) && !empty($category->children)) {
                            printtable($category->children, $category->category_id, $path);
                        }
                    }

                } //END printtable
                printtable($categories, 0, []);
                ?>
                </tbody>
            </table>
            <!-- END Orders Table -->


        </div>
    </div>


</form>


<script>
    function delete_category(title, id) {
        swal({
            title: "确认删除此分类吗?",
            text: title,
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: '确认删除',
            cancelButtonText: '取消'
        }).then(function (result) {
            $.post('<?php echo url_for('/node/category.php?action=delete'); ?>', {id: id}, function (data) {
                swal({text: data.message, type: data.type}).then(function () {
                    location.reload();
                });
            }, 'json');
        }, function (ds) {
        });
    }
</script>
<?php get_footer(); ?>

