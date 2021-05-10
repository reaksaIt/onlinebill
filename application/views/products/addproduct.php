<div class="main" id="main">
	<div class="container-fluid">
		<div class="menu bg-dark p-0 m-0">
			<ul> 
				<li class="menu-bg" id="bg_pro">
					<div  id="linkpro">Product</div>
				</li>
				<li id="bg_cat">
					<div  id="linkcat">Category</div>
				</li>
			</ul>
		</div>
		
		<div class="mg-btn p-1 text-right">
			<button class="btn-modal btn-primary mr-1" data-toggle="modal" data-target="#proModal">New Product</button>
			<button class="btn-modal btn-primary" data-toggle="modal" data-target="#catModal">New Category</button>
		</div>
		<div id="viewpro" class="menu-d-block">
			<table class="table table-striped table-dark table-bordered table-view">
				<thead>
					<tr>
						<th>No</th>
						<th>Items</th>
						<th>Price</th>
						<th>Description</th>
						<th>Category</th>
						<th colspan="2">Options</th>
					</tr>
				</thead>
				<tbody id="myproduct">
					
				</tbody>
			</table>
			<div class="text-center" id="pro_founder"></div>
		</div>
		<div id="viewcat" class="menu-d-none">
			<table class="table table-striped table-dark table-bordered table-view">
				<thead>
					<tr>
						<th>No</th>
						<th>Categoru</th>
						<th>Description</th>
						<th colspan="2">Options</th>
					</tr>
				</thead>
				<tbody id="tbCategory">
					
				</tbody>
			</table>
			<div class="text-center" id="founder"></div>
		</div>
		<div class="pro-control">
			<div class="modal fade" id="proModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content kh-Ang form-product">
						<div class="modal-header">
							<h4 class="modal-title">New Product</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="product">
								<div class="form-group">
									<label>Product Name*</label>
									<input type="text" name="pro_name" id="pro_name" class="form-control" placeholder="Product Name" autocomplete="off">
									<div class="text-warning" id="pro_error"></div>
								</div>
								<div class="form-group">
									<label>Price*</label>
									<input type="text" name="pro_price" id="pro_price" placeholder="Price" class="form-control" autocomplete="off">
									<div class="text-warning" id="price_error"></div>
								</div>
								<div class="form-group">
									<label>Category*</label>
									<select name="pro_cat" id="pro_cat" class="custom-select">
										<option value="0">Select</option>
										<?php foreach ($cat as $row):?>
											<option value="<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></option>
										<?php endforeach; ?>
									</select>
									<div class="text-warning" id="pc_error"></div>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea rows="4" class="form-control" name="pro_des" placeholder="Description"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button class="btn-modal" data-dismiss="modal">Cancel</button>
							<button class="btn-modal" id="add_pro">Add</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" id="editModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content kh-Ang form-product">
						<div class="modal-header">
							<h4 class="modal-title">Update Product</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="updatepro">
								<div class="form-group">
									<label>Product Name*</label>
									<input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="Product Name" autocomplete="off">
									<div class="text-warning" id="pro_error"></div>
								</div>
								<div class="form-group">
									<label>Price*</label>
									<input type="text" name="edit_price" id="edit_price" placeholder="Price" class="form-control" autocomplete="off">
									<div class="text-warning" id="price_error"></div>
								</div>
								<div class="form-group">
									<label>Category*</label>
									<select name="edit_cat" id="edit_cat" class="custom-select">
										<option value="0">Select</option>
										<?php foreach ($cat as $row):?>
											<option value="<?php echo $row->cat_id; ?>"><?php echo $row->cat_name; ?></option>
										<?php endforeach; ?>
									</select>
									<div class="text-warning" id="pc_error"></div>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea rows="4" class="form-control" name="edit_des" id="edit_des" placeholder="Description"></textarea>
								</div>
								<input type="hidden" name="edit_id" id="edit_id">
							</form>
						</div>
						<div class="modal-footer">
							<button class="btn-modal" data-dismiss="modal">Cancel</button>
							<button class="btn-modal" id="update_pro">Update</button>
						</div>
					</div>
				</div>
			</div>
			<div class="modal fade" role="dialog" id="catModal">
				<div class="modal-dialog">
					<div class="modal-content form-product kh-Ang">
						<div class="modal-header">
							<h4 class="modal-title">
								New Category
							</h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form id="category">
								<div class="form-group">
									<label>Cateogry</label>
									<input type="text" name="cat_name" id="cat_name" class="form-control" autocomplete="off" placeholder="Category">
									<div class="text-warning" id="cat_error"></div>
								</div>
								<div class="form-group">
									<label>Description</label>
									<textarea rows="4" class="form-control" placeholder="Description" id="cat_des" name="cat_des"></textarea>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button class="btn-modal" data-dismiss="modal">Cancel</button>
							<button class="btn-modal" id="add_cat">Add</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var def_url = '<?php echo base_url();?>index.php/';
		$("#linkpro").click(function(){

			$("#viewpro").addClass('menu-d-block');
			$("#viewpro").removeClass('menu-d-none');
			$("#viewcat").addClass('menu-d-none');
			$("#bg_cat").removeClass('menu-bg');
			$("#bg_pro").addClass('menu-bg');

			// $(this).css({"background-color":"white"});
			// $("#viewcate").css({"display":"none"});
		});
		$("#linkcat").click(function(){
			$("#viewpro").removeClass('menu-d-block');
			$("#viewpro").addClass('menu-d-none');
			$("#viewcat").removeClass('menu-d-none');
			$("#bg_pro").removeClass('menu-bg');
			$("#bg_cat").addClass('menu-bg');
			//$("#viewcat").addClass('menu-d-');
		});

		//Read Category
		function readcategory(){
			$.ajax({
				url:def_url+'querycontroller/querycategory',
				dataType:'json',
				success: function(data){
					if(data.length>0){
						$("#founder").text('');
						var html;
						var i = 1,x=1;
						for(i in data){
							html+='<tr>';
							html+='<td class="w-5">'+ x++ +'</td>';
							html+='<td class="w-30 cap">'+data[i].cat_name+'</td>';
							html+='<td class="w-55 pre">'+data[i].cat_description+'</td>';
							html+='<td class="w-5"><div class="op-btn"><i class="fas fa-edit"></i></div></td>';
							html+='<td class="w-5"><div class="op-btn"><i class="fas fa-trash-alt"></i></div></td>';
							html+='</tr>';
						}
						$('#tbCategory').html(html);
					}
					else{
						$("#founder").text('Not found data');
					}
				}
			})
		}
		readcategory();
		//Add category
		$("#add_cat").click(function(){
			var cat_name = $.trim($('#cat_name').val());
			var cat_des = $.trim($('#cat_des').val());
			if(cat_name!=""){
				$.ajax({
					url:def_url+"insertcontroller/addcategory",
					type:"post",
					data:$("#category").serialize(),
					dataType:"json",
					success: function(data){
						if(data.success){
							swal({
								title:'Inserted',
								icon:'success',
								timer:2000,
							});
							$("#catModal").modal('hide');
							$("#category")[0].reset();
							readcategory();
						}
					}
				});
				$('#cat_error').text('');
			}
			else{
				$('#cat_error').text('field requered !');
			}
		});
		//Read Product
		function readproduct(){
			$.ajax({
				url:def_url+'querycontroller/queryproduct',
				dataType:'json',
				success:function(data){
					
						var html;
						var x=1;
						var i=1;
						for(i in data){
							html+='<tr>';
							html+='<td class="w-5">'+ x++ +'</td>';
							html+='<td class="w-20 cap">'+ data[i].pro_name +'</td>';
							html+='<td class="w-10">$'+ parseFloat(data[i].pro_price).toFixed(2) +'</td>';
							html+='<td class="w-40 pre">'+ data[i].pro_description +'</td>';
							html+='<td class="w-15">'+ data[i].cat_name +'</td>';
							html+='<td class="w-5">'+'<div class="op-btn editpro" id="'+data[i].pro_id+'"><i class="fas fa-edit"></i></div>'+'</td>';
							html+='<td class="w-5">'+'<div class="op-btn deletepro" id="'+data[i].pro_id+'"><i class="fas fa-trash-alt"></i></div>'+'</td>';
							html+='</tr>';
						}
						$("#myproduct").html(html);
						if(data.length>0){
							$("#pro_founder").text('');
						}
						else{
							$("#pro_founder").text('Data not found !!');

						}
					
					
				}

			});
		}
		readproduct();
		$(document).on('click','.deletepro',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:def_url+'deletecontroller/deleteproduct',
				type:'post',
				data:{id:id},
				dataType:'json',
				success:function(data){
					if(data.delete){
						swal({
							title:'Deleted',
							icon:'success',
							timer:2000,
						});
						readproduct();

					}
					
				}
			})
		});
		$(document).on('click','.editpro',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:def_url+'querycontroller/editproduct',
				type:'post',
				data:{id:id},
				dataType:'json',
				success:function(data){
					$('#editModal').modal('show');
					$('#edit_name').val(data[0].pro_name);
					$('#edit_price').val(parseFloat(data[0].pro_price).toFixed(2));
					$('#edit_des').val(data[0].pro_description);
					$('#edit_cat').val(data[0].pro_cat);
					$('#edit_id').val(data[0].pro_id);

				}

			})
		});
		$('#update_pro').click(function(){
			$.ajax({
				url:def_url+'updatecontroller/updateproduct',
				type:'post',
				data:$('#updatepro').serialize(),
				dataType:'json',
				success:function(data){
					if(data.success){
						swal({
							title:'Product Updated',
							icon:'success',
							timer:2000,
						});
						$('#updatepro')[0].reset();
						$('#editModal').modal('hide');
						readproduct();
					}
				}
			})
		})
		//Add Product
		$("#add_pro").click(function(){
			var pro_name = $.trim($("#pro_name").val());
			var pro_price = $.trim($("#pro_price").val());
			var pro_cat = $("#pro_cat").val();
			if(pro_name!=""&&pro_price!=""&&pro_cat!=0){
				$.ajax({
					url:def_url+'insertcontroller/addproduct',
					type:'post',
					data:$('#product').serialize(),
					dataType:'json',
					success: function(data){
						if(data.success){
							swal({
								title:'Inserted',
								icon:'success',
								timer:2000,
							});
							$('#proModal').modal('hide');
							$('#product')[0].reset();
							readproduct();
						}
						else if(data.ready){
							swal({
								title:'This Product Have',
								icon:'info',
								timer:2000,
							})
						}
					}
				})
			}
			if(pro_name==""){
				$("#pro_error").text('field required');
			}
			else{
				$("#pro_error").text('');

			}
			if(pro_price==""){
				$("#price_error").text('field required');
			}
			else{
				$("#price_error").text('');

			}
			if(pro_cat==0){
				$("#pc_error").text('Please select');
			}
			else{
				$("#pc_error").text('');

			}
		});
	});
</script>