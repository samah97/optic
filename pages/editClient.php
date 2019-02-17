<?php include 'menu.php';  ?>

<div class="container">
	<div class="row">
		<!-- <div class="col-md-12">
			<h3 class="text-center">New Client</h3>
		</div> -->
		<div class="col-md-12">
		<form id="newClient" name="newClient" action="action/insertClient.php?fromPage=newClient" method="POST" onSubmit="if(!validateForm()){return false;}">
			<div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="icon-social-dribbble font-purple-soft"></i>
                                            <span class="caption-subject font-purple-soft bold uppercase">New Client</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab_1_1" data-toggle="tab"> Personal Info </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_2" data-toggle="tab"> Visual Problems </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_3" data-toggle="tab"> Refractions History </a>
                                            </li>
                                            <li>
                                                <a href="#tab_1_4" data-toggle="tab"> Test </a>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane fade active in" id="tab_1_1">
                                                <p> Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher
                                                    retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate
                                                    nisi qui. </p>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_2">
                                                <p> Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table
                                                    craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar
                                                    helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art
                                                    party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park. </p>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_3">
                                                <p> Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone
                                                    skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel
                                                    fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr. </p>
                                            </div>
                                            <div class="tab-pane fade" id="tab_1_4">
                                                <p> Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore
                                                    wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats
                                                    keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan. </p>
                                            </div>
                                        </div>
                                        <div class="clearfix margin-bottom-20"> </div>

                                    </div>
                                </div>
			<div class="col-md-12">
			<button class="btn btn-success pull-right" style='margin-top:20px;' type="submit" >
				Submit
			</button>
			</div>
		</div>
	</div>
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?php echo BASE_URL ?>plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
	<script>
$(document).ready(function(){
/* $('#dob').datepicker();
$('#dateAttendance').datepicker();
$('#dateReceived').datepicker(); */
/* 	$('.datepicker').datepicker({
		format: 'dd/mm/yyyy' 
		}); */
});
</script>