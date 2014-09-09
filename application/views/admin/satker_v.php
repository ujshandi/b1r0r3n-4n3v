<div class="feed-box">
        <section class="panel tab-bg-form">
            <div class="panel-body">
               
                <div class="corner-ribon blue-ribon">
                   <i class="fa fa-cog"></i>
                </div>
                <form class="form-horizontal" role="form">
                        
                    <div class="form-group">
                        <label class="col-md-2 control-label">Periode Renstra</label>
                        <div class="col-md-3">
                         		<?=form_dropdown('tahun',$tahun_renstra,'0','id="satker-tahun" class="populate" style="width:100%"')?>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-md-2 control-label">Unit Kerja Eselon I</label>
                        <div class="col-md-6">
                       <?=form_dropdown('kode_e1',$eselon1,'0','id="satker-kode_e1" class="populate" style="width:100%"')?>
                        </div>
                    </div> 
					<div class="form-group">
                        <label class="col-md-2 control-label">&nbsp;</label>
                        <button type="button" class="btn btn-info" id="satker-btn" style="margin-left:15px;">
                            <i class="fa fa-check-square-o"></i> Tampilkan Data
                        </button>
                    </div>		
                </form>
            </div>
        </section>
    </div>

<!--main content start-->
	<div class="" id="konten_es2">
    
 		<div class="row">
            <div class="col-sm-12">
                <div class="pull-right">
                     <a href="#" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;"><i class="fa fa-plus-circle"></i> Tambah</a>
                 </div>
            </div>
        </div>
        <br />
        
        <div class="adv-table">
        <table class="display table table-bordered table-striped" id="satker-tbl">
        <thead>
            <tr>
		
				<th>Tahun Renstra</th>
                <th>Kode Satker</th>
                <th>Nama Satker</th>
                <th>Lokasi</th>
                <th>Unit Kerja</th>
            </tr>
        </thead>
        <tbody>
        
            
        
        </tbody>
        </table>
        </div>
	</div>                   
    <!--main content end-->
 <script>
 
 
	$(document).ready(function(){
		$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
		
		 
		 
		$("#satker-btn").click(function(){
			var tahun = $('#satker-tahun').val();
			var kode = $('#satker-kode_e1').val();
			var columsDef =  [
					 // { "mData": "row_number", "sWidth": "5px", "bSearchable": false, "bSortable": false  },
					  { "mData": "tahun_renstra", "sWidth": "65px" },
					  { "mData": "kode_satker" , "sWidth": "70px"},
					  { "mData": "nama_satker"  },
					  { "mData": "lokasi_satker", "sWidth": "100px" },
					  { "mData": "kode_e1", "sWidth": "60px" }
					]
			load_ajax_datatable2("satker-tbl", '<?=base_url()?>admin/ekstrak_satker/getdata_satker/'+tahun+'/'+kode,columsDef,1,"desc");
		});
		
		$("#satker3-btn").click(function(){
			var oTable = $('#satker-tbl').dataTable({
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": '<?=base_url()?>admin/ekstrak_satker/getdata_satker',
				"sAjaxDataProp": "data",
				"bJQueryUI": true,
				"scrollY":        "200px",
				"scrollCollapse": true,
			//	"sPaginationType": "full_numbers",
				"iDisplayStart ": 0,
				"iDisplayLength ": 20,
				"bDestroy": true,
				"fnDrawCallback": function ( oSettings ) {
				/* Need to redo the counters if filtered or sorted */
						/*if ( oSettings.bSorted || oSettings.bFiltered )
						{
							for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
							{
								$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
							}
						}*/
					},
				"oLanguage": {
					"sProcessing": "<img src='<?php echo base_url(); ?>static/js/file-uploader/img/loading.gif'>",
					 "sEmptyTable": "Data tidak ditemukan"
				},
				"fnInitComplete": function () {
					//oTable.fnAdjustColumnSizing();
				},
				/*"sColumns": [
				
					{ "data": "tahun_renstra" },
					{ "data": "kode_satker" },
					{ "data": "nama_satker" },
					{ "data": "lokasi_satker" },
					{ "data": "kode_e1" }
				],*/
				 "aoColumns": [
					 // { "mData": "row_number", "sWidth": "5px", "bSearchable": false, "bSortable": false  },
					  { "mData": "tahun_renstra", "sWidth": "65px" },
					  { "mData": "kode_satker" , "sWidth": "70px"},
					  { "mData": "nama_satker"  },
					  { "mData": "lokasi_satker", "sWidth": "100px" },
					  { "mData": "kode_e1", "sWidth": "60px" }
					],
				 "fnServerParams": function ( aoData ) {
					  aoData.push( { "name": "more_data", "value": "my_value" } );
					},
				'fnServerData': function (sSource, aData, fnCallback) {
					$.ajax
					({
						'dataType': 'json',
						'type': 'POST',
						'url': sSource,
						'data': aData,
						'success': fnCallback
					});
				}
			});
		});
		
		$("#satker2-btn").click(function(){
			//table_satker.fnDraw();
			alert('herddde');
			 $('#satker-tbl').dataTable({
                "processing": true,
				"serverSide": true,
				"sAjaxSource":"<?=base_url()?>admin/ekstrak_satker/getdata_satker",
					
				 "bDestroy": true,
				  "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {
					oSettings.jqXHR = $.ajax({
						url: sSource,
						type: "GET",
						dataType: "json",
						timeout: 0, // prevent timeout
					//	data: aoData,
						complete:function() {
							// Conditional logic goes here for completion
						},
						success: function (json) {
							/* Do whatever additional processing you want on the callback, then tell DataTables */
						//	fnCallback(json)
						}
					});
				},
				"columns": [
					{ "data": "tahun_renstra" },
					{ "data": "kode_satker" },
					{ "data": "nama_satker" },
					{ "data": "lokasi_satker" },
					{ "data": "kode_e1" }
				]
 
           });
		});
		
		
		
		   
		
	});
</script>	   
   