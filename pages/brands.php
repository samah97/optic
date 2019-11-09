<?php
include 'menu.php';
$brandsObj = new BrandEXT();
$brands = $brandsObj->getAllRecords();
?>
<link href="assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet">
<div class="container-fluid">
	<h1>Add Brands</h1>
	<div class="row">
		<form>
			<div class="row">
				<div class="col-md-12">
					<label for="brandFound" class="col-md-4">Brands List:</label>
				</div>
				<div class="col-md-12">
					<div class="brands-list">
					<?php foreach($brands as $brandRow){?>
					    <div class="col-md-12 brand-row" flag="0">
							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="Brand Name" name="name[]" value="<?= $brandRow->name ?>" data-ref="<?= $brandRow->brandId ?>">
							</div>
							<div class="col-md-4">
								<button type="button" class="btn btn-danger btn-delete-brand">X</button>
							</div>
						</div>
					<?php }?>
						<div class="col-md-12 brand-row" flag="1">

							<div class="col-md-4">
								<input type="text" class="form-control" placeholder="Brand Name" name="name[]">
							</div>
							<div class="col-md-4">
								<button type="button" class="btn btn-danger btn-delete-brand">X</button>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="pull-right">
							<button type="button" class="btn btn-primary btn-add-brand">Add
								Brand</button>
							<button type="button" class="btn btn-success btn-submit">Submit</button>
						</div>

					</div>
				</div>
				<div class="row form-group hidden">
					<div class="col-md-4">
						<label for="brand" class="col-md-4">Brand:</label>
					</div>
					<div class="col-md-4">
						<input type="text" name="brand" id="brand" class="form-control"></input>
					</div>
				</div>
		
		</form>
	</div>
</div>
<div id="brand-row-sample" class=" hidden">

	<div class="col-md-12 brand-row" flag="1">
		</hr>
		<div class="col-md-4">
			<input type="text" class="form-control" placeholder="Brand Name" name="name[]">
		</div>
		<div class="col-md-4">
			<button type="button" class="btn btn-danger btn-delete-brand">X</button>
		</div>
	</div>
</div>
<script>
$('.btn-add-brand').click(function(e){
	var brandRow =$('#brand-row-sample').clone();
	$('.brands-list').append(brandRow.html());
});

$('body').on('click','.btn-delete-brand',function(e){
	var brandRow = $(this).closest('.brand-row');
	var flag = brandRow.attr('flag');
	if(flag == 0){
        brandRow.attr('flag',3);
        brandRow.hide(500);
    }else{
        brandRow.remove();
    }

});

$('.btn-submit').click(function(){
	var brands = [];
	var isValid = true;
	$('.brands-list .brand-row').each(function(e){
	     var input = $(this).find('input[name="name[]"]');
		 var name = input.val();
		 var flag = $(this).attr('flag');
         var ref = input.attr('data-ref');
		 var brandObj = {};
		 brandObj.name = name; 
		 brandObj.flag = flag;
		 brandObj.ref = ref;

		 if(name == '' && flag !=3){
			 isValid = true;
			 return;
		 }
		 brands.push(brandObj);
	});
	if(isValid){
		submit(brands);
	}
	
	//console.log(brands);
});

function submit(brands){
    console.log(JSON.stringify(brands));
	$.ajax({
		url:'<?= MAIN_URL."v2/editBrand.php" ?>',
		type:'POST',	
		data:JSON.stringify({data:brands}),
        dataType: 'json',
        contentType: 'application/json',
		success:function(response){
		    if(response.result){
                swal({
                        title: "Success",
                        text: response.message,
                        type: "success",
                        confirmButtonText: "Ok",
                        closeOnConfirm: false
                    },
                    function(){
                        window.location.reload();
                    });

            }else{
                swal("Error", response.error,"error");
            }
		},
		error:function(error){
		    console.log("Error");
			console.log(error);
		}

	});
}
</script>
<script src="assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js"></script>
</body>
</html>