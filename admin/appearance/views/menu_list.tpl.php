<div class="row">
    <div class="col-md-4">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h2 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            自定义链接
                        </button>
                    </h2>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="col-form-label" for="node-parent_id">上级分类</label>
                            <select class="form-control input-sm" id="menu_parent_id" name="parent_id">
                                <option value="0">请选择上级分类</option>
                                <?php
                                $path = [];
                                $pid = 0;
                                $category_basepath = rtrim($category->path, "{$category->menu_id}");
                                foreach ($menu_categories as $cat) {
                                    if ($cat->parent_id != $pid) {
                                        $path = array_slice($path, 0, $cat->parent_id);
                                    }
                                    $path[$cat->parent_id] = $cat->title;
                                    $pid = $cat->parent_id;
                                    ?>
                                    <option value="<?php echo $cat->menu_id; ?>" <?php echo ifOr($cat->menu_id == $relationships->menu_id, 'selected'); ?>><?php echo join(' > ', $path); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">链接文本</label>
                            <input class="form-control" type="text" name="c_url_text" id="c_url_text" placeholder="链接文本">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">URL链接</label>
                            <input class="form-control" type="text" name="c_url_link" id="c_url_link" placeholder="http://" value="http://">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">排序</label>
                            <input class="form-control" type="text" name="sort_order" id="sort_order" value="0" />
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info" type="button" onclick="addCustomMenu();">提 交</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            分类
                        </button>
                    </h2>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            文章
                        </button>
                    </h2>
                </div>
                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" id="menu_list">
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
                            <a class="btn btn-default btn-sm" data-toggle="modal" data-target="#appearance_menu"
                               title="编辑" data-mid="<?php echo $category->menu_id; ?>" href="javascript:void(0);" ><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-default btn-sm" data-toggle="tooltip"
                               title="删除" href="javascript:void(0);"
                               onclick="delete_category('<?php echo $title; ?>',<?php echo $category->menu_id; ?>);">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php
                    if (isset($category->children) && !empty($category->children)) {
                        printtable($category->children, $category->menu_id, $path);
                    }
                }

            }//END printtable
            printtable($categories, 0, []);
            ?>
            </tbody>
        </table>
    </div>
</div>
