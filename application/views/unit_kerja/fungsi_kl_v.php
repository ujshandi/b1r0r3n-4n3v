<!--main content start-->
<div class="panel-body">
 <header class="panel-heading">
	Fungsi Kementerian
	<span class="pull-right">
		 <a href="#" data-toggle="modal" class="btn btn-primary btn-sm" style="margin-top:-5px;"><i class="fa fa-plus"></i> Tambah</a>
	 </span>
</header>
<div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Fungsi</th>
                        
                        <th width="10%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    
							<?php if (isset($data)){foreach($data as $d): ?>
                        <tr class="gradeX">
                            <td><?=$d->kode_fungsi_kl?></td>
                        
                            <td><?=$d->fungsi_kl?></td>
                            <td>
                            	<a href="#" class="btn btn-info btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="#" class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                       <?php endforeach; } else {?>
						<tr class="gradeX">
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                           
                        </tr>
						<?php }?>
                    
                    </tbody>
                    </table>
</div>



    
    <!--main content end-->
    
    