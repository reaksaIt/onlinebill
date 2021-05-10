<div class="main" id="main">	
	<div class="container-fluid">
		<div class="m-customer">
			<!-- <div class="mg-cus-btn mt-1 mb-1 text-right">
				<button class="btn-modal btn-primary" id="newinvoice" data-toggle="modal" data-target="#invoiceModal">New Invoice</button>
			</div> -->
			<table class="table table-striped table-bordered table-dark table-view">
				<thead>
					<tr>
						<th>No</th>
						<th>Status</th>
						<th>Iv.Number</th>
						<th>Create</th>
						<th>Expired</th>
						<th>Customer</th>
						<th>Amount</th>
						<th>Paid</th>
						<th>Balance</th>
						<th colspan="3" class="text-center">Options</th>
					</tr>
				</thead>
				<tbody id="tbInvoice">
					
				</tbody>
			</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" role="dialog" id="payModal">
		<div class="modal-dialog">
			<div class="modal-content kh-Ang form-product">
				<div class="modal-header">
					<h4 class="modal-title">
						Payment
					</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="payment">
						<div class="form-group">
							<label>Amount</label>
							<input type="text" name="amount" id="amount" class="form-control">
						</div>
						<div class="form-group">
							<label>Pay</label>
							<input type="text" name="paid" id="paid" class="form-control" autocomplete="off">
							<div class="text-warning" id="paid_error"></div>
						</div>
						<div class="form-group">
							<label>Balance</label>
							<input type="text" name="balance" class="form-control" id="balance">
						</div>
						<div class="form-group">
							<label>Note</label>
							<textarea rows="4" class="form-control" name="note" id="pay_note" placeholder="Note"></textarea>
						</div>
						<input type="hidden" name="up_id" id="up_id">
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn-modal" data-dismiss="modal">Cancel</button>
					<button class="btn-modal" id="update_payment">Pay</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		function readInvoice(){
			$.ajax({
				url:'<?php echo base_url();?>index.php/querycontroller/queryInvoice',
				dataType:'json',
				success: function(data){
					var html;
					var i =0;
					var x=1;
					for(i in data){
						html+='<tr>';
						html+='<td class="w-4">'+ x++ +'</td>';
						html+='<td class="w-7">'+ data[i].iv_status+'</td>';
						html+='<td class"w-10>I-'+ data[i].iv_num+'</td>';
						html+='<td class="w-10">'+ data[i].iv_date+'</td>';
						html+='<td class="w-10">'+ data[i].iv_ex_date+'</td>';
						// html+='<td class="w-">'+ data[i].us_fname+' '+data[i].us_lname+'</td>';
						html+='<td class="w-30">'+ data[i].cus_name+'</td>';
						html+='<td class="w-10">$'+ parseFloat(data[i].quote_amount).toFixed(2)+'</td>';
						html+='<td class="w-10">$'+ parseFloat(data[i].iv_paid).toFixed(2)+'</td>';
						html+='<td class="w-10">$'+ parseFloat(data[i].iv_balance).toFixed(2)+'</td>';
						// html+='<td class="w-">'+data[i].iv_note+'</td>';
						html+='<td class="w-3"><div class="op-btn ivpay" id="'+data[i].iv_id+'"><i class="fas fa-money-check-alt"></i></div></td>';
						html+='<td class="w-3"><div class="op-btn ivpdf" id="'+data[i].iv_id+'"><i class="fas fa-file-pdf"></i></div></td>';
						html+='<td class="w-3"><div class="op-btn ivdelete" id="'+data[i].iv_id+'"><i class="fas fa-trash-alt"></i></div></td>';
						html+='</tr>';
					}
					$('#tbInvoice').html(html);
				}
			})
		};
		readInvoice();
		$(document).on('click','.ivpay',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:'<?php echo base_url();?>index.php/querycontroller/queryAmount/'+id,
				dataType:'json',
				success: function(data){
					var amount = parseFloat(data[0].quote_amount);
					$('#amount').val(amount.toFixed(2));
					$('#up_id').val(data[0].iv_id);s


				}
			});
			$('#payModal').modal('show');

		});
		$('#paid').keyup(function(){
			var paid = parseFloat($(this).val());
			if($.isNumeric(paid)){
				$('#paid_error').text('');
				var amount = parseFloat($('#amount').val());
				if(paid>amount){
					$('#paid_error').text('Your payment is wrong!!');
					$('#balance').val(amount.toFixed(2));
					$('#update_payment').attr('disabled',true);
				}else{
					$('#update_payment').attr('disabled',false);
					$('#paid_error').text('');
					var balance = amount-paid;
					$('#balance').val(balance.toFixed(2));
				}
			}
			else{
				$(this).val('');
				$('#paid_error').text('Number Only');
			}

		})
		$('#update_payment').click(function(){
			$.ajax({
				url:'<?php echo base_url()?>index.php/updatecontroller/updateInvoice',
				data:$('#payment').serialize(),
				type:'post',
				dataType:'json',
				success:function(data){
					if(data.inserted){
						swal({
							title:'Inserted',
							icon:'success',
							timer:2000
						});
						$('#payModal').modal('hide');
						$('#payment')[0].reset();
						readInvoice();
					}
				}

			});
		});
		$(document).on('click','.ivdelete',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:'<?php echo base_url();?>index.php/deletecontroller/deleteInvoice/'+id,
				dataType:'json',
				success:function(data){
					if(data.deleted){
						swal({
							title:'Deleted',
							icon:'success',
							timer:2000
						});
						readInvoice();
					}
				}
			})
		});
	})
</script>