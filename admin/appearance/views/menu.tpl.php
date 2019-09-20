<?php get_header();
add_breadcrumb('外观设置', url_for('/appearance/theme.php'), '');
add_breadcrumb('菜单管理', url_for('/appearance/menu.php'), '');
?>
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <?php if($menu>0): ?>
            <a href="<?php echo url_for('/appearance/menu.php',['action'=>'removegroup','menu'=>$menu]); ?>" class="btn btn-danger"
               data-toggle="tooltip" data-original-title="删除菜单分组" onclick="return confirm('确认删除此分组吗?');"><i class="fa fa-remove"></i> 删除菜单分组</a>
            <?php endif;?>
        </div>
        <h1><?php echo $this->title; ?></h1>
        <ol class="breadcrumb">
            <?php foreach ($this->breadcrumbs as $breadcrumb) { ?>
                <li class="breadcrumb-item"><a
                            href="<?php echo $breadcrumb['link']; ?>"><?php echo $breadcrumb['icon']; ?><?php echo $breadcrumb['title']; ?></a>
                </li>
            <?php } ?>
        </ol>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <ul class="nav nav-tabs" >

            <?php foreach ($menu_group as $group): ?>
                <li class="nav-item">
                    <?php if ($menu == $group->menu_group_id): ?>
                        <a class="nav-link active" href="#menu_tab" data-toggle="tab" role="tab" aria-controls="contact"
                           aria-selected="false"><?php echo $group->menu_group_name; ?></a>
                    <?php else: ?>
                        <a class="nav-link "
                           href="<?php echo url_for('/appearance/menu.php', ['menu' => $group->menu_group_id]); ?>"><?php echo $group->menu_group_name; ?></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            <li class="nav-item" id="menu_group_add_li">
                <a class="nav-link " href="#addmenu_tab" data-toggle="tab" role="tab" aria-controls="contact"
                   aria-selected="false"><i class="fa fa-plus"></i> 添加菜单分组</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="menu_tab">
                <table class="table table-striped table-borderless table-hover table-vcenter" id="datatable">
                    <thead class="thead-default">
                    <tr>
                        <th class="">菜单名称</th>
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
                                       href="<?php echo url_for('/product/category.php?action=edit', ['id' => $category->category_id]); ?>">
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

                    }//END printtable
                    printtable($categories, 0, []);
                    ?>
                    </tbody>
                </table>
                <!-- END Orders Table -->


            </div>
            <div class="tab-pane" id="addmenu_tab">

                <div class="form-group row required">
                    <label class="col-lg-3 col-form-label rigth-label" for="language-title">菜单名称</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="group_name" name="group_name" value=""
                               placeholder="请输入菜单名称">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label rigth-label" for="category-sort_order">排序</label>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="group_sort_order" name="group_sort_order" value="0"
                               placeholder="请输入排序 0 ~ 1000">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label rigth-label" for="category-sort_order"></label>
                    <div class="col-lg-7">
                        <button type="button" class="btn btn-success" onclick="saveMenuGroup();">保存</button>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
<script>
    //保存菜单组
    function saveMenuGroup() {
        if ($('#group_name').val().length < 1) {
            alert('请输入分类名称');
        }
        $.ajax({
            url: '<?php echo url_for('/appearance/menu.php?action=addgroup'); ?>',
            data: {group_name: $('#group_name').val(), sort_order: $('#group_sort_order').val()},
            dataType: 'json',
            type: 'post',
            success: function (data) {
                if(data.status=='success'){
                    $('#menu_group_add_li').before('<a class="nav-link" href="<?php echo url_for('/appearance/menu.php?menu='); ?>'+data.group_id+'" >'+data.group_name+'</a>');
                }
            }
        });
    }
    </script>
    <?php get_footer(); ?>

