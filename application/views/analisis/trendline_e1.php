		
     <div class="feed-box">
     <form class="form-horizontal" method="post" id="form_trendline_e1">
        <section class="panel tab-bg-form">
            <div class="panel-body">
               
                <div class="corner-ribon blue-ribon">
                   <i class="fa fa-cog"></i>
                </div>
                
                <div class="row" id="boxcartscrool">
                	<div class="col-sm-5">
                    	<p class="text-primary"><b>Periode Renstra</b></p>
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Unit Kerja  <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select name="unit_kerja" id="unit_kerja_g1" class="populate" style="width:100%">
                                    <option value="">Pilih Unit Kerja</option>
                                    <?php foreach($esselon1 as $es1): ?>
                                        <option value="<?=$es1->kode_e1?>"><?=$es1->nama_e1?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Periode renstra  <span class="text-danger">*</span></label>
                            <div class="col-sm-7">
                                <select name="renstra" id="renstra_g1" class="populate" style="width:100%">
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-5 control-label">Rentang Tahun <span class="text-danger">*</span></label>
                            <div class="col-sm-3">
                                <select name="tahun1" id="tahun1_g1" class="populate" style="width:100%">
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select name="tahun2" id="tahun2_g1" class="populate" style="width:100%">
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-4">
                    	
                        <p class="text-primary"><b>Sasaran Program dan Indikator</b></p>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Sasaran <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="sasaran" id="sasaran_g1" class="populate" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Indikator <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select name="indikator" id="indikator_g1" class="populate" style="width:100%">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Satuan</label>
                            <div class="col-sm-8">
                                <label class="control-label" id="satuan_g1"></label>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="col-sm-3">
                    	
                        <p class="text-primary"><b>Simulasi Pencapaian</b></p>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Tahun</label>
                            <div class="col-sm-9">
                                <div id="spinnerg1">
                                    <div class="input-group" style="width:150px;">
                                        <div class="spinner-buttons input-group-btn">
                                            <button type="button" class="btn spinner-up btn-primary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <input type="text" name="tahun" class="spinner-input form-control" maxlength="4" readonly>
                                        <div class="spinner-buttons input-group-btn">
                                            <button type="button" class="btn spinner-down btn-warning">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Target</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control input-sm" name="target" value="100">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <hr />
                <div class="row">
                	
                    <div class="col-sm-2">
                    	<div class="checkbox">
                            <label class="control-label">
                                <input name="trendline" value="ok" type="checkbox" checked="checked"> Tampilkan trendline
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="checkbox">
                            <label>
                                <input name="targetline" value="ok" type="checkbox" checked="checked"> Tampilkan targetline
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                    
                    	<button type="submit" class="btn btn-info" id="proses-c1">
                            <i class="fa fa-arrow-circle-right"></i> Tampilkan Grafik
                        </button>
                    </div>
                    
                </div>
                
            </div>
        </section>
    </form>
    </div>
    
    <div class="alert alert-info hide" id="box-chart1">
    </div>
            
    <script type="text/javascript">
			
			$(document).ready(function() {
				$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
				$('#spinnerg1').spinner({value:2014, min: 2000, max: 3000});
				$('#unit_kerja_g1').change(function(){
					kd_unit	= $('#unit_kerja_g1').val();
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_renstra/"+kd_unit,
						success:function(result) {
							$('#renstra_g1').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#renstra_g1').append(new Option(result[a],result[a]));
							}
							$('#renstra_g1').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#renstra_g1').change(function(){
					kd_unit	= $('#unit_kerja_g1').val();
					renstra = $('#renstra_g1').val();
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_tahun/"+kd_unit+'/'+renstra,
						success:function(result) {
							$('#tahun1_g1').empty();
							$('#tahun2_g1').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#tahun1_g1').append(new Option(result[a],result[a]));
								$('#tahun2_g1').append(new Option(result[a],result[a]));
							}
							$('#tahun1_g1').select2({minimumResultsForSearch: -1, width:'resolve'});
							$('#tahun2_g1').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#tahun2_g1').change(function(){
					kd_unit	= $('#unit_kerja_g1').val();
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_sasaran/"+kd_unit,
						success:function(result) {
							$('#sasaran_g1').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#sasaran_g1').append(new Option(result[a].deskripsi,result[a].kode));
							}
							$('#sasaran_g1').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#sasaran_g1').change(function(){
					kd_unit	= $('#unit_kerja_g1').val();
					sasaran	= $('#sasaran_g1').val();
					
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_indikator/"+kd_unit+"/"+sasaran,
						success:function(result) {
							$('#indikator_g1').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#indikator_g1').append(new Option(result[a].deskripsi,result[a].kode));
							}
							$('#indikator_g1').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#indikator_g1').change(function(){
					kd_unit		= $('#unit_kerja_g1').val();
					indikator	= $('#indikator_g1').val();
					
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_satuan/"+kd_unit+"/"+indikator,
						success:function(result) {
							$('#satuan_g1').html(result);
						}
					});
				});
				
				 var options = { 
						target : '#box-chart1',
						url : '<?=base_url()?>analisis/trendline/proses_e1',
						type : 'post',
						beforeSubmit:  showProcess,
						//success:     showResponse
    				}; 
				$('#form_trendline_e1').submit(function() { 
					$(this).ajaxSubmit(options);
					return false; 
				}); 
			});
			
			function showProcess() { 
				$('#box-chart1').removeClass("hide");
				return true; 
			} 
				
		</script>