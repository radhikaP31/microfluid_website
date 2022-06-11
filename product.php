<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Product | Microfluid Process Equipment</title>
  <meta content="high pressure pump product, high pressure homogenizer and other process equipments" name="description">
  <meta content="homogenizer, high pressure homogenizer,milk homogenizer,icecream homogenizer,pressure homogenizer,microfluid,dairy,process,icecream process,equipment" name="keywords">

  <!-- head starts -->
  <?php include 'head.php'; ?>
  <!-- head end -->

</head>

<body>

  <!-- Header starts -->
  <?php //include 'header.php'; ?>
  <?php include 'header_scroll.php'; ?>
  <!-- Header end -->

  <main id="main" data-page="product">
    <!-- <hr style="margin: 2% 10%;background: #b5b5b5;" /> -->

    <?php 
      $product_id = $_GET['id']; 
    ?>
    <!-- ======= View Product Section ======= -->
   <!--  <?php

    if(isset($product_id)){
      //header("Location: ".BASE_URL."'/products.php?category_id=1'");
      $product_id = $product_id;
    }else{ ?>
      <script type="text/javascript">
      window.location = BASE_URL+'/products.php?category_id=1';
      </script>  
      
    <?php }?> -->
     
   <section class="row col-md-12 product container-fluid" id="product" style="padding-right: 0%;margin: 0px;padding-left: 0px;">
    <?php $product_detail = $query_obj->getProductDetailsByID($product_id); //get product details
    if ($product_detail && $product_detail->num_rows > 0) { //product start 1
      while($product = $product_detail->fetch_assoc()) { //product start 2 ?> 
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container" style="    padding-bottom: 2%;">
          <h2 class="primary-text header-font-size"><?= $product['p_name']; ?></h2>
        </div>
        <div class="col-md-4" style="border-right: 1px solid black;">
          <?php $p_image_detail = $query_obj->getProductImagesByProductID($product_id); //get product images
          if ($p_image_detail && $p_image_detail->num_rows > 0) { //product image start 1
            while($image = $p_image_detail->fetch_assoc()) { //product image start 2 ?>
          
            <div class="my-product-slides">
              <div class="image-number-text">1 / 2</div>
              <img src="<?= BASE_URL.'/'.$image['img_path']; ?>" class="product_active_img">
            </div>

            <?php } //product image end 1 ?>
          <?php } //product image end 2 ?>

            <a class="prev_arrow prev-product-img" data-slide_count="-1">
              <span class="iconify secondary-text" data-icon="ic:round-keyboard-double-arrow-left" data-width="32" data-height="32"></span>
            </a>
            <a class="next_arrow next-product-img" data-slide_count="1">
              <span class="iconify secondary-text" data-icon="ic:round-keyboard-double-arrow-right" data-width="32" data-height="32"></span>
            </a>

            <div class="row col-md-12">
              <?php $p_image_detail = $query_obj->getProductImagesByProductID($product_id); //get product images
              if ($p_image_detail && $p_image_detail->num_rows > 0) { //product image start 1
                $count = 1;
                while($image = $p_image_detail->fetch_assoc()) { //product image start 2 ?>
                  <div class="col-md-4">
                    <img class="product-image product-cursor " src="<?= BASE_URL.'/'.$image['img_path']; ?>" style="width: auto; height: 70px;" data-slide="<?= $count; ?>">
                  </div>

                <?php $count++; } //product image end 2 ?>
              <?php } //product image end 1 ?>
            </div>
        </div>
        <div class="col-md-8">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container" style="    padding-bottom: 2%;">
            <p><?= $product['p_description']; ?></p>
          </div>
          <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12 container" style="padding-bottom: 2%;">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <a href="#" class="btn prod_desc_btn" data-toggle="modal" data-target="#req_quote">
                <img src="assets/img/icons/quote.png" style="height: 96px; width: auto;" /><span class="header-font-size">Request Quote</span></a>
            </div>
          </div>
        </div>
        <hr style="width: 100%;border-top: 1px solid var(--secondary_color);    margin-bottom: 0px;">
          <nav class="navbar navbar-expand-lg navbar-light bg-light secondary-page-menu">
            <div class="" id="navbarNav">
              <ul class="navbar-nav">
                <?php $product_keys = $query_obj->getProductKeysByProductID(); //get product keys

                  if ($product_keys && $product_keys->num_rows > 0) { //product key start 1
                    $count = 1;
                    while($key = $product_keys->fetch_assoc()) { //product key start 2 ?>
                      <li class="nav-item active">
                        <a class="nav-link product-feature" href="#<?= $key['tab_name']; ?>"  style="font-size: 13px;"><?= $key['key_name']; ?></a>
                      </li>
                    <?php $count++; } //product key end 2 ?>
                  <?php } //product key end 1 ?>

              </ul>
            </div>
          </nav>

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 container" style="    padding-bottom: 2%;">
            <?php $product_keys = $query_obj->getProductKeysByProductID(); //get product keys

            if ($product_keys && $product_keys->num_rows > 0) { //product key start 1
              $count = 1;
              while($key = $product_keys->fetch_assoc()) { //product key start 2 ?>
                <div id="<?php echo $key['tab_name']; ?>">
                  
                  <h4 class="primary-text header-font-size" style="text-align: left;padding-left: 7px;"><?php echo $key['key_name']; ?></h4>
                  <?php echo $key['description']; ?><br><br>
                </div>
              <?php $count++; } //product key end 2 ?>
            <?php } //product key end 1 ?>

          </div>


      <?php } //product 2 end ?>
    <?php } //product 1 end ?>

   </section>
    <!-- End View Product Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>
  <!-- End Footer -->

</body>
</html>

<script type="text/javascript">
  //product page js start
let slideIndex = 1;
showSlides(slideIndex);

$('.prev-product-img,.next-product-img').click(function() {
  showSlides(slideIndex += jQuery(this).data('slide_count'));
});

$('.product-cursor').click(function() {
  showSlides(slideIndex = jQuery(this).data('slide'));
});

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("my-product-slides");
  let dots = document.getElementsByClassName("product-image");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active_product", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active_product";
}
//product page js end
</script>