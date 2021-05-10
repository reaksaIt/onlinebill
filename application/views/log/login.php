<div class="register pt-5">
	<div class="r-register">
		<div class="r-form">
			<div class="text-center">
				<h3>Login</h3>
			</div>
		</div>
		<form id="login">
			<div class="row">
				<div class="col-sm-12 col-md-12 col-xl-12">
					<div class="form-group">
						<label>Email*</label>
						<input type="text" name="email" class="form-control" autocomplete="off">
						<div class="text-warning" id="e_error"></div>
					</div>

				</div>
				<div class="col-sm-12 col-md-12 col-xl-12">
					<div class="form-group">
						<label>Password*</label>
						<input type="password" name="password" class="form-control" autocomplete="false" id="password">
						<div class="text-warning" id="pass_error"></div>
					</div>

				</div>
			</div>
		</form>
		<div class="form-group mt-3 text-center">
			<button class="btn-default" id="sign_in">Sign In</button>
		</div>
		<hr class="hr-form">
		<div class="form-group text-center">
			<a href="<?php echo base_url(); ?>index.php/viewcontroller/register">Create new account</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#sign_in').click(function(){
			function isEmail(email) {
				var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				return regex.test(email);
			};
			var email = $.trim($("input[name='email']").val());
			var password = $.trim($('#password').val());
			if(isEmail(email)!=''){
				$('#e_error').text('');
			}
			else{
				$('#e_error').text('Please input your email');
			}
			if(password!=''){
				$('#pass_error').text('');
			}
			else{
				$('#pass_error').text('Please input your password');
			}
			if(isEmail(email)!=''&&password!=''){
				$.ajax({
					url:'<?php echo base_url(); ?>index.php/querycontroller/login',
					type:'post',
					data:$('#login').serialize(),
					dataType:'json',
					success:function(data){
						if(data.success){
							window.location.replace('<?php echo base_url()?>');
						}
						else if(data.fail){
							swal({
								title:'Please try again !!',
								icon:'warning',
								timer:2000,
							})
						}
					}
				})
			}

		});
	});
</script>