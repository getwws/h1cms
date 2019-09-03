<?php
register_assets_plugins('jquery-validation');
add_breadcrumb('文章管理', url_for('/product/'), '');
add_breadcrumb('分类管理', url_for('/product/'), '');
?>
<?php get_header(); ?>
<form action="" method="post" class="jq-validate form-horizontal">
<div class="page-header">
    <div class="container-fluid">
        <div class="pull-right">
            <a href="<?php echo url_for('/product/category.php'); ?>" class="btn btn-space btn-default"
               data-toggle="tooltip"><i class="fa fa-reply"></i> 返回</a>
            <button type="submit" class="btn btn-space btn-primary" data-toggle="tooltip"><i
                        class="fa fa-save"></i> 保存</button>
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



    <div class="ibox ibox-default">
        <div class="ibox-head">
            <div class="ibox-title"><i class="fa fa-edit"></i> 添加分类</div>
        </div>
        <div class="ibox-body">

            <div class="form-group row required">
                <label class="col-lg-3 col-form-label rigth-label" for="category-parent_id">上级分类</label>
                <div class="col-lg-7">
                    <select class="form-control input-sm" id="category-parent_id"
                            name="category[parent_id]">
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
                            if(empty($cat)) continue;
                            ?>
                            <option <?php ?>value="<?php echo $cat->category_id; ?>"
                                <?php echo ifOr((starts_with($cat->path, $category_basepath) && $cat->category_id == $category->category_id), 'disabled'); ?> <?php echo ifOr($cat->category_id == $category->parent_id, 'selected'); ?>><?php echo join(' > ', $path); ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-lg-3 col-form-label rigth-label" for="language-title">分类名称</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="language-title"
                           name="language[title]"
                           value="<?php echo $language->title; ?>" placeholder="请输入分类名称">
                </div>
            </div>
            <div class="form-group row ">
                <label class="col-lg-3 col-form-label rigth-label" for="language-description">分类描述</label>
                <div class="col-lg-7">
                        <textarea rows="3" class="form-control" id="language-description"
                                  name="language[description]"
                                  value="<?php echo $language->description; ?>"
                                  placeholder="请输入分类描述"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label rigth-label" for="category-sort_order">排序</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="category-sort_order"
                           name="category[sort_order]"
                           value="<?php echo $category->sort_order ? $category->sort_order : 0; ?>"
                           placeholder="请输入排序 0 ~ 1000">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label rigth-label" for="category-status-1">分类状态</label>
                <div class="col-lg-7 pt-2">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="category-status-1" name="category[status]"
                               value="1" <?php echo ($category->status === 1 || is_null($category->status)) ? 'checked' : ''; ?> >
                        <label class="custom-control-label" for="category-status-1">启用</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" class="custom-control-input" id="category-status-2" name="category[status]"
                               value="0" <?php echo $category->status === 0 ? 'checked' : ''; ?> >
                        <label class="custom-control-label" for="category-status-2">禁用</label>
                    </div>
                </div>
            </div>


        </div>
    </div>


</form>


<script>
    function page_end() {
        jquery_validator({
            'language[title]': {
                required: true
            },
            "category[sort_order]": {
                digits: true
            }
        }, {
            'language[title]': {
                required: '请输入分类名称'
            },
            'category[sort_order]': {
                digits: '排序只能输入数字 0~100000'

            }
        })

    }
</script>
<?php get_footer(); ?>

