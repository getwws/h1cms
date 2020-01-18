<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <input type="hidden" id="menu_id"  name="menu_id" value="<?php echo $menu->menu_id;?>" />
            <div class="form-group row required">
                <label class="col-lg-3 col-form-label rigth-label" for="menu_title">菜单名称</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="menu_title" name="menu_title" value="<?php echo $menu->title;?>"
                           placeholder="请输入菜单名称">
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-lg-3 col-form-label rigth-label" for="menu_url">链接</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="menu_url" name="menu_url" value="<?php echo $menu->url;?>"
                           placeholder="请输入菜单名称">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label rigth-label" for="menu_sort_order">排序</label>
                <div class="col-lg-7">
                    <input type="text" class="form-control" id="menu_sort_order" name="menu_sort_order" value="<?php echo $menu->sort_order;?>"
                           placeholder="请输入排序 0 ~ 1000">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-lg-3 col-form-label rigth-label" ></label>
                <div class="col-lg-7">
                    <button type="button" class="btn btn-success" onclick="changeMenu();">保存</button>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    var _modal_name = '<?php echo $modal;?>';
    function changeMenu(){
        var reqData = {
            mid:$('#menu_id').val(),
            menu_title:$('#menu_title').val(),
            menu_url:$('#menu_url').val(),
            menu_sort_order:$('#menu_sort_order').val()
        };
        $.post('<?php echo url_for('/appearance/menu.php?action=edit') ?>',reqData,function(data){
            $('#'+_modal_name).modal('hide');
            swal(data);
            menu_list();
        });
    }
</script>