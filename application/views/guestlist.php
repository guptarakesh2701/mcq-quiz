<div class="message">
    <div class="row">
        <div class="col-md-12">
            <p>
            	Guest List
            	<button class="btn btn-danger" onclick="location.href='<?php echo base_url('adminlogout') ?>'" style="margin-left: 500px;">Logout</button>
            </p>
        </div>
    </div>
</div>

<main>
    <div class="container">
        <div class="row">
            <table id="guestlist" class="table table-bordered cell-border compact stripe">
		        <thead>
		            <tr>
		                <th>Name</th>
		                <th>Email</th>
		                <th>Phone</th>
		                <th>Score</th>
		            </tr>
		        </thead>
		        <tbody>

		        	<?php foreach ($results as $key) { ?>
		        		<tr>
			                <td><?php echo $key['name'] ?></td>
			                <td><?php echo $key['email'] ?></td>
			                <td><?php echo $key['phone'] ?></td>
			                <td><?php echo $key['score'] ?></td>
			            </tr>
		        	<?php } ?>
		            
		        </tbody>
		    </table>
        </div>
    </div>
</main>

<script>
	$(document).ready(function() {
       $('#guestlist').DataTable();
   	});
</script>
