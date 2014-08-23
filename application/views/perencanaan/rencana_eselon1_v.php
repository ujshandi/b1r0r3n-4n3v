<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
		<!--tab nav start-->
            <section class="panel">
                <header class="panel-heading tab-bg-light tab-right ">
                	<p class="pull-left"><b>Perencanaan Eselon I</b></p>
                    <ul class="nav nav-tabs pull-right">
                        <li class="active">
                            <a data-toggle="tab" href="#visi-content">
                               <i class="fa fa-list-ol"></i> Visi
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#misi-content">
                                <i class="fa fa-bar-chart-o"></i> Misi
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#tujuan-content">
                                <i class="fa fa-align-center"></i> Tujuan
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#sasaran-content">
                                <i class="fa fa-clipboard"></i> Sasaran
                            </a>
                        </li>
                    </ul>
                </header>
                <div class="panel-body">
                    <div class="tab-content">
                       <div class="panel-body tab-pane fade active in" id="visi-content"></div>
								<div class="panel-body tab-pane fade" id="misi-content"></div>
								<div class="panel-body tab-pane fade" id="tujuan-content"></div>
								<div class="panel-body tab-pane fade" id="sasaran-content"></div>
                </div>
            </section>
            <!--tab nav end-->
                
       
        </section>
    </section>
    <!--main content end-->
	
	<script  type="text/javascript" language="javascript">
		$(document).ready(function() {
			
			$("#visi-content").load("<?=base_url()?>perencanaan/rencana_eselon1/loadvisi");
			$("#misi-content").load("<?=base_url()?>perencanaan/rencana_eselon1/loadmisi");
			$("#tujuan-content").load("<?=base_url()?>perencanaan/rencana_eselon1/loadtujuan");
			$("#sasaran-content").load("<?=base_url()?>perencanaan/rencana_eselon1/loadsasaran");
			
		});
	</script>