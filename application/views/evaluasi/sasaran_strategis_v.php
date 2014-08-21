<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
        
        <?=$this->session->flashdata('msg')?>
                <section class="panel panel-primary">
                    <header class="panel-heading">
                        <h3 class="panel-title">EVALUASI SASARAN STRATEGIS</h3>
                    </header>
                    <div class="panel-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                        <label class="col-md-2">Periode Renstra</label>
                        <div class="col-md-2"><?=form_dropdown('renstra',$renstra,'0','id="renstra"')?></div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-2">Tahun</label>
                        <div class="col-md-2"><?=form_dropdown('tahun_awal','','','id="tahun_awal"')?></div>
                        <div class="col-md-2"><?=form_dropdown('tahun_akhir','','','id="tahun_akhir"')?></div>
                        </div>
                        <div class="form-group">
                        <label class="col-md-2">Sasaran</label>
                        <div class="col-md-8"><?=form_dropdown('sasaran','','','id="sasaran"')?></div>
                        </div>
                    </form>
                    <section class="panel panel-default">
                    <div class="panel-heading">Capaian Kinerja</div>
                    <div class="panel-body">
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="tabel_capaian">
                    </table>

                    </div>
                    </div>
                    </section>
                    </div>
                </section>
        </section>
    </section>
    <!--main content end-->
    <style type="text/css">
        select {width:100%;}
        tr.detail_toggle{display: none;}
    </style>
    <!--js-->
    <script src="<?=base_url("static")?>/js/jquery.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $('select').select2({minimumResultsForSearch: -1, width:'resolve'});
        renstra = $('#renstra');
        tahun_awal = $('#tahun_awal');
        tahun_akhir = $('#tahun_akhir');
        sasaran = $('#sasaran');
        renstra.change(function(){
            tahun_awal.empty(); tahun_akhir.empty(); sasaran.empty();
            if (renstra.val()!=0) {
                year = renstra.val().split('-');
                for (i=parseInt(year[0]);i<=parseInt(year[1]);i++)  {
                    tahun_awal.append(new Option(i,i));
                    tahun_akhir.append(new Option(i,i));
                }
                tahun_awal.select2({minimumResultsForSearch: -1, width:'resolve'}); tahun_akhir.select2({minimumResultsForSearch: -1, width:'resolve'});
                $.ajax({
                    url:"<?php echo site_url(); ?>evaluasi/sasaran_strategis/get_sasaran/"+renstra.val(),
                    success:function(result) {
                        sasaran.empty();
                        result = JSON.parse(result);
                        for (k in result) {
                            sasaran.append(new Option(result[k],k));
                        }
                        sasaran.select2({minimumResultsForSearch: -1, width:'resolve'});
                    }
                });
            }
        });
        tahun_awal.change(function(){
            update_table();
        });
        tahun_akhir.change(function(){
            update_table();
        });

        sasaran.change(function(){
            update_table();
        });

        function update_table() {
            val_awal = tahun_awal.val();
            val_akhir = tahun_akhir.val();
            if (sasaran.val()!=0 && sasaran.val()!='' && val_akhir>=val_awal) {
                kode_sasaran = sasaran.val();
                $.ajax({
                    url:"<?php echo site_url(); ?>evaluasi/sasaran_strategis/get_tabel_capaian_kinerja/"+val_awal+"/"+val_akhir+"/"+kode_sasaran,
                        success:function(result) {
                            tabel_capaian = $('#tabel_capaian');
                            tabel_capaian.empty().html(result);        
                            //tabel_capaian.dataTable( {
                            //    "bDestroy": true
                            //});
                            $('.toggler').click(function(e){
                                e.preventDefault();
                                $('.detail'+$(this).attr('id')).toggle();
                                target = $('#'+$(this).attr('target_rowspan'));
                                if (e.target.id==$(this).attr('id')) {
                                    num_rowspan = parseInt($(this).attr('num_rowspan'));
                                    target.attr('rowspan',(num_rowspan+parseInt(target.attr('rowspan'))));
                                    $(this).attr('num_rowspan',num_rowspan*-1);
                                }
                                //console.log('.detail'+$(this).attr('detail_num'));
                            });
                        }
                });    
            }
        }
    });
    </script>
    <!--js-->