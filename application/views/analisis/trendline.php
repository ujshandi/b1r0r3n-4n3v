
    <section id="main-content" class="">
        <section class="wrapper">
        
        	<div class="row">
                <div class="col-lg-12">
                        
                        <section class="panel">
                            <header class="panel-heading">
                                <b>Analisis trendline capaian indikator sasaran strategis dan program</b>
                            </header>
                            <div class="panel-body">
                                
                                <div class="row">
                                	<div class="col-sm-2">
                                    	Unit Kerja
                                    </div>
                                    <div class="col-sm-10">
                                    	<select name="unit_kerja" id="unit_kerja" class="populate" style="width:100%">
                                        	<option value="">Pilih Unit Kerja</option>
                                        	<?php foreach($kl as $k): ?>
                                            	<option value="<?=$k->kode_kl?>"><?=$k->nama_kl?></option>
                                            <?php endforeach; ?>
                                            <?php foreach($esselon1 as $es1): ?>
                                            	<option value="<?=$es1->kode_e1?>"><?=$es1->nama_e1?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                
                                	<div class="col-sm-4">
                                    	
                                        <div class="well wellform">
                                        	<form class="form-horizontal">
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Tahun</label>
                                                <div class="col-sm-9">
                                                    <select name="tahun" id="tahun" class="populate" style="width:100%">
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            <p class="text-primary"><b>Sasaran dan Indikator</b></p>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Sasaran</label>
                                                <div class="col-sm-9">
                                                    <select name="sasaran" id="sasaran" class="populate" style="width:100%">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Indikator</label>
                                                <div class="col-sm-9">
                                                    <select name="indikator" id="indikator" class="populate" style="width:100%">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Satuan</label>
                                                <div class="col-sm-9">
                                                    <label class="control-label" id="satuan"></label>
                                                </div>
                                            </div>
                                            
                                            
                                            <p class="text-primary"><b>Simulasi Pencapaian</b></p>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Tahun</label>
                                                <div class="col-sm-9">
                                                    <div id="spinner4">
                                                        <div class="input-group" style="width:150px;">
                                                            <div class="spinner-buttons input-group-btn">
                                                                <button type="button" class="btn spinner-up btn-primary btn-sm">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" class="spinner-input form-control input-sm" value="2014">
                                                            <div class="spinner-buttons input-group-btn">
                                                                <button type="button" class="btn spinner-down btn-warning btn-sm">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Target</label>
                                                <div class="col-sm-9">
                                                    <div id="spinner4">
                                                        <div class="input-group" style="width:150px;">
                                                            <div class="spinner-buttons input-group-btn">
                                                                <button type="button" class="btn spinner-up btn-primary btn-sm">
                                                                    <i class="fa fa-plus"></i>
                                                                </button>
                                                            </div>
                                                            <input type="text" class="spinner-input form-control input-sm" value="1400">
                                                            <div class="spinner-buttons input-group-btn">
                                                                <button type="button" class="btn spinner-down btn-warning btn-sm">
                                                                    <i class="fa fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <hr />
                                        	<div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked="checked"> Tampilkan trendline
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <input type="checkbox" checked="checked"> Tampilkan targetline
                                                </label>
                                            </div> 
                                            <br />
                                            <div class="row">
                                            	<button type="button" class="btn btn-warning btn-block">
                                                	<i class="fa fa-play"></i> Tampilkan Grafik
                                            	</button>
                                            </div>
                                                                                   
                                            </form>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="col-sm-8">
                                    	
                                        <div class="well wellform">
                                        	
                                            <div id="chartKonten">
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
    
                            </div>
                        </section>
    
                </div>
        	</div>
            
        </section>
    </section>
    <script type="text/javascript">
				
			var chart;
			$(document).ready(function() {
				$('select').select2({minimumResultsForSearch: -1, width:'resolve'});
				$('#unit_kerja').change(function(){
					kd_unit	= $('#unit_kerja').val();
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_tahun/"+kd_unit,
						success:function(result) {
							$('#tahun').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#tahun').append(new Option(result[a],result[a]));
							}
							$('#tahun').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#tahun').change(function(){
					kd_unit	= $('#unit_kerja').val();
					tahun	= $('#tahun').val();
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_sasaran/"+kd_unit+"/"+tahun,
						success:function(result) {
							$('#sasaran').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#sasaran').append(new Option(result[a].deskripsi,result[a].kode));
							}
							$('#sasaran').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#sasaran').change(function(){
					kd_unit	= $('#unit_kerja').val();
					tahun	= $('#tahun').val();
					sasaran	= $('#sasaran').val();
					
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_indikator/"+kd_unit+"/"+tahun+"/"+sasaran,
						success:function(result) {
							$('#indikator').empty();
							result = JSON.parse(result);
							for (a in result) {
								$('#indikator').append(new Option(result[a].deskripsi,result[a].kode));
							}
							$('#indikator').select2({minimumResultsForSearch: -1, width:'resolve'});
						}
					});
				});
				
				$('#indikator').change(function(){
					kd_unit		= $('#unit_kerja').val();
					tahun		= $('#tahun').val();
					indikator	= $('#indikator').val();
					
					$.ajax({
						url:"<?=site_url()?>analisis/trendline/get_satuan/"+kd_unit+"/"+tahun+"/"+indikator,
						success:function(result) {
							$('#satuan').html(result);
						}
					});
				});
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'chartKonten',
						options3d: {
							enabled: true,
							alpha: 15,
							beta: 15,
							viewDistance: 25,
							depth: 40
						},
						marginTop: 100,
						marginRight: 40,
					},
					colors: ['#DB843D', '#3D96AE', '#89A54E', '#00FF40', '#E10000', '#CCCCCC'],
					exporting: {
						buttons: { 
							exportButton: {
								enabled:false
							},
							printButton: {
								enabled:true,
								verticalAlign : 'top',
								y: '350'
							}
					
						}
					},
					title: {
						text: 'Jumlah Kejadian Kecelakaan Transportasi Nasional Yang Disebabkan Oleh Faktor Yang Terkait Dengan Kewenangan Kementerian Perhubungan',
						style : { "font-size" : "12px" }
					},
					subtitle: {
						text: 'Tahun 2014',
						style : { "font-size" : "12px" }
					},
					xAxis: {
						categories: ['2010', '2011', '2012', '2013', '2014']
					},
					yAxis: {
						title: {
							text: ''
						}
					},
					tooltip: {
						formatter: function() {
							var s;
							if (this.point.name) { // the pie chart
								s = ''+
									this.point.name +': '+ this.y +'';
							} else {
								s = this.series.name+' tahun '+this.x  +': '+ this.y;
							}
							return s;
						}
					},
					plotOptions: {
						spline: {
							marker: {
								enabled: false
							},
						}
					},
					series: [{
						type: 'column',
						name: 'Target',
						data: [300, 600, 900, 1200]
					}, {
						type: 'column',
						name: 'Realisasi',
						data: [400, 700, 800, 1100] 
					},{
						type: 'column',
						name: 'Simulasi',
						data: [null,null,null,null,1400]
					}, {
						type: 'spline',
						name: 'Trendline',
						data: [300, 500, 700, 1000, 1200]
					}, {
						type: 'spline',
						name: 'Targetline',
						data: [400, 700, 900, 1000, 1300]
					}, {
						type: 'spline',
						name: 'Target',
						data: [1400, 1400, 1400, 1400, 1400]
					}]
				});
				
				
			});
				
		</script>