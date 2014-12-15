
     <script>
		 $(document).ready(function(){
			$('select').select2({minimumResultsForSearch: -1,width:'resolve'});
			$('#form-e2-tahun-misi').change(function(){
				tahun	= $('#form-e2-tahun-misi').val();
				$.ajax({
					url:"<?=site_url()?>unit_kerja/eselon1/get_es1/"+tahun,
					success:function(result) {
						$('#form-e1-misi').empty();
						result = JSON.parse(result);
						for (a in result) {
							$('#form-e1-misi').append(new Option(result[a].nama,result[a].kode));
						}
						$('#form-e1-misi').select2({minimumResultsForSearch: -1, width:'resolve'});
					}
				});
			});
			$("#form-e1-misi").change(function(){
				$.ajax({
					url:"<?php echo site_url(); ?>perencanaan/rencana_eselon2/get_list_eselon2/"+this.value,
					success:function(result) {
						kode_e2=$("#form-e2-misi");
						kode_e2.empty();
						result = JSON.parse(result);
						for (k in result) {
							kode_e2.append(new Option(result[k],k));
						}
						kode_e2.select2({minimumResultsForSearch: -1, width:'resolve'});
					}
				});
			});
		 });
	 </script>
     
    <?php if (isset($data)) : ?>
   			<input type="hidden" name="tipe" value="misi" />
            <input type="hidden" name="id" value="<?=$data[0]->kode_misi_e2?>" />
            <input type="hidden" name="tahun_old" value="<?=$data[0]->tahun_renstra?>" />
            <div class="form-group">
                <label class="col-sm-4 control-label">Periode Renstra <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                	<select name="tahun" class="populate" id="form-e2-tahun-misi">
                    	<?php $no=0; foreach($renstra as $r): ?>
                        	<?php if($no==0): $val = ""; else: $val=$r; endif; ?>
                            <?php if($data[0]->tahun_renstra==$r): $sel = "selected"; else: $sel=""; endif; ?>
                        	<option value="<?=$val?>" <?=$sel?>><?=$r?></option>
                        <?php $no++; endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Unit Kerja Eselon I <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                	<select name="e1" class="populate" id="form-e1-misi">
                    	<?php if($data[0]->kode_e1!=""): ?>
                    	<option value="<?=$data[0]->kode_e1?>"><?=$data[0]->nama_e1?></option>
                    	<?php endif; ?>
                    </select> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Unit Kerja Eselon II <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                	<select name="e2" class="populate" id="form-e2-misi">
                    	<?php if($data[0]->kode_e2!=""): ?>
                    	<option value="<?=$data[0]->kode_e2?>"><?=$data[0]->nama_e2?></option>
                    	<?php endif; ?>
                    </select> 
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Kode Misi <span class="text-danger">*</span></label>
                <div class="col-sm-7">
                    <input type="text" class="form-control input-sm" id="form-e2-kode-misi" name="kode" value="<?=$data[0]->kode_misi_e2?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Misi <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <textarea name="misi" class="form-control" id="form-e2-data-misi"><?=$data[0]->misi_e2?></textarea>
                </div>
            </div>
            
     <?php endif; ?>