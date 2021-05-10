<div class="main" id="main">	
	<div class="r-item">
		<div class="container-fluid">
			<div class="r-btn text-right">
				<button class="btn btn-primary mt-1 mb-1" id="new_item" data-toggle="modal" data-target="#itemModel">New Item</button>
			</div>
			<table class="table table-striped table-dark table-bordered table-view">
				<thead>
					<tr>
						<td>No</td>
						<td>Item</td>
						<td>Description</td>
						<td>Qty</td>
						<td>Price</td>
						<td>Total</td>
						<td colspan="2" class="text-center">Options</td>
					</tr>
				</thead>
				<tbody id="tbItem">
					
				</tbody>
			</table>
		</div>
		<div class="modal fade" role="dialog" id="itemModel">
			<div class="modal-dialog">
				<div class="modal-content kh-Ang form-product">
					<div class="modal-header">
						<h4 class="modal-title">
							Add Item To Quote
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="item">
							<div class="form-group">
								<label>Items</label>
								<select class="custom-select" name="item_name" id="item_name">
									<option value="0">Select</option>
									<?php foreach($pro as $row): ?>
										<option value="<?php echo $row->pro_id?>"><?php echo $row->pro_name ?></option>
									<?php endforeach; ?>
								</select>
								<div class="text-warning" id="item_error"></div>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="text" class="form-control" name="item_price" id="item_price" disabled>
								<div class="text-warning" id="price_error"></div>
							</div>
							<div class="form-group">
								<label>Qty</label>
								<input type="text" name="item_qty" id="item_qty" class="form-control" value="1">
								<div class="text-warning" id="qty_error"></div>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="4" name="item_des" id="item_des"></textarea>
							</div>
							<input type="hidden" name="item_quote" id="item_quote" value="<?php echo $url ?>">
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn-modal" data-dismiss="modal">Cancel</button>
						<button class="btn-modal" id="add_item">Add</button>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" role="dialog" id="edititemModel">
			<div class="modal-dialog">
				<div class="modal-content kh-Ang form-product">
					<div class="modal-header">
						<h4 class="modal-title">
							Update Item
						</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form id="edititem">
							<div class="form-group">
								<label>Items</label>
								<select class="custom-select" name="edititem_name" id="edititem_name" disabled>
									<option value="0">Select</option>
									<?php foreach($pro as $row): ?>
										<option value="<?php echo $row->pro_id?>"><?php echo $row->pro_name ?></option>
									<?php endforeach; ?>
								</select>
								<div class="text-warning" id="item_error"></div>
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="text" class="form-control" name="edititem_price" id="edititem_price" disabled>
								<div class="text-warning" id="price_error"></div>
							</div>
							<div class="form-group">
								<label>Qty</label>
								<input type="text" name="edititem_qty" id="edititem_qty" class="form-control">
								<div class="text-warning" id="qty_error"></div>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea class="form-control" rows="4" name="edititem_des" id="edititem_des"></textarea>
							</div>
							<input type="hidden" name="item_quote" id="edititem_id">
						</form>
					</div>
					<div class="modal-footer">
						<button class="btn-modal" data-dismiss="modal">Cancel</button>
						<button class="btn-modal" id="update_item">Update</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){

		function updatequote(id,total){
			$.ajax({
				url:'<?php echo base_url();?>index.php/updatecontroller/updateamount',
				type:'post',
				data:{total:total,id:id},
			})
		};
		function readitem(){
			var id =$('#item_quote').val();
			$.ajax({
				url:'<?php echo base_url();?>index.php/querycontroller/queryitem',
				data:{id:id},
				type:'post',
				dataType:'json',
				success:function(data){
					var quote = data[0].item_quote;
					var html;
					var i = 1;
					var x = 1;
					var total = 0;
					for(i in data){
						var qty = parseFloat(data[i].item_qty);
						var price = parseFloat(data[i].pro_price);
						var s_total = qty*price;
						html+='<tr>';
						html+='<td class="w-5">'+ x++ +'</td>';
						html+='<td class="w-25 cap">'+ data[i].pro_name +'</td>';
						html+='<td class="w-35 pre">'+ data[i].item_description +'</td>';
						html+='<td class="w-5">'+ qty +'</td>';
						html+='<td class="w-10">'+ price.toFixed(2) +'</td>';
						html+='<td class="w-10">'+ s_total.toFixed(2) +'</td>';
						html+='<td class="w-5"><div class="op-btn itemedit" id="'+data[i].item_id+'"><i class="fas fa-edit"></i></div></td>';
						html+='<td class="w-5"><div class="op-btn itemdelete" id="'+data[i].item_id+'"><i class="fas fa-trash-alt"></i></div></td>';
						html+='</tr>';
						total+=s_total;
					}
					html+='<tr>';
					html+='<td colspan="5" class="text-center">Total</td>';
					html+='<td>$'+total.toFixed(2)+'</td>';
					html+='</tr>';
					$('#tbItem').html(html);
					updatequote(quote,total);
				}
			})
		}
		readitem();
		
		$(document).on('click','.itemedit',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:'<?php echo base_url();?>index.php/querycontroller/edititem/'+id,
				data:$('#edititem').serialize(),
				type:'post',
				dataType:'json',
				success:function(data){
					$('#edititemModel').modal('show');
					$('#edititem_name').val(data[0].pro_id);
					$('#edititem_price').val(parseFloat(data[0].pro_price).toFixed(2));
					$('#edititem_qty').val(data[0].item_qty);
					$('#edititem_des').val(data[0].item_description);
					$('#edititem_id').val(data[0].item_id);
				}

			})
		});
		$('#update_item').click(function(){
			var id = $('#edititem_id').val();
			$.ajax({
				url:'<?php echo base_url();?>index.php/updatecontroller/updateitem/'+id,
				type:'post',
				data:$('#edititem').serialize(),
				dataType:'json',
				success:function(data){
					if(data.updated){
						swal({
							title:'Updated',
							icon:'info',
							timer:2000,
						});
						$('#edititemModel').modal('hide');
						readitem();
					}
				}
			});
		});
		$(document).on('click','.itemdelete',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:'<?php echo base_url();?>index.php/deletecontroller/deleteitem/'+id,
				dataType:'json',
				success:function(data){
					if(data.deleted){
						swal({
							title:'Deleted',
							icon:'success',
							timer:2000,
						});
						readitem();
					}
				}
			})
		})
		$('#item_name').change(function(){
			var id = $(this).val();
			if(id==0){
				$('#item_price').val(0);
			}
			else{
				$.ajax({
					url:"<?php echo base_url();?>index.php/querycontroller/queryprice/"+id,
					dataType:'json',
					success:function(data){
						$('#item_price').val(parseFloat(data[0].pro_price).toFixed(2));
					}
				});
			}
		});
		$('#add_item').click(function(){
			var item_name= $('#item_name').val();
			var item_price =$.trim($('#item_price').val());
			var item_qty = $.trim($('#item_qty'));
			if(item_name!=0&&item_price!=''&&item_qty!=''){
				$.ajax({
					url:'<?php echo base_url();?>index.php/insertcontroller/additem',
					type:'post',
					data:$('#item').serialize(),
					dataType:'json',
					success:function(data){
						if(data.inserted){
							swal({
								title:'Inserted',
								icon:'success',
								timer:2000,
							});
							$('#item')[0].reset();
							$('#itemModel').modal('hide');
							readitem();

						}
						else if(data.updated){
							swal({
								title:'Item Update',
								icon:'info',
								timer:2000,
							});
							$('#item')[0].reset();
							$('#itemModel').modal('hide');
							readitem();
						}
						else if(data.redir){
							window.location.href = "<?php echo base_url();?>index.php/viewcontroller/viewlogin";
						}
					}
				});
			}
			if(item_name==0){
				$('#item_error').text('Please Select');
			}
			else{
				$('#item_error').text('');
			}
			if(item_price==0){
				$('#price_error').text('Please Check Price');
			}
			else{
				$('#price_error').text('');
			}
			if(item_qty==''){
				$('#qty_error').text('Please Check Qty');
			}
			else{
				$('#qty_error').text('');
			}
		});
	});
</script>