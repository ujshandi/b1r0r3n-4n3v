<page format="A4">

   <!-- <table cellpadding="1" cellspacing="1" style="width:720px; border:0px #666666 solid; padding:10px 10px 10px 10px;"> -->
    <table border="0" cellpadding="4" cellspacing="0">
   
    	<tr style="border:1px #666666 solid"><td><b>Periode Renstra</b></td></tr>
        <tr style="border:1px #666666 solid;">
            <td style="padding:10px 0 20px 20px;">
            	<?=$renstra?>
            </td>
        </tr>
        <tr style="border:1px #666666 solid"><td><b>Nama Kementerian</b></td></tr>
        <tr style="border:1px #666666 solid;">
            <td style="padding:10px 0 20px 20px;">
            	<?=$kementerian?>
            </td>
        </tr>
        <tr style="border:1px #666666 solid"><td><b>Visi</b></td></tr>
        <tr style="border:1px #666666 solid;">
            <td style="padding:10px 0 20px 20px;">
            	<?php echo $visi;				?>
            </td>
        </tr>
        <tr style="border:1px #666666 solid"><td><b>Misi</b></td></tr>
        <tr style="border:1px #666666 solid">
            <td>
            	
            	<?php
					echo $misi;
				?>
                
            </td>
        </tr>
		<tr style="border:1px #666666 solid"><td><b>Tujuan</b></td></tr>
        <tr style="border:1px #666666 solid">
            <td>
            	
            	<?php
					echo $tujuan;
				?>
                
            </td>
        </tr>
		<tr style="border:1px #666666 solid"><td><b>Sasaran Strategis dan IKU</b></td></tr>
        <tr style="border:1px #666666 solid">
            <td>
               <? echo $sasaran?> 
            </td>
        </tr>
        <tr><td><b>Program</b></td></tr>
        <tr>
            <td>
            	
            	<?php echo $program;
				
				?>
                
            </td>
        </tr>
    </table>
</page>