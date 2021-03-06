<div class="feed-box">
        <section class="panel tab-bg-form">
            <div class="panel-body">
               
                <div class="corner-ribon blue-ribon">
                   <i class="fa fa-cog"></i>
                </div>
                <form class="form-horizontal" role="form">
                        
                    <div class="form-group">
                        <label class="col-md-2 control-label">Periode Renstra <span class="text-danger">*</span></label>
                        <div class="col-md-3">
                         		<?=form_dropdown('tahun',$renstra,'0','id="misi-tahun" class="populate"')?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Unit Kerja Eselon I <span class="text-danger">*</span></label>
                        <div class="col-md-6">
                       <?=form_dropdown('kode_e1',array("0"=>"Pilih Unit Kerja Eselon I"),'0','id="misi-kode_e1" class="populate"')?>
                        </div>
                    </div>
					  <div class="form-group">
                        <label class="col-md-2 control-label">Unit Kerja Eselon II</label>
                        <div class="col-md-6">
                       <?=form_dropdown('kode_e2',array("0"=>"Semua Unit Kerja Eselon II"),'','id="misi-kode_e2" class="populate"')?>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                        <button type="button" class="btn btn-info" id="misi-btn" style="margin-left:15px;">
                            <i class="fa fa-play"></i> Tampilkan Data
                        </button>
                    </div>		
                </form>
            </div>
        </section>
    </div>

 	<div id="misi_es2_konten" class="hide">
    	
        <div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                     <a href="#misiModal" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;" onclick="misi_add();"><i class="fa fa-plus-circle"></i> Tambah</a>
                 </div>
            </div>
        </div>
        <br />
        
        <div class="adv-table">
        <table  class="display table table-bordered table-striped" id="misi-tbl">
        <thead>
        <tr>
        	<th>Unit Kerja</th>
            <th>No</th>
            <th>Kode</th>
            <th>Misi</th>
            <th width="10%">Aksi</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
        </div>
    </div>
    
    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="misiModal" class="modal fade">
        <div class="modal-dialog">
        <form method="post" id="misi_form" class="form-horizontal bucket-form" role="form">    
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h5 class="modal-title" id="misi_title"></h5>
                </div>
                <div class="modal-body" id="misi_konten">
                </div>
                <div class="modal-footer">
                	<div class="pull-right">
                		<button type="button" id="btnmisi-close" class="btn btn-danger" data-dismiss="modal" class="close">Batalkan</button>
                    	<button type="submit" id="btnmisi-save" class="btn btn-info">Simpan</button>
                	</div>
                </div>
            </div>
        </form>
        </div>
    </div>
    
<style type="text/css">
	select {width:100%;}
</style>

<script type="text/javascript">
	$(document).ready(function() {
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		
		$("#misi-tahun").change(function(){
			$.ajax({
				url:"<?php echo site_url(); ?>laporan/renstra_eselon2/get_list_eselon1/"+this.value,
				success:function(result) {
					
					$('#misi-kode_e1').empty();
					result = JSON.parse(result);
					for (k in result) {
						$('#misi-kode_e1').append(new Option(result[k],k));
					}
					$("#misi-kode_e1").select2("val", "0");
					$("#misi-kode_e1").change();
				}
			});
		}); 
		
		$("#misi-kode_e1").change(function(){
			$.ajax({
				url:"<?php echo site_url(); ?>laporan/renstra_eselon2/get_list_eselon2/"+$("#misi-tahun").val()+"/"+this.value,
				success:function(result) {
					kode_e2=$("#misi-kode_e2");
					kode_e2.empty();
					result = JSON.parse(result);
					for (k in result) {
						kode_e2.append(new Option(result[k],k));
					}
					kode_e2.select2({minimumResultsForSearch: -1, width:'resolve'});
				}
			});
		});
		
		$("#misi-btn").click(function(){
			tahun = $('#misi-tahun').val();
			kode_e1 = $('#misi-kode_e1').val();
			kode_e2 = $('#misi-kode_e2').val();
			if (tahun=="0") {
				alert("Periode Renstra belum ditentukan");
				$('#misi-tahun').select2('open');
			}
			else if (kode_e1=="0") {
				alert("Unit Kerja Eselon I belum ditentukan");
				$('#misi-kode_e1').select2('open');
			}
			else {
				$.ajax({
                    url:"<?php echo site_url(); ?>perencanaan/rencana_eselon2/get_body_misi/"+tahun+"/"+kode_e1+"/"+kode_e2,
                        success:function(result) {
                            table_body = $('#misi-tbl tbody');
                            table_body.empty().html(result);        
                            $('#misi_es2_konten').removeClass("hide");
                        }
                });  
			}
		});
		misi_add =function(){
			$("#misi_title").html('<i class="fa fa-plus-square"></i> Tambah Misi Eselon II');
			$("#misi_form").attr("action",'<?=base_url()?>perencanaan/rencana_eselon2/save/misi');
			$.ajax({
				url:'<?=base_url()?>perencanaan/rencana_eselon2/add/misi',
					success:function(result) {
						$('#misi_konten').html(result);
					}
			});
		}
		misi_edit =function(tahun,kode){
			$("#misi_title").html('<i class="fa fa-pencil"></i> Edit Misi Eselon II');
			$("#misi_form").attr("action",'<?=base_url()?>perencanaan/rencana_eselon2/update');
			$('#misi_konten').html("");
			$.ajax({
				url:'<?=base_url()?>perencanaan/rencana_eselon2/edit/misi/'+tahun+'/'+kode,
					success:function(result) {
						$('#misi_konten').html(result);
					}
			});
		}
		misi_delete = function(tahun,kode){
			var confir = confirm("Anda yakin akan menghapus data ini ?");
			
			if(confir==true){
				$.ajax({
					url:'<?=base_url()?>perencanaan/rencana_eselon2/hapus/misi/'+tahun+'/'+kode,
						success:function(result) {
							$.gritter.add({text: result});
							$("#misi-btn").click();
						}
				});
			}
		}
		$("#misi_form").submit(function( event ) {
			
			var tahun 	= $('#form-e2-tahun-misi').val();
			var e1		= $('#form-e1-misi').val();
			var e2		= $('#form-e2-misi').val();
			var kdm		= $('#form-e2-kode-misi').val();
			var misi	= $('#form-e2-data-misi').val();
			
			if(tahun==""){
				alert("Periode Renstra belum ditentukan");
				return false;
			}else if(e1==""){
				alert("Nama unit kerja eselon I belum ditentukan");
				return false;
			}else if(e2=="0"){
				alert("Nama unit kerja eselon II belum ditentukan");
				return false;
			}else if(kdm==""){
				alert("Kode Misi belum ditentukan");
				return false;
			}else if(misi==""){
				alert("Misi belum ditentukan");
				return false;
			}else{
				
				var postData = $(this).serializeArray();
				var formURL = $(this).attr("action");
					$.ajax({
						url : formURL,
						type: "POST",
						data : postData,
						success:function(data, textStatus, jqXHR) 
						{
							//data: return data from server
							$.gritter.add({text: data});
							$('#btnmisi-close').click();
							$("#misi-btn").click();
						},
						error: function(jqXHR, textStatus, errorThrown) 
						{
							//if fails
							$.gritter.add({text: '<h5><i class="fa fa-exclamation-triangle"></i> <b>Eror !!</b></h5> <p>'+errorThrown+'</p>'});
							$('#btnmisi-close').click();
						}
					});
				  event.preventDefault();
			}
		});
	})
</script>	                                                            