<div class="register pt-3">
	<div class="r-register">
		<div class="r-form">
			<div class="text-center">
				<h3>Register</h3>
			</div>
		</div>
		<form id="register">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-xl-6">
					<div class="form-group">
						<label>First Name*</label>
						<input type="text" name="fname" class="form-control" autocomplete="off" placeholder="First Name" id="fname">
						<div class="text-warning" id="f_error"></div>
					</div>

				</div>
				<div class="col-sm-12 col-md-6 col-xl-6">
					<div class="form-group">
						<label>Last Name*</label>
						<input type="text" name="lname" class="form-control" autocomplete="false" placeholder="Last Name" id="lname">
						<div class="text-warning" id="l_error"></div>
					</div>

				</div>
				<div class="col-sm-12 col-md-6 col-xl-6">
					<div class="form-group">
						<label>Gender*</label>
						<select class="custom-select" id="gender" name="gender">
							<option value="0">Select</option>
							<option value="male">Male</option>
							<option value="female">Female</option>
						</select>
						<div class="text-warning" id="gen_error"></div>
					</div>

				</div>
				<div class="col-sm-12 col-md-6 col-xl-6">
					<div class="form-group">
						<label>Permission*</label>
						<select class="custom-select" id="permission" name="permission">
							<option value="0">Select</option>
							<?php foreach ($rule as $row):?>
								<option value="<?php echo $row->rule_id; ?>">
									<?php echo $row->rule_type; ?>
								</option>
							<?php endforeach; ?>
						</select>
						<div class="text-warning" id="per_error"></div>
					</div>
					
				</div>
				<div class="col-sm-12 col-md-12 col-xl-12">
					<label>Email*</label>
					<input type="text" name="email" class="form-control" id="email">
					<div class="text-warning" id="e_error"></div>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-6">
					<label>Password*</label>
					<input type="password" name="password" class="form-control" id="password">
					<div class="text-warning" id="pass_error"></div>
				</div>
				<div class="col-sm-12 col-md-6 col-xl-6">
					<label>Confirm Password*</label>
					<input type="password" name="cpassword" class="form-control" id="cpassword">
					<div class="text-warning" id="cpass_error"></div>

				</div>
			</div>
			<input type="hidden" name="create_on" value="<?php echo date('d/m/Y'); ?>">
		</form>
		<div class="form-group mt-3 text-center">
			<button class="btn-default" id="sign_up">Sign Up</button>
		</div>
		<hr class="hr-form">
		<div class="form-group text-center">
			<a href="<?php echo base_url(); ?>index.php/viewcontroller/viewlogin">Already have account</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var main_url ='<?php echo base_url()?>index.php/';
			function checkpass(){
				var password = $.trim($('#password').val());
				if(password.length<6){
					$("#pass_error").text('must be 6 char or more');
					$('#sign_up').attr('disabled',true);
					$('#cpassword').attr('disabled',true);
				}
				else{
					$("#pass_error").text('');
					$('#sign_up').attr('disabled',false);
					$('#cpassword').attr('disabled',false);
				}
				if(password==""){
					$('#cpassword').val('');
					$("#cpass_error").text('');
				}
			};
			$('#password').change(function(){
				checkpass();
			});
			$('#cpassword').change(function(){
				var password = $.trim($('#password').val());
				var cpassword = $.trim($(this).val());
				if(cpassword!=password){
					$('#cpass_error').text('Not match !');
					$('#sign_up').attr('disabled',true);
				}
				else{
					$("#cpass_error").text('');
					$('#sign_up').attr('disabled',false);
				}
			});
			$('#sign_up').click(function(){
				function isEmail(email) {
					var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
					return regex.test(email);
				}

			var fname = $.trim($('#fname').val());
			var lname = $.trim($('#lname').val());
			var gender = $('#gender').val();
			var permission = $('#permission').val();
			var email = $.trim($("input[name='email']").val());
			var password = $.trim($('#password').val());
			var cpassword = $.trim($('#cpassword').val());
			if(fname!=""&&lname!=""&&gender!=0&&permission!=0&&email!=""&&password!=""&&cpassword!=""){
				$.ajax({
					url:main_url+'insertcontroller/register',
					data:$("#register").serialize(),
					type:'post',
					dataType:'json',
					success: function(data)
					{
						if(data.success){
							swal({
								title:'Inserted',
								icon:'success',
								timer:2000, 

							});
							$('#register')[0].reset();
						}
						else if(data.error){
							swal({
								title:'User Already Have',
								icon:'warning',
								timer:2000,
							});
						}
					}
					
				})
			}
			
				if(fname!=""){
					$('#f_error').text('');
				}
				else{
					$('#f_error').text('Please fill!');
				}

				if(lname!=""){
					$('#l_error').text('');
				}
				else{
					$('#l_error').text('Please fill!');
				}
				if(gender==0){
					$('#gen_error').text('Please fill!');
				}
				else{
					$('#gen_error').text('');
				}
				if(permission==0){
					$('#per_error').text('Please fill!');
				}
				else{
					$('#per_error').text('');
				}

				if(isEmail(email)==""){
					$('#e_error').text('Please include @gmail.com');
				}
				else{
					$('#e_error').text('');
				}
				if(password!=""){
					$('#pass_error').text('');
					$('#cpassword').attr('disabled',false);
				}
				else{
					$('#pass_error').text('Please fill!');
					$('#cpassword').attr('disabled',true);
				}
				if(cpassword!=""){
					$('#cpass_error').text('');
				}
				else{
					$('#cpass_error').text('Please fill!');
				}
		});
	});
</script>