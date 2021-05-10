<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap/bootstrap.min.css">
	<script src="<?php echo base_url(); ?>/public/bootstrap/bootstrap.min.js"></script>
	<style type="">
		.h-img img
		{
			width:20%;
		}
	</style>
</head>
<body>
	<div>
		<div class="head">
			<table style="width: 100%;" class="table-pdf">
				<tr>
					<td colspan="2">
						<div class="text-right h-img">
							<img src="<?php echo base_url();?>public/img/logo-zconnect.png">
						</div>
					</td>
				</tr>
				<?php foreach($info->result() as $infos): ?>
				<tr>
					<td class="w-50 text-left" style="vertical-align: top">
						<div class="h-mcus">
							<div class="h-cname">
								<b><?php echo $infos->cus_name; ?></b>
							</div>
							<div class="h-add">
								<?php echo $infos->cus_address; ?>
							</div>
							<div>
								<span>Phone: </span>
								<span><?php echo $infos->cus_phone; ?></span>
							</div>
							<div>
								<span>Email: </span>
								<span><?php echo $infos->cus_email; ?></span>
							</div>
						</div>
					</td>
					<td class="w-50 text-right" style="vertical-align: top">
						<div class="h-user">
							<div class="h-uaname">
								<b><?php echo $infos->us_fname.' '.$infos->us_lname; ?></b>
							</div>
							<div class="h-company-add">
								<?php echo $infos->us_address; ?>
							</div>
							<div class="h-usphone">
								<?php echo $infos->us_phone; ?>
							</div>
							<div class="h-q-date">
								<span>Quote Date: </span>
								<span><?php echo $infos->quote_cre_date ?></span>
							</div>
							<div class="h-q-ex">
								<span>Expires Date: </span>
								<span><?php echo $infos->quote_ex_date; ?></span>
							</div>
							<div>
								<span>Amount: </span>
								<span>$<?php echo number_format($infos->quote_amount,2); ?></span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-left">
						<div class="h-q-num">
							<span>Quote-</span>
							<span><?php echo $infos->quote_num; ?></span>
						</div>
					</td>
				</tr>
				<?php endforeach; ?>
			</table>
		</div>
		<div class="item">
			<table class="table table-striped table-bordered table-pdf">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Items</th>
						<th scope="col">Description</th>
						<th scope="col">Qty</th>
						<th scope="col">Price</th>
						<th scope="cos">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php $i =1;$total=0; ?>
					<?php foreach($quote->result() as $row): 
						$s_total= (int)$row->item_qty*(double)$row->pro_price;
					?>
						<tr>
							<th class="w-5 text-center" scope="row"><?php echo $i++ ?></th>
							<td class="w-30 cap"><?php echo $row->pro_name ?></td>
							<td class="w-45 pre"><?php echo $row->item_description ?></td>
							<td class="w-5 text-center"><?php echo $row->item_qty ?></td>
							<td class="w-10"><span>$<?php echo number_format($row->pro_price,2); ?></span></td>
							<td class="w-15"><span>$<?php echo number_format($s_total,2) ?></span></td>
						</tr>
						<?php $total+=$s_total;?>
					<?php endforeach; ?>
					<tr>
						<td colspan="5">Total</td>
						<td><span>$<?php echo number_format($total,2); ?></span></td>
					</tr>
				</tbody>
			</table>
			<div class="team table-pdf">
				<h5><b><i>Team and Condition</i></b></h5>
				<div>
					- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				</div>
				<div>
					- Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				</div>
			</div>
		</div>
	</div>
</body>
</html>
