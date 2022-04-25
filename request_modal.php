<!-- <?php 
if(isset($_GET['id'])){
//exit(header("Location: ".BASE_URL."'/products.php?category_id=1'"));
  header("Location: ".BASE_URL."'/products.php?category_id=1'");
  $product_id = $_GET['id'];
}else{ ?>
  <script type="text/javascript">
  window.location = BASE_URL+'/products.php?category_id=1';
  </script>  
<?php }?> -->

<?php 
if(isset($_GET['id'])){ //id condition starts
	$product_detail = $query_obj->getProductDetailsByID($_GET['id']); //get product details
	    if ($product_detail->num_rows > 0) { //product start 1
	      while($product = $product_detail->fetch_assoc()) { //product start 2 ?> 

	<div class="modal" id="req_quote" role="dialog">
	    <div class="modal-dialog modal-lg">
		    <div class="modal-content">   
				<div class="modal-header">
					<span  style="font-color:white;">Inquiry for <?= $product['p_name']; ?></span>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">  
					<form action="<?php echo BASE_URL.'/forms/contact.php'; ?>" method="post" role="form" class="php-email-form">
						<div class="form-row">
			                <div class="col-md-6 form-group">
			                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="required" data-msg="Please Enter Your Name" />
			                  <div class="validate"></div>
			                </div>
			                <div class="col-md-6 form-group">
			                  <input type="text" name="company" class="form-control" id="company" placeholder="Your Company Name" data-rule="required" data-msg="Please Enter Your Company Name" />
			                  <div class="validate"></div>
			                </div>
			            </div>
			           	<div class="form-row">
			                <div class="col-md-6 form-group">
			                  <input type="text" class="form-control" name="area" id="area" placeholder="Your Area"/>
			                </div>
			                <div class="col-md-6 form-group">
			                  <input type="text" class="form-control" name="country" id="country" placeholder="Your Country"/>
			                </div>
			            </div>
			           	<div class="form-row">
			                <div class="col-md-6 form-group">
			                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Contact Number"/>
			                </div>
			                <div class="col-md-6 form-group">
			                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
			                  <div class="validate"></div>
			                </div>
			            </div>
			            <div class="form-group">
			                <textarea class="form-control" name="message" rows="5"  placeholder="Message"></textarea>
			                <div class="validate"></div>
			            </div>
			            <input type="hidden" class="form-control" name="product_id" id="product_id" value="<?= $_GET['id']; ?>"/>
			            <input type="hidden" class="form-control" name="form_name" id="form_name" value="product_inquiry"/>
			            <div class="mb-3">
			                <div class="loading"></div>
			                <div class="error-message"></div>
			                <div class="sent-message"></div>
			            </div>
			            <div class="text-center"><button type="submit" class="btn btn-primary">Request Quote</button></div>
		            </form>
				</div>
	  	  	</div>
		</div>
	</div>
		<?php } //product image end 1 ?>
	<?php } //product image end 2 ?>
<?php } //id condition end?>