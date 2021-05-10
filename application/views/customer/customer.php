<div class="main" id="main">
	<div class="container-fluid">
		<div class="m-customer">
			<div class="mg-cus-btn mt-1 mb-1 text-right">
				<button class="btn-modal btn-primary" id="newcustomer" data-toggle="modal" data-target="#customerModal">New Customer</button>
			</div>
			<table class="table table-striped table-dark table-bordered table-view">
				<thead>
					<tr>
						<th>No</th>
						<th>Customer</th>
						<th>Contact</th>
						<th>Email</th>
						<th>Address</th>
						<th>Date</th>
						<th>By</th>
						<th colspan="2">Options</th>
					</tr>
				</thead>
				<tbody id="tbcustomer">
					
				</tbody>
			</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" role="dialog" id="customerModal">
		<div class="modal-dialog">
			<div class="modal-content kh-Ang form-product">
				<div class="modal-header">
					<h4 class="modal-title">New Customer</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="customer">
						<div class="form-group">
							<label>Customer Name*</label>
							<input type="text" name="cus_name" id="cus_name" class="form-control" placeholder="Customer Name" autocomplete="off">
							<div class="text-warning" id="cus_error"></div>
						</div>
						<div class="form-group">
							<label>Phone*</label>
							<input type="text" name="cus_phone" id="cus_phone" class="form-control" placeholder="Phone" autocomplete="off">
							<div class="text-warning" id="phone_error"></div>
						</div>
						<div class="form-group">
							<label>Email*</label>
							<input type="email" name="cus_email" id="cus_email" class="form-control" placeholder="Email" autocomplete="off">
							<div class="text-warning" id="email_error"></div>
						</div>
						<div class="form-group">
							<label>Address*</label>
							<textarea rows="4" class="form-control" name="cus_add" id="cus_add" placeholder="Address"></textarea>
							<div class="text-warning" id="add_error"></div>
						</div>
						<input type="hidden" name="cus_on" value="<?php echo date('d/m/Y') ?>">
						<!-- <input type="text" name="cus_by"> -->
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn-modal" data-dismiss="modal">Cancel</button>
					<button class="btn-modal" id="add_cus">Add</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" role="dialog" id="editcusModal">
		<div class="modal-dialog">
			<div class="modal-content kh-Ang form-product">
				<div class="modal-header">
					<h4 class="modal-title">Edit Customer</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="editcustomer">
						<div class="form-group">
							<label>Customer Name*</label>
							<input type="text" name="edit_name" id="edit_name" class="form-control" placeholder="Customer Name" autocomplete="off">
							<div class="text-warning" id="cus_error"></div>
						</div>
						<div class="form-group">
							<label>Phone*</label>
							<input type="text" name="edit_phone" id="edit_phone" class="form-control" placeholder="Phone" autocomplete="off">
							<div class="text-warning" id="phone_error"></div>
						</div>
						<div class="form-group">
							<label>Email*</label>
							<input type="email" name="edit_email" id="edit_email" class="form-control" placeholder="Email" autocomplete="off">
							<div class="text-warning" id="email_error"></div>
						</div>
						<div class="form-group">
							<label>Address*</label>
							<textarea rows="4" class="form-control" name="edit_add" id="edit_add" placeholder="Address"></textarea>
							<div class="text-warning" id="add_error"></div>
						</div>
						<input type="hidden" name="edit_id" id="edit_id">
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn-modal" data-dismiss="modal">Cancel</button>
					<button class="btn-modal" id="update_cus">Update</button>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		function readcustomer(){
			$.ajax({
				url:'<?php echo base_url()?>index.php/querycontroller/querycustomer',
				dataType:'json',
				success: function(data){
					var html;
					var i=1;
					var x = 1;
					for(i in data){
						html+='<tr>';
						html+='<td class="w-5">'+ x++ +'</td>';
						html+='<td class="w-20">'+data[i].cus_name+'</td>';
						html+='<td class="pre w-10">'+data[i].cus_phone+'</td>';
						html+='<td class="w-15">'+data[i].cus_email+'</td>';
						html+='<td class="w-30">'+data[i].cus_address+'</td>';
						html+='<td class="w-10">'+data[i].cus_cre_date+'</td>';
						html+='<td class="w-10">'+data[i].us_fname +' '+ data[i].us_lname+'</td>';
						html+='<td class="w-5"><div class="op-btn cusedit" id="'+data[i].cus_id+'"><i class="fas fa-edit"></i></div></td>';
						html+='<td class="w-5"><div class="op-btn cusdelete" id="'+data[i].cus_id+'"><i class="fas fa-trash-alt"></i></div></td>';
						html+='</tr>';
					}
					$('#tbcustomer').html(html);
				}
			})
		};
		readcustomer();

		$(document).on('click','.cusdelete',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:'<?php echo base_url();?>index.php/deletecontroller/deletecustomer/'+id,
				dataType:'json',
				success: function(data){
						if(data.deleted){

							swal({
								title:'Deleted',
								icon:'success',
								timer:2000,
							});
							readcustomer();
						}

				}
			});
		});
		$(document).on('click','.cusedit',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:'<?php echo base_url();?>index.php/querycontroller/editcustomer/'+id,
				dataType:'json',
				success: function(data){
					$('#editcusModal').modal('show');
					$('#edit_name').val(data[0].cus_name);
					$('#edit_phone').val(data[0].cus_phone);
					$('#edit_email').val(data[0].cus_email);
					$('#edit_add').val(data[0].cus_address);
					$('#edit_id').val(data[0].cus_id);
				}
			});
		});
		$('#update_cus').click(function(){
			var id = $('#edit_id').val();
			$.ajax({
				url:'<?php echo base_url();?>index.php/updatecontroller/updatecustomer/'+id,
				type:'post',
				data:$('#editcustomer').serialize(),
				dataType:'json',
				success:function(data){
					if(data.updated){
						swal({
							title:'Updated',
							icon:'success',
							timer:2000,
						});
						$('#editcusModal').modal('hide');
						readcustomer();
					}
				}
			})
		});
		$('#add_cus').click(function(){
			var cus_name = $.trim($('#cus_name').val());
			var cus_phone = $.trim($('#cus_phone').val());
			var cus_email = $.trim($('#cus_email').val());
			var cus_add = $.trim($('#cus_add').val());
			if(cus_name!=''&&cus_phone!=''&&cus_email!=''&&cus_add!=''){
				$.ajax({
					url:'<?php echo base_url()?>index.php/insertcontroller/addcustomer',
					type:'post',
					data:$('#customer').serialize(),
					dataType:'json',
					success:function(data){
						if(data.success){
							swal({
								title:'Inserted',
								icon:'success',
								timer:2000,
							});
							$('#customerModal').modal('hide');
							$('#customer')[0].reset();
							readcustomer();
						}
						else if(data.tolog){
							window.location.href='<?php echo base_url()?>index.php/viewcontroller/viewlogin';
						}
					}
				});
			}
			if(cus_name!=''){
				$('#cus_name').removeClass('border-danger border-2');
				$('#cus_error').text('');
			}
			else{
				$('#cus_name').addClass('border-danger border-2');
				$('#cus_error').text('Name requied');
			}
			if(cus_phone!=''){
				$('#cus_phone').removeClass('border-danger border-2');
				$('#phone_error').text('');
			}
			else{
				$('#cus_phone').addClass('border-danger border-2');
				$('#phone_error').text('Phone requied');
			}
			if(cus_email!=''){
				$('#cus_email').removeClass('border-danger border-2');
				$('#email_error').text('');
			}
			else{
				$('#cus_email').addClass('border-danger border-2');
				$('#email_error').text('Email requied');
			}
			if(cus_add!=''){
				$('#cus_add').removeClass('border-danger border-2');
				$('#add_error').text('');
			}
			else{
				$('#cus_add').addClass('border-danger border-2');
				$('#add_error').text('Address requied');
			}
		})
		

	});
</script>