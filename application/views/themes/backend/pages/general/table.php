                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Primary box -->
                            <div class="box box-primary">
                                <div class="box-header" data-toggle="tooltip">
                                    <h3 class="box-title">Table <?php echo $title; ?></h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-primary btn-xs" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-xs" data-widget="remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body table-responsive">
                                    <!--notice success-->
                                    <?php
                                    if($this->session->flashdata('notif-success')):
                                    ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Success!</b> <?php echo $this->session->flashdata('notif-success'); ?>
                                    </div>
                                    <?php endif ?>
                                    <!--notice error-->
                                    <?php
                                    if($this->session->flashdata('notif-error')):
                                    ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <b>Error!</b> <?php echo $this->session->flashdata('notif-error'); ?>
                                    </div>
                                    <?php endif ?>
                                    <!--button add data-->
                                    <p><a class="btn btn-primary" href="<?php echo site_url($path_add);?>">Add Data</button></a>
                                    <!--data table-->
                                    <table id="data-table" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <?php
                                                foreach($header_table as $k => $th): ?>
                                                <th><?php echo $th; ?></th>
                                                <?php endforeach; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <p>
                                    <i class="fa fa-fw fa-level-up"></i> 
                                    <a href="#" class="select-all btn btn-sm bg-navy btn-flat"><i class="ion ion-android-checkmark"></i> check</a>
                            
                                    <a href="#" class="unselect-all btn btn-sm bg-navy btn-flat"><i class="ion ion-android-remove"></i> uncheck</a>
                                   
                                    <a href="#" id="delete-all" class="btn btn-sm btn-danger btn-flat"><i class="ion ion-trash-b"></i> delete selected</a>
                                    </p>
                                </div><!-- /.box-footer-->
                            </div><!-- /.box -->
                        </div>
                    </div>
                </section><!-- /.content -->
                


 <!-- page script -->
<script type="text/javascript">
    $(document).ready(function(){

        var pathAdd = "<?php echo site_url($path_add);?>";
        
        var oTable = $('#data-table').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": '<?php echo site_url($path_table);?>',
                "bJQueryUI": false,
                "iDisplayStart ":20,
                "oLanguage": {
            "sProcessing": ""
        },
        "oLanguage": {
            "sInfo": 'Showing _END_ Sources.',
            "sInfoEmpty": 'No entries to show',
            "sEmptyTable": "No Sources found currently, <a href='"+pathAdd+"'>please add at least one.</a>",
            "sProcessing": ""
        },  
        "fnInitComplete": function() {
               // oTable.fnAdjustColumnSizing();
         },
        'fnServerData': function(sSource, aoData, fnCallback)
            {
              $.ajax
              ({
                'dataType': 'json',
                'type'    : 'POST',
                'url'     : sSource,
                'data'    : aoData,
                'success' : fnCallback
              });
            },
         "aoColumnDefs": [
            <?php echo $width_tr; ?>
            <?php echo $sort; ?>
        ]
        });

        $( document ).on( "click", ".btn-del", function() {

            var id = $(this).attr('id');
    
            swal({
               title: "Are you sure?",
               text: "Your will not be able to recover this data!",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Yes, delete it!",   
               closeOnConfirm: false 
            }, 
            function(isConfirm){

               if(isConfirm) {
                   $.ajax({
                   type: "GET",
                   url: "<?php echo site_url('sk-admin/'.$this->router->fetch_class().'/delete');?>",
                   dataType : "json",
                   data: "id="+id,
                   success: function(data){
                       if(data.status == true) {
                           swal("Deleted!", data.msg , "success"); 
                           oTable.fnDraw();
                       }else if(data.status == false) {
                           swal("Error!", data.msg, "error");
                           oTable.fnDraw();
                       }else {
                           swal("Error!", "Error System", "error"); 
                           oTable.fnDraw();
                       }
                   }
                   });
               }
            });
        });

        $('.select-all').click(function(e){
            e.preventDefault();
            $('input', oTable.fnGetNodes()).prop('checked',true);
        });

        $('.unselect-all').click(function(e){
            e.preventDefault();
            $('input', oTable.fnGetNodes()).prop('checked',false);
        });

        $('#delete-all').click(function(e) {
              e.preventDefault();
              /*
              var conf = confirm("Are you sure delete this data?");
              if(conf){
                    var idArray = $('#data-table input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                    }).get();
                
                if(idArray != ''){
                    $.post("<?php echo site_url('sk-admin/'.$this->router->fetch_class().'/delete_many');?>",{data:idArray},function(data){
                        if(data.status == true)
                        {
                            location.reload();
                        }    
                    },"json");
                }else{
                    alert('Error System. No data selected')     
                }
              }else{
                  oTable.fnDraw();
              } */
            swal({
               title: "Are you sure?",
               text: "Your will not be able to recover this data!",   
               type: "warning",   
               showCancelButton: true,   
               confirmButtonColor: "#DD6B55",   
               confirmButtonText: "Yes, delete All!",   
               closeOnConfirm: false 
            },
            function(confirm){
                if(confirm){
                    var idArray = $('#data-table input[type=checkbox]:checked').map(function(_, el) {
                    return $(el).val();
                    }).get();
                
                    if(idArray != ''){
                        $.post("<?php echo site_url('sk-admin/'.$this->router->fetch_class().'/delete_many');?>",{data:idArray},function(data){
                            if(data.status == true) {
                               swal("Deleted!", data.msg , "success"); 
                               oTable.fnDraw();
                            }else if(data.status == false) {
                               swal("Error!", data.msg, "error");
                               oTable.fnDraw();
                            }else {
                               swal("Error!", "Error System", "error"); 
                               oTable.fnDraw();
                            }  
                        },"json");
                    }else{
                        swal("Error!", "No data selected", "error");    
                    }
              }else{
                  oTable.fnDraw();
              }
            }); 
        });

    });
</script>