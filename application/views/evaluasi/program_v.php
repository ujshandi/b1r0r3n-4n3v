
	<div class="feed-box">
        <section class="panel tab-bg-form">
            <div class="panel-body">
               
                <div class="corner-ribon blue-ribon">
                   <i class="fa fa-cog"></i>
                </div>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                    	<label class="col-sm-2">Periode Renstra <span class="text-danger">*</span></label>
                    	<div class="col-sm-3"><?=form_dropdown('renstra',$renstra,'0','id="renstra"')?></div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-2">Tahun <span class="text-danger">*</span></label>
                    	<div class="col-sm-2"><?=form_dropdown('tahun_awal',array("Pilih Tahun"),'','id="tahun_awal"')?></div>
                    	<div class="col-sm-2"><?=form_dropdown('tahun_akhir',array("Pilih Tahun"),'','id="tahun_akhir"')?></div>
                    </div>
                    <div class="form-group">
                    	<label class="col-sm-2">Nama Program <span class="text-danger">*</span></label>
                    	<div class="col-sm-8"><?=form_dropdown('nama_program',array("Pilih Program"),'','id="nama_program"')?></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">&nbsp;</label>
                        <button type="button" class="btn btn-info" id="program-btn" style="margin-left:15px;">
                            <i class="fa fa-check-square-o"></i> Tampilkan Data
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
    
    <div class="feed-box hide" id="box-result">
        <section class="panel tab-bg-form">
            <div class="panel-body">
               
                <div class="corner-ribon black-ribon">
                   <i class="fa fa-file-text"></i>
                </div>
                
                <form class="form-horizontal grid-form" role="form">
                	
                    <div class="form-group">
                    	<label class="col-md-2 text-primary">Nama Kegiatan</label>
                    	<div class="col-md-10" id="nama_kegiatan"></div>
                    </div>
                    <div class="form-group">
                    	<label class="col-md-2 text-primary">Pelaksana Program</label>
                    	<div class="col-md-10" id="pelaksana"></div>
                    </div>
                    <div class="form-group">
                    	<p class="text-primary col-md-12"><b>Capaian Kinerja</b></p>
                        <div class="adv-table" id="data-capaian" style="width:100%; overflow: auto; padding:10px 5px 10px 5px;">
                            <table  class="table table-bordered table-striped" id="tabel_capaian" width="100%">
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
                    	<p class="text-primary col-md-12" ><b>Serapan Anggaran</b></p>
                        <div class="adv-table" style="padding:10px 5px 10px 5px">
                            <table class="table table-bordered table-striped" id="tabel_serapan">
                			</table>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<p class="text-primary col-md-12" ><b>Grafik Perbandingan Capaian Kinerja dan Daya Serap Anggaran</b></p>
                        <div style="margin:0 5px 5px 0;" align="right">
                            <button type="button" class="btn btn-warning btn-sm" onclick="chart4.print();"><i class="fa fa-print"></i> Cetak Grafik</button>
                        </div>
                        <div id="grafik_program" style="padding:10px 5px 10px 5px">
                            
                        </div>
                    </div>
                    
                </form>
                
                <div class="pull-right">
                    <button type="button" class="btn btn-primary btn-sm" id="cetakpdf_program"><i class="fa fa-print"></i> Cetak PDF</button>          
                    <button type="button" class="btn btn-primary btn-sm" id="cetakexcel_program"><i class="fa fa-download"></i> Ekspor Excel</button>
                </div>
                
             </div>
        </section>
    </div>
    
    <style type="text/css">
        select {width:100%;}
    </style>
    <script type="text/javascript">
    $(document).ready(function () {
		
        $('select').select2({minimumResultsForSearch: -1, width:'resolve'});
         
        pelaksana = '';
        $('#renstra').change(function(){
            $('#tahun_awal').empty(); $('#tahun_akhir').empty(); $('#nama_program').empty();
			$('#tahun_awal').append(new Option("Pilih Tahun","0"));
			$('#tahun_akhir').append(new Option("Pilih Tahun","0"));
			$("#tahun_awal").select2("val", "0");
			$("#tahun_akhir").select2("val", "0");
            if ($('#renstra').val()!=0) {
                year = $('#renstra').val().split('-');
                for (i=parseInt(year[0]);i<=parseInt(year[1]);i++)  {
                    $('#tahun_awal').append(new Option(i,i));
                    $('#tahun_akhir').append(new Option(i,i));
                }
            }
            $('#tahun_awal').select2({minimumResultsForSearch: -1, width:'resolve'}); $('#tahun_akhir').select2({minimumResultsForSearch: -1, width:'resolve'});
        });
        $('#tahun_awal').change(function(){
            
        });
        $('#tahun_akhir').change(function(){
            val_awal = $('#tahun_awal').val();
            val_akhir = $('#tahun_akhir').val();
            $.ajax({
                url:"<?php echo site_url(); ?>evaluasi/program/get_program/"+val_awal+"/"+val_akhir,
                success:function(result) {
                    $('#nama_program').empty();
                    result = JSON.parse(result);
                    for (k in result) {
                        $('#nama_program').append(new Option(result[k],k));
                    }
                    $('#nama_program').select2({minimumResultsForSearch: -1, width:'resolve'});
                }
            });
        });

        $('#program-btn').click(function(){
            if($('#renstra').val()==0){
				alert("Periode Renstra belum ditentukan");
				$('#renstra').select2('open');
			}
			else if($('#nama_program').val()==0){
				alert("Nama Program belum ditentukan");
				$('#nama_program').select2('open');
			}
			else
			{
				if ($('#nama_program').val()!=0) {
					kode_program = $('#nama_program').val();
					val_awal = $('#tahun_awal').val();
					val_akhir = $('#tahun_akhir').val();
					//req kegiatan & pelaksana
					$.ajax({
						url:"<?php echo site_url(); ?>evaluasi/program/get_kegiatan_pelaksana_program/"+kode_program,
						success:function(result) {
							$('#box-result').removeClass("hide");
							result = JSON.parse(result);
							update_table(kode_program, val_awal, val_akhir, result.pelaksana.kode_e1);
							$('#pelaksana').html(result.pelaksana.nama_e1+" ("+result.pelaksana.kode_e1+")");
							list_kegiatan = '<ol>';
							nama_kegiatan = $('#nama_kegiatan');
							nama_kegiatan.empty();
							//nama_kegiatan.append('<ol>');
							for (i in result.kegiatan) list_kegiatan+='<li>'+result.kegiatan[i]+'</li>';                
							list_kegiatan += '</ol>';
							nama_kegiatan.append(list_kegiatan);
						}
					});
				} 
			}
		});
		
		$('#cetakpdf_program').click(function(){
        	kode_program = $('#nama_program').val();
			val_awal = $('#tahun_awal').val();
			val_akhir = $('#tahun_akhir').val();
			window.open("<?=base_url()?>evaluasi/program/print_tabel_program/"+val_awal+"/"+val_akhir+"/"+kode_program,'_blank');			
		});
		$('#cetakexcel_program').click(function(){
        	kode_program = $('#nama_program').val();
			val_awal = $('#tahun_awal').val();
			val_akhir = $('#tahun_akhir').val();
			window.open("<?=base_url()?>evaluasi/program/print_tabel_program_excel/"+val_awal+"/"+val_akhir+"/"+kode_program,'_blank');			
		});
		

        function update_table(kd_program, thn_awal, thn_akhir, kd_pelaksana) {
            //req capaian
            if (kd_program!=0 && kd_program!='' && kd_pelaksana!=0 && kd_pelaksana!='' && thn_akhir>=thn_awal) {
                $.ajax({
                    url:"<?php echo site_url(); ?>evaluasi/program/get_tabel_capaian_kinerja/"+thn_awal+"/"+thn_akhir+"/"+kd_pelaksana,
                        success:function(result) {
                            tabel_capaian = $('#tabel_capaian');
                            tabel_capaian.empty().html(result);
							/*$("#data-capaian").mCustomScrollbar({
								axis:"x",
								theme:"dark-2"
							});
							tabel_capaian.dataTable( {
                                "bDestroy": true
                        });*/
                    }
                });
                //req serapan                     
                $.ajax({
                    url:"<?php echo site_url(); ?>evaluasi/program/get_tabel_serapan_anggaran/"+thn_awal+"/"+thn_akhir+"/"+kd_program,
                        success:function(result) {
                            tabel_serapan = $('#tabel_serapan');
							tabel_serapan.empty().html(result);
                            /*tabel_serapan.dataTable( {
                                "bDestroy": true
                        });*/
                    }
                });
            }
			grafik(kd_program, thn_awal, thn_akhir, kd_pelaksana);
        }
		
		function grafik(kd_program, thn_awal, thn_akhir, kd_pelaksana)
		{
			var options = {
				chart: {
						renderTo: 'grafik_program',
						type : "column",
						marginTop: 80,
						marginRight: 20
					},
					colors: ['#3D96AE', '#DB843D', '#E10000'],
					exporting: {
						buttons: { 
							exportButton: {
								enabled:false
							},
							printButton: {
								enabled:false
							}
					
						}
					},
					title: {
						text: 'RATA-RATA CAPAIAN KINERJA DAN DAYA SERAP ANGGARAN',
						style : { "font-size" : "14px" }
					},
					xAxis: {
						categories: [],
					},
					yAxis: {
						title: {
							text: null
						}
					},
				series: [{
						name: 'Capaian Kinerja',
						type: 'column',
						dataLabels: {enabled: true},
					},{
						name: 'Serapan Anggaran',
						type: 'column',
						dataLabels: {enabled: true},
					}]
			};
			$.ajax({
				url: "<?php echo site_url(); ?>evaluasi/program/get_data_serapan/"+thn_awal+"/"+thn_akhir+"/"+kd_program+"/"+kd_pelaksana,
				dataType: "json",
				success: function(data){
					options.xAxis.categories = data.tahun;
					options.series[0].data = data.program;
					options.series[1].data = data.anggaran;
					chart4 = new Highcharts.Chart(options);			
				}
			});
		}
    });
    </script>