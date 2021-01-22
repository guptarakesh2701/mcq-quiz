<style>
	.error-msg {
		text-align: center;
		color: #FF0000;
		display: none;
	}
</style>

<div class="message">
    <div class="row">
        <div class="col-md-12">
            <p>Admin Login Area</p>
        </div>
    </div>
</div>

<main>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <?php echo form_open('guestlist', array('id' => 'adminlogin','autocomplete' => 'off')); ?>
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" name="username" class="form-control" required="" value="<?php echo set_value('username'); ?>" placeholder="Enter your username" autofocus>
                    <?php echo form_error('username'); ?>
                </div>

                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" required="" value="<?php echo set_value('password'); ?>" placeholder="Enter your password">
                    <?php echo form_error('password'); ?>
                </div>
                <h4 class="error-msg">Invalid username or password.</h4>
                <br>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</main>

<script>
	$('#adminlogin').submit(function(e) {
	    var form = $(this);
	    e.preventDefault();
	    $.ajax({
	        type: "POST",
	        url: form[0].action,
	        data: form.serialize(),
	        dataType: "json",
	        success: function(data){
	            if(data.flag == 1){
	            	location.href = data.redirect;
	            } else {
	            	$('.error-msg').show().delay(5000).fadeOut();
	            }
	        },
	        error: function(data){
	        	console.log(data);
	        }
	   });

	});
</script>
