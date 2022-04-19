<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Products | Microfluid Process Equipment</title>
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

  <main id="main">
    <!-- <hr style="margin: 2% 10%;background: #b5b5b5;" /> -->
    <!-- ======= Product Section ======= -->
    <section class="product container-fluid" id="product">
      <div class="row col-md-12 col-lg-12 col-sm-12 col-xs-12 m-0">
        <!-- Product category and sub category sidebar section end-->
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="border-right: 1px solid var(--primary_color);">
          <div class="list-group product-list-group">
              <?php $product_cat_tab = $query_obj->getAllProductCategories(); //get all product category
                  if ($product_cat_tab->num_rows > 0) {
                    while($cat = $product_cat_tab->fetch_assoc()) { ?>
                      <a href="<?php echo BASE_URL.'/products.php?category_id='.$cat['id'] ?>" class="product-list-group-item list-group-item text-black product-cat letter-spacing" data-sc_cat="<?php echo $cat['c_code'] ?>"><?php echo $cat['c_name'] ?></a>

                        <!-- Product sub category sidebar section start-->
                        <div class="list-group product-cat-filter <?php echo 'product-cat-filter-'.$cat['c_code']; ?>" data-sc_cat="<?php echo $cat['c_code']; ?>" style="display: none;">
                          <?php $products_tab = $query_obj->getProductSubCategoryByCategoryID($cat['id']); //get category wise products product
                          if ($products_tab->num_rows > 0) { 
                            while($product = $products_tab->fetch_assoc()) { ?>
                                <a href="<?php echo BASE_URL.'/products.php?category_id='.$cat['id'].'&sub_cat_id='.$product['id']?>" class="product-item list-group-item text-black"><?php echo $product['sc_name'] ?></a>
                          <?php } ?>
                         <?php } ?> 
                        </div>
                        <!-- Product sub category sidebar section end-->
                   <?php } ?>
                  <?php } ?> 
          </div> 
        </div>
        <!-- Product category and sub category sidebar section end-->
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container about-us-blocks " style="margin: unset;">
          <!-- Display Product Sub Category title, description start-->
          <?php 
            $category_id = $_GET['category_id'];
            $sub_cat_id = (isset($_GET['sub_cat_id']))?$_GET['sub_cat_id']:0; ?>
          <?php 
            if($sub_cat_id){
              $product_tab = $query_obj->getProductSubCategoryDataBySubCatID($sub_cat_id); //get sub category wise products product
            }else{
              $product_tab = $query_obj->getProductCategoryDataByCatID($category_id); //get category wise products product
            } 
            if ($product_tab->num_rows > 0) { 
              while($title_product = $product_tab->fetch_assoc()) { 
                if($sub_cat_id){ ?>
                  <h2 class="primary-text header-font-size"><?= $title_product['sc_name']; ?></h2>
                  <p><?= $title_product['sc_description'] ?></p>
                <?php }else{ ?>
                  <h2 class="primary-text header-font-size"><?= $title_product['c_name']; ?></h2>
                  <p><?= $title_product['c_description'] ?></p>
                <?php } ?>  
              <?php } ?>
            <?php } ?> 
          
           
          <!-- Display Product Sub Category title, description end-->
          <!-- Display Category wise Products start-->
          <div class="row services">
          <?php 
          $product_data = $query_obj->getProductByCategoryID($category_id,$sub_cat_id);
          if ($product_data && $product_data->num_rows > 0) { 
            while($product = $product_data->fetch_assoc()) { ?>
              <div class="col-lg-4 col-md-6 align-items-stretch min-height310  " >
                <div class="icon-box rounded shadow mb-5">
                  <div class="icon">
                    <img alt="<?= $product['p_name']; ?>" src="<?= $product['p_image']; ?>">
                  </div>
                  <h4><a href="<?= 'product.php?id='.$product['id']; ?>" class="service_name primary-text"><?= $product['p_name']; ?></a></h4>
                  <p  class="text-left"><?= substr($product['p_description'], 0, 100) . ' ...';; ?></p>
                </div>
              </div>
            <?php } ?>
          <?php } ?>  
          <br>   
        </div>
        <!-- Display Category wise Products end-->
        </div>
      </div>
    </section><!-- End Product Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>
  <!-- End Footer -->

</body>
</html>