
                   
                    <div class="panel-body">
                     <header class="panel-heading">
                        Sasaran Program
                        <span class="pull-right">
                            <a href="#" class="btn btn-primary btn-sm" style="margin-top:-5px;"><i class="fa fa-plus"></i> Tambah</a>
                         </span>
                    </header>
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                   <tr>
                        <th>Tahun</th>
                        <th>Sasaran Strategis</th>
                        <th>Kode SP</th>
                        <th>Deskripsi</th>                        
                        <th width="10%">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    
						<?php if (isset($data)){foreach($data as $d): ?>
                        <tr class="gradeX">
                            <td><?=$d->tahun?></td>
                            <td><?=$d->sastra_deskripsi?></td>
                            <td><?=$d->kode_sp_e1?></td>                            
                            <td><?=$d->deskripsi?></td>
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
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                         
                        </tr>
						<?php }?>
                    
                    </tbody>
                    </table>
                    </div>
                    </div>
               