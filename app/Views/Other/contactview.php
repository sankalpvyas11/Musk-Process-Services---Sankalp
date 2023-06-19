<?= $this->extend('layouts/base'); ?>

<!-- putting the data into the section -->
<?= $this->section('content'); ?>
<section>
  <div class="container">
    <div class="row">
		<div class="col-lg-12">
			<h1 class="mt-4 text-primary">Contact Us</h1>
			<h2 class="text-primary">To get in touch, please complete this form, or call us on: +44 1698 381224</h2>
			<form action="/action_page.php">
			   <div class="form-group">
				<label for="pwd">Name</label>
				<input type="text" class="form-control" placeholder="Enter your name" id="name">
			  </div>
			  <div class="form-group">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" placeholder="Enter email address" id="email">
			  </div>
			  <div class="form-group">
				<label for="email">Mobile</label>
				<input type="text" class="form-control" placeholder="Enter mobile number" id="mobile">
			  </div>
			  
			  <div class="form-group">
				<label for="email">Message</label>
				<textarea class="form-control" id="msg"></textarea>
			  </div>
			  
			  <button type="submit" class="btn btn-primary">Submit</button>
			 
			</form>
		   <div class='pb-5'></div>
		</div>
	</div>
	</div>
			
		</section>


<?= $this->endSection();  ?>