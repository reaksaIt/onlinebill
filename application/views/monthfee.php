<div class="container-fluid">
	<div class="modal fade" role="dialog" id="calModal">
		<div class="modal-dialog">
			<div class="modal-content kh-Ang form-product">
				<div class="modal-header">
					<h4 class="modal-title">Calculator Monthly Fee</h4>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form method="post">
						<div class="form-group">
							<label>Total</label>
							<input type="text" class="form-control" name="total" placeholder="Total" id="total">
						</div>
						<div class="form-group">
							<label>Month</label>
							<input type="text" class="form-control" name="month" placeholder="Monthly" id="month">
						</div>
						<div class="form-group">
							<label>Rat</label>
							<input type="text" class="form-control" name="rat" placeholder="Rat" id="rat">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button class="btn-modal" data-dismiss="modal">Cancel</button>
					<button class="btn-modal" id="btncal">Calculator</button>
				</div>
			</div>
		</div>
	</div>
	<div class="text-right mt-1 mb-1">
		<button class="btn-modal btn-primary" data-toggle="modal" data-target="#calModal">Calculator</button>
	</div>
	<table class="table table-striped table-dark table-bordered">
		<thead>
			<tr>
				<th>Month</th>
				<th>Balance</th>
				<th>Rat</th>
				<th>Monthly Fee</th>
				<th>Total Fee / Month</th>
			</tr>
		</thead>
		<tbody id="tbcal">
			
		</tbody>
	</table>
	

</div>
<script type="text/javascript">
	$(document).ready(function(){
		function calbalance(){
			var balance = parseFloat($('#total').val());
			var month = parseInt($('#month').val());
			var rat = parseFloat($('#rat').val());
			var i,html,fee;
			var totalrat=0,totalmonthfee=0,totalfee=0;
			for(i=month;i>0;i--){
				var tbalance = balance/i;
				
				trat = balance*rat;
				mtotal=trat+tbalance;
				html+='<tr><td>'+ i +'</td>';
				html+='<td>'+balance.toFixed()+'៛</td>';
				html+='<td>'+trat.toFixed()+'៛</td>';
				html+='<td>'+tbalance.toFixed()+'៛</td>';
				html+='<td>'+mtotal.toFixed()+'៛</td>';
				html+='</tr>';
				balance-=tbalance;
				totalrat+=trat;
				totalmonthfee+=tbalance;
				totalfee+=mtotal;

				
			}
			html+='<tr>';
			html+='<td colspan="2">Total</td>';
			html+='<td>'+totalrat.toFixed()+'៛</td>';
			html+='<td>'+totalmonthfee.toFixed()+'៛</td>';
			html+='<td>'+totalfee.toFixed()+'៛</td>';
			html+='</tr>';
			$('#tbcal').html(html);
		};

		$('#btncal').click(function(){
			calbalance();
			$('#calModal').modal('hide');
		});

	});
</script>
