   <script type="text/javascript">
   $(function() {
                //instance tokenfield input
                //$('#keyword').tokenfield();
                
                // instance, using default configuration.
                CKEDITOR.replace('content');
                CKEDITOR.instances['content'].on('change', function() { CKEDITOR.instances['content'].updateElement() });
                
                //submit form
                $("#form-post").submit(function(event){
                    event.preventDefault();
                })

            });
   </script>
   <!-- Main content -->
   <section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Primary box -->
            <div class="box box-solid box-primary">
                <div class="box-header">
                    <h3 class="box-title">Form post</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <?php if($check == 'valid'): ?>
                    <!--form-->
                    <form role="form" id="form-post" method="POST" action="<?php echo site_url('sk-admin/post/save');?>" data-id="<?php echo $post_id;?>">
                        <input type="hidden" name="post-id" value="<?php echo $post_id; ?>" id="post-id">
                        <!--form element-->

                        <div class="form-group">
                            <label>Title <small class="text-red">*</small></label>
                            <input type="text" name="title" value="<?php echo $post_title; ?>" class="form-control" placeholder="Judul"/>
                        </div>
                        <div class="form-group">
                            <label>Keyword/Tag <small class="text-red">*</small></label>
                            <input type="text" name="keyword" value="" id="keyword" class="form-control" placeholder="Tag" data-populate="<?php echo $tags; ?>"/>
                        </div>
                        <div class="form-group"><label>Categories</label></div>
                        <div class="form-group">
                            <?php
                            $i = 1;
                            if($list_category != NULL):
                                foreach($list_category as $cat):
                                    if(in_array($cat->category_id, $categories)):
                                        ?> 
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="category-checkbox" name="category[]" value="<?php echo $cat->category_id;?>" checked> <?php echo $cat->category_name;?>
                                    </label>
                            <?php else: ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" class="category-checkbox" name="category[]" value="<?php echo $cat->category_id;?>"> <?php echo $cat->category_name;?>
                                    </label>
                            <?php
                                  if($i%8 == 0):
                                    echo "</div>";
                                    echo "<div class='form-group'>";
                                  endif;
                                  ++$i;
                                  endif;
                                endforeach;
                            endif;
                            ?>
                        </div>
                        <div class="form-group">
                            <label>Content <small class="text-red">*</small></label>
                            <textarea name="content" class="form-control" rows="3" id="content"><?php echo $content; ?></textarea>
                        </div>
                        <?php if(empty($post_id)): ?>
                        <div class="form-group">
                            <label for="picture">Picture</label>
                            <input name="picture" type="file">
                            <p class="text-success">best sizes : 800px x 360px</p>
                        </div>
                        <?php 
                        elseif(!empty($post_id && !empty($picture))):
                            echo '<div class="form-group">';
                        echo '<label>Picture/Photo</label><br>';
                        echo '<p class="text-primary"><a href="'.site_url('sk-admin/post/change-picture/'.$post_id).'" data-toggle="tooltip" data-placement="top" title="change picture"><img src="'.base_url('uploads/img/blogs/full/'.$picture).'"></a></p>';
                        echo '</div>';
                        else:
                            echo '<p><a href="'.site_url('sk-admin/post/change-picture/'.$post_id).'" data-toggle="tooltip" data-placement="top" title="change-picture">No Picture</a>';
                        endif; ?>
                        <div class="form-group">
                            <label>Select Status</label>
                            <select class="form-control" name="status">
                                <?php 
                                $publish = ($status == 'publish') ? 'selected': '';
                                $draft   = ($status == 'draft') ? 'selected' : '';
                                ?>
                                <option value="publish" <?php echo $draft;?>>Draft</option>
                                <option value="publish" <?php echo $publish;?>>Publish</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Linked Posts </label>
                            <input type="text" name="related" value="" id="related" class="form-control">
                        </div>
                        <div class="form-group">
                            <table class="table">
                                <tbody id="table-post">
                            <?php 
                                if(isset($linkedpost)):
                                if($linkedpost != NULL):
                                foreach($linkedpost as $row):
                                ?>
                                    <tr>
                                        <td><input type="hidden" name="related-post[]" value="<?php echo $row->id;?>"> <?php echo $row->title;?></td>
                                        <td align="right"><button type="button" class="btn btn-danger del-row" id="<?php echo $row->id;?>"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                <?php
                                endforeach;
                                endif;
                                endif;
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <br />
                        <div class="row">
                            <!--notif success form-->
                            <div class="col-xs-12">
                                <div class="alert alert-success alert-dismissable" id="success-form-post" style="display: none">

                                </div>
                            </div>
                            <!--end notif success form-->
                            <!--notif error form-->
                            <div class="col-xs-12">
                                <div class="alert alert-danger alert-dismissable" id="error-form-post" style="display :none">

                                </div>
                            </div>
                            <!--end notif error form-->
                            <button type="submit" name="submit" value="0" class="btn btn-success btn-flat"><?php echo $btn_submit; ?></button>
                            <button type="submit" name="submit" value="1" class="btn btn-primary btn-flat"><?php echo $btn_submit; ?> and go back list</button>
                            <a href="<?php echo site_url('sk-admin/'.$this->router->fetch_class());?>" class="btn btn-warning btn-flat">Cancel</a>
                        </form><!--end-form-->
                        <?php
                        else:
                            echo '<h4>Data tidak ditemukan!';
                        endif;
                        ?>
                    </div>
                    <!-- Loading (remove the following to stop the loading)-->
                    <div class="overlay" style="display: none" id="overlay-load"></div>
                    <div class="loading-img" id="animate-load"style="display:none"></div>
                    <!-- end loading -->
                </div><!-- /.box -->
            </div>
        </div>
    </section><!-- /.content -->

    <!-- submit form-->

    <script>
    $(document).ready(function(){

      $('#keyword').tokenInput(
          "<?php echo site_url('sk-admin/post/tag_list');?>", { 
              theme: "facebook",
              hintText: "Know of exist tags?",
              noResultsText: "Nothin' found.",
              searchingText: "Tags...",
              preventDuplicates: true,
              prePopulate: $("#keyword").data('populate'),
          }); 

      $('#related').tokenInput(
          "<?php echo site_url('sk-admin/post/post_list');?>"+'/'+$("#form-post").data('id'), { 
              theme: "facebook",
              hintText: "Know of exist posts?",
              noResultsText: "Nothin' found.",
              searchingText: "Posts...",
              minChars: 3,
              preventDuplicates: true,
              onAdd: function (item) {


               var row   = '<tr>';
               row  += '<td><input type="hidden" name="related-post[]" value='+item.id+'> '+item.name+'</td>';
               row  += '<td align="right"><button type="button" class="btn btn-danger del-row" id=""><i class="fa fa-times"></i></button></td>';
               row  += '</tr>';

               $("#table-post").append(row);
               $("#related").tokenInput("clear");
            
               return false;
           },

       }); 

        $(document).on('click', 'button.del-row', function () { // <-- changes
             $(this).closest('tr').remove();
             var postID = $("#post-id").val();
             var linkedID = this.id;
             if(linkedID != null) {
                $.post("<?php echo site_url('sk-admin/post/delete_linked_post');?>", {postid: postID, linkedid: linkedID}, function(data, textStatus, xhr) {
                    /*optional stuff to do after success */
                });
             }
             return false;
        });

        $(".category-checkbox").on('ifUnchecked', function(event) {
            /* Act on the event */
            var postID     = $("#post-id").val();
            if(this.checked == false && postID != '') {
                
                var categoryID = $(this).val();
                
                $.post("<?php echo site_url('sk-admin/post/delete_category_post');?>", {postid: postID, categoryid: categoryID}, function(data, textStatus, xhr) {
                    /*optional stuff to do after success */
                });
            }
        });

      $("#form-post").submit(function(event){
        event.preventDefault();
        animateLoad();
        var formData = new FormData($(this)[0]);
        clearError();
        clearNotif();
        $.ajax({
            url:$(this).attr("action"),
            type: 'POST',
            dataType: 'json',
            data: formData,
            async: false,
            success: function (data) {
                if(data.status == false){
                    animateHide();
                    clearNotif();
                    $("#error-form-post").focus();
                    showError(data.msg);
                }else if(data.status == 'error-upload'){
                    animateHide();
                    clearNotif();
                    showError(data.msg);
                }else if(data.status == true){
                    if(data.load == 0){
                        animateHide();
                        if(data.clearForm == true){
                            resetForm($('#form-post'));
                        }
                        showNotif(data.msg);
                    }else{
                        var url = "<?php echo site_url('sk-admin/post');?>";
                        window.location.href = url;
                    }
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
   return false;
});


});

   function clearError()
   {
    $("#error-form-post").html("");
    $("#error-form-post").slideUp("fast");
}

function resetForm($form) {
    $form.find('input:text, input:password, input:file, select, textarea').val('');
    $form.find('input:radio, input:checkbox')
    .removeAttr('checked').removeAttr('selected');
}

function showError(msg){
    var icon = '<i class="fa fa-times"></i>';
    $("#error-form-post").html(icon+msg);
    $("#error-form-post").slideDown();
}

function showNotif(msg){
    icon = '<i class="fa fa-check"></i>';
    $("#success-form-post").html(icon+msg);
    $("#success-form-post").slideDown();
}

function animateLoad()
{
    $("#overlay-load").show();
    $("#animate-load").show();
}

function animateHide()
{
    $("#overlay-load").hide();
    $("#animate-load").hide();
}

function clearNotif()
{
    $("#success-form-post").html("");
    $("#success-form-post").slideUp("fast");
}
</script>