<div class="main" id="main">	
	<div class="container-fluid">
		<div class="m-customer">
			<div class="mg-cus-btn mt-1 mb-1 text-right">
				<button class="btn-modal btn-primary" id="newcustomer" data-toggle="modal" data-target="#quoteModal">New Quote</button>
			</div>
			<table class="table table-bordered table-striped table-dark table-view">
				<thead>
					<tr>
						<th>No</th>
						<th>Status</th>
						<th>Q.Number</th>
						<th>Create</th>
						<th>Exprice</th>
						<th>Customer</th>
						<!-- <th>By</th> -->
						<th>Amount</th>
						<th colspan="4" class="text-center">Options</th>
					</tr>
				</thead>
				<tbody id="tbQuote">
					
				</tbody>
			</table>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" role="dialog" id="quoteModal">
		<div class="modal-dialog">
			<div class="modal-content kh-Ang form-product">
				<div class="modal-header">
					<h4 class="modal-title">New Quote</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form id="quote">
						<div class="form-group">
							<!-- <label>Quote Number*</label> -->
							<input type="hidden" name="q_num" id="q_num" class="form-control" placeholder="Customer Name">
						</div>
						<div class="form-group">
							<label>To Customer*</label>
							<select name="q_cus" class="custom-select" id="q_cus">
								<option value="0">Select</option>
								<?php foreach($cus as $row): ?>
									<option value="<?php echo $row->cus_id; ?>"><?php echo $row->cus_name; ?></option>
								<?php endforeach; ?>
							</select>
							<div class="text-warning" id="q_cus_error"></div>
						</div>
						<div class="form-group">
							<!-- <label>Amount*</label> -->
							<input type="hidden" name="q_amount" id="q_amount" class="form-control" value="0">
						</div>
						<input type="hidden" name="q_status" id="q_status" value="panding">
						<input type="hidden" name="q_on" id="q_on" value="<?php echo date('d/m/Y'); ?>">
						<input type="hidden" name="q_ex" id="q_ex" value="<?php echo date('d/m/Y', strtotime('+10 days')); ?>">
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn-modal" data-dismiss="modal">Cancel</button>
					<button class="btn-modal" id="add_quote">Add</button>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var my_url ='<?php echo base_url();?>index.php/';
		function setQNum(){
			$.ajax({
				url:my_url+'querycontroller/queryQnum',
				dataType:'json',
				success:function(data){
					var num = parseInt(data[0].num);
					var nums =num+1;
					if(data[0].num==null){
						$('#q_num').val('00001');
					}
					else{
						$('#q_num').val(String('00000'+nums).slice(-5));
					}
				}
			})
		};
		setQNum();

		function readquote(){
			$.ajax({
				url:my_url+'querycontroller/queryQuote',
				dataType:'json',
				success:function(data){
					var html;
					var i = 1;
					var x=1;
					for(i in data){
						html+='<tr>';
						html+='<td class="w-3" scope="row">'+ x++ +'</td>';
						html+='<td class="w-10">'+ data[i].quote_status; +'</td>';
						html+='<td class="w-5">Q-'+ data[i].quote_num +'</td>';
						html+='<td class="w-10">'+ data[i].quote_cre_date +'</td>';
						html+='<td class="w-10">'+ data[i].quote_ex_date; +'</td>';
						html+='<td class="w-40">'+ data[i].cus_name +'</td>';
						// html+='<td class="w-10">'+ data[i].us_fname+' '+data[i].us_lname; +'</td>';
						html+='<td class="w-10">$'+ parseFloat(data[i].quote_amount).toFixed(2) +'</td>';
						html+='<td class="w-3"><div class="op-btn edit" id="'+data[i].quote_id+'"><i class="fas fa-edit"></i></div></td>';
						html+='<td class="w-3"><div class="op-btn pdf" id="'+data[i].quote_id+'"><i class="fas fa-file-pdf"></i></div></td>';
						html+='<td class="w-3"><div class="op-btn inv" id="'+data[i].quote_id+'"><i class="fas fa-file-invoice"></i></div></td>';
						html+='<td class="w-3"><div class="op-btn delete" id="'+data[i].quote_id+'"><i class="fas fa-trash-alt"></i></div></td>';
						html+='</tr>';
					}
					$('#tbQuote').html(html);
					setQNum();
				}
			})
		}
		readquote();
		$(document).on('click','.delete',function(){
			var id = $(this).attr('id');
			$.ajax({
				url:my_url+'deletecontroller/deletequote/'+id,
				dataType:'json',
				success:function(data){
					if(data.deleted){
						swal({
							title:'Deleted',
							icon:'success',
							timer:2000,
						});
						readquote();
					}
				}
			})
		});
		$(document).on('click','.edit',function(){
			var id =$(this).attr('id');
			window.location.href = (my_url+'viewcontroller/viewItem/'+id);
		});
		function readInvNum(){
			var result='';
			$.ajax({
				async:false,
				url:'<?php echo base_url();?>index.php/querycontroller/queryInvNum',
				dataType:'json',

				success:function(data){
					var ivnum = parseInt(data[0].ivNum);
					var newIvNum= ivnum+1;
					if(data[0].ivNum==null){
						result = '00001';
					}
					else{
						result =  String('00000'+newIvNum).slice(-5);
					}
				}
			});
			return result;

		}
		$(document).on('click','.pdf',function(){
			var id = $(this).attr('id');
			$(this).attr('target', '_blank'); 
			window.open('<?php echo base_url();?>index.php/pdfcontroller/quotepdf/'+id);
		})
		$(document).on('click','.inv',function(){
			var id = $(this).attr('id');
			var ivNum =readInvNum();
			$.ajax({
				url:'<?php echo base_url();?>index.php/insertcontroller/addInvoice',
				type:'post',
				data:{iv_num:ivNum,iv_quote:id,iv_status:'panding'},
				dataType:'json',
				success:function(data){
					if(data.inserted){
						window.location.href="<?php echo base_url();?>index.php/viewcontroller/viewinvoice";
					}
					else if(data.exit){
						swal({
							title:'Quote Already Have',
							icon:'warning',
							timer:2000
						});
						function redi(){
							window.location.href="<?php echo base_url();?>index.php/viewcontroller/viewinvoice";
						};
						setTimeout(redi,2100);

						
					}
					else if(data.redir){
						window.location.href="<?php echo base_url();?>index.php/viewcontroller/viewlogin";
					}

				}
			})
		})
		$("#add_quote").click(function(){
			var cusId = $('#q_cus').val();
			if(cusId!=0){
				$('#q_cus_error').text('');
				$.ajax({
					url:my_url+'insertcontroller/addquote',
					type:'post',
					data:$('#quote').serialize(),
					dataType:'json',
					success:function(data){
						if(data.success){
							swal({
								title:'Inserted',
								icon:'success',
								timer:2000,
							});
							$('#quoteModal').modal('hide');
							$('#quote')[0].reset();
							readquote();
						}
						else if(data.update){
							swal({
								title:'Data Update',
								icon:'warning',
								timer:2000,
							})
							$('#quoteModal').modal('hide');
							$('#quote')[0].reset();
							readquote();
						}
						else if(data.redi){
							window.location.href = my_url+'viewcontroller/viewlogin';
						}

					}
				})
			}
			else{
				$('#q_cus_error').text('Please Select Customer');
			}
			
		});
	});
</script>