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

    <!-- ======= View Product Section ======= -->

    <?php $product_cat_tab = $query_obj->getProductDetailsByID($_GET['id']); //get all product category
      if ($product_cat_tab->num_rows > 0) {
        while($cat = $product_cat_tab->fetch_assoc()) { ?>

        <?php } ?>
      <?php } ?> 
   <section class="row col-md-12 product container-fluid" id="product">
    <div class="col-md-4" style="border-right: 1px solid black;">
      <div class="my-product-slides">
        <div class="image-number-text">1 / 2</div>
        <img src="<?php echo BASE_URL.'/assets/img/application/pump.jpeg'; ?>" class="product_active_img">
      </div>

      <div class="my-product-slides">
        <div class="image-number-text">2 / 2</div>
        <img src="<?php echo BASE_URL.'/assets/img/application/lobe-pump.jpg'; ?>" class="product_active_img">
      </div>

      <a class="prev_arrow prev-product-img" data-slide_count="-1">❮</a>
      <a class="next_arrow next-product-img" data-slide_count="1">❯</a>

      <div class="row col-md-12">
      <div class="col-md-5">
        <img class="product-image product-cursor " src="<?php echo BASE_URL.'/assets/img/application/pump.jpeg'; ?>" style="width: 100px;height: auto;" data-slide="1">
      </div>
      <div class="col-md-5">
        <img class="product-image product-cursor " src="<?php echo BASE_URL.'/assets/img/application/lobe-pump.jpg'; ?>" style="width: 100px;height: auto;" data-slide="2">
      </div>
    </div>
    <div class="col-md-8">
    </div>

    

   </section>

    <!-- End View Product Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>
  <!-- End Footer -->

</body>
</html>