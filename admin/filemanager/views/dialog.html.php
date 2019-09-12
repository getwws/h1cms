<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-7">
                    <button type="button" onclick="fm_open_dir('<?php echo $parent_path;?>');" data-toggle="tooltip" title="" id="btn-parent" class="btn btn-default" data-original-title="返回上一级"><i class="fa fa-level-up"></i></button>
                    <a href="<?php echo url_for('/filemanager/dialog.php',['path'=>$path,'modal'=>$modal]); ?>" data-toggle="tooltip" title="" id="btn-refresh" class="btn btn-default" data-original-title="刷新"><i class="fa fa-refresh"></i></a>
                    <button type="button" data-toggle="tooltip" title="" id="btn-upload" class="btn btn-primary" data-original-title="上传文件"><i class="fa fa-upload"></i></button>
                    <button type="button" data-toggle="tooltip" title="" id="btn-folder" class="btn btn-default" data-original-title="创建文件夹"><i class="fa fa-folder"></i></button>
                    <button type="button" data-toggle="tooltip" title="" id="btn-delete" class="btn btn-danger" data-original-title="删除"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="col-sm-5">
<!--                    <div class="input-group">-->
<!--                        <input type="text" name="search" value="" placeholder="Search.." class="form-control">-->
<!--                        <span class="input-group-btn">-->
<!--                        <button type="button" data-toggle="tooltip" title="" id="button-search" class="btn btn-primary" data-original-title="Search"><i class="fa fa-search"></i></button>-->
<!--                        </span></div>-->
                </div>
            </div>
            <hr/>

            <div class="row">
                <?php foreach($dir_files as $entry){ ?>
                <div class="col-sm-3 col-xs-6 text-center">
                        <?php if($entry['type']=='dir'){ ?>
                            <a href="javascript:fm_open_dir('<?php echo $entry['path'];?>');" class="directory">
                            <i class="fa fa-folder fa-5x"></i>
                        <?php } ?>
                        <?php if($entry['type']=='file' && !$entry['is_image']){ ?>
                            <a href="javascript:fm_selected('<?php echo $entry['path'];?>');" class="file">
                            <i class="fa fa-file fa-5x"></i>
                        <?php } ?>
                        <?php if($entry['type']=='file' && $entry['is_image']){ ?>
                        <a href="javascript:fm_selected('<?php echo $entry['path'];?>',<?php echo $entry['thumb'];?>);" class="thumbnail">
                            <img src="<?php echo $entry['thumb'];?>" alt="<?php echo $entry['name'];?>" title="<?php echo $entry['name'];?>" class="img-thumbnail" />
                            <?php } ?>
                    </a>
                    <br/>
                    <label><input type="checkbox" name="fm_path[]" value="<?php echo $entry['path'];?>">
                        <?php echo $entry['name'];?></label>
                </div>
                <?php } ?>
            </div>
            <script>
                $('[data-toggle="tooltip"]').tooltip();
                var _modal = '<?php echo $modal;?>';
                var _target = '<?php echo $target;?>';
                var _thumb = '<?php echo $thumb;?>';
                function fm_open_dir(_path){
                    $('#'+_modal).load('<?php echo url_for('/filemanager/dialog.php'); ?>',{path:_path,modal:_modal,target:_target,thumb:_thumb});
                    $('[data-toggle="tooltip"]').tooltip('hide');
                }
                function fm_selected(path,thumb){
                    if($('input[name="'+_target+'"]').length>0){
                        $('input[name="'+_target+'"]').val(path);
                    }
                    if($('#'+_thumb).length>0){
                        $('#'+_thumb).val(thumb);
                    }
                    $('#'+_modal).modal('hide');
                }
                $('#btn-refresh').on('click', function(e) {
                    e.preventDefault();
                    $('#'+_modal).load($(this).attr('href'));
                    $(this).tooltip('hide');
                });
                $('#'+_modal + ' #btn-delete').on('click', function(e) {
                    if (confirm('确定删除吗?')) {
                        $.ajax({
                            url: '<?php echo url_for('/filemanager/dialog.php?action=delete'); ?>',
                            type: 'post',
                            dataType: 'json',
                            data: $('input[name^=\'fm_path\']:checked'),
                            beforeSend: function() {
                                $('#btn-delete').prop('disabled', true);
                            },
                            complete: function() {
                                $('#btn-delete').prop('disabled', false);
                            },
                            success: function(json) {
                                if (json['code']==1) {
                                    alert(json['message']);
                                }

                                if (json['code']==0) {
                                    alert(json['message']);
                                    $('#btn-refresh').trigger('click');
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    }
                    $(this).tooltip('hide');
                });
                $('#btn-folder').on('click',function(){
                    // APP.create_modal('创建目录','create_dir_modal');
                    // $('#create_dir_modal').modal('show');
                    var dir_name = prompt("请输入目录名称");
                    if(dir_name){
                        $.ajax({
                            url:'<?php echo url_for('/filemanager/dialog.php?action=createdir',['path'=>$path]); ?>',
                            type:'post',
                            dataType:'json',
                            data:{folder:encodeURIComponent(dir_name)},
                            success: function(data) {
                                if(data['code'] == 0){
                                    $('#btn-refresh').trigger('click');
                                }else{
                                    alert('目录创建失败');
                                }
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                            }
                        });
                    }
                });
                // $('#btn-folder').on('shown.bs.popover', function() {
                //     $('#btn-create').on('click', function() {
                //         $.ajax({
                //             url: '',
                //             type: 'post',
                //             dataType: 'json',
                //             data: 'folder=' + encodeURIComponent($('input[name=\'folder\']').val()),
                //             beforeSend: function() {
                //                 $('#btn-create').prop('disabled', true);
                //             },
                //             complete: function() {
                //                 $('#btn-create').prop('disabled', false);
                //             },
                //             success: function(json) {
                //                 if (json['error']) {
                //                     alert(json['error']);
                //                 }
                //
                //                 if (json['success']) {
                //                     alert(json['success']);
                //
                //                     $('#button-refresh').trigger('click');
                //                 }
                //             },
                //             error: function(xhr, ajaxOptions, thrownError) {
                //                 alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                //             }
                //         });
                //     });
                // });

            </script>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
    </div>
</div>