<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>About | Microfluid Process Equipment</title>
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
    <!-- ======= About Us Section ======= -->
    <section class="about-us container-fluid" id="about-us">
      <div class="row col-md-12 col-lg-12 col-sm-12 col-xs-12 m-0">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="border-right: 1px solid var(--primary_color);">
          <div class="about-list-group">
              <?php $about_tab = $query_obj->getAboutUsInformation(); 
                  if ($about_tab->num_rows > 0) { 
                    while($about = $about_tab->fetch_assoc()) { ?>
                      <a href="javascript:void(0)" class="list-group-item text-black block-filter" data-block_type="<?php echo $about['tab_name'] ?>"><?php echo $about['name'] ?></a>
                   <?php } ?>
                  <?php } ?> 
          </div> 
          <!-- <nav class="navbar navbar-default block-filter-section" style="display: block;">
            <ul class="about-us-nav nav navbar-nav">
              <?php $about_tab = $query_obj->getAboutUsInformation(); 
                  if ($about_tab->num_rows > 0) { 
                    while($about = $about_tab->fetch_assoc()) { ?>
                      <li class="block-filter" data-block_type="<?php echo $about['tab_name'] ?>">
                        <a href="javascript:void(0)" class="text-black"><?php echo $about['name'] ?></a>
                      </li>
                   <?php } ?>
                  <?php } ?>         
            </ul>  
          </nav> -->
        </div>
        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 container about-us-blocks " style="margin: unset;">
          <?php $about_data = $query_obj->getAboutUsInformation();
            if ($about_data->num_rows > 0) { 
              while($about_details = $about_data->fetch_assoc()) { ?>
                <div class="block-type <?php echo 'block-type-'.$about_details['tab_name']; ?>" data-block_type="<?php echo $about_details['tab_name']; ?>" style="display: none;">
                  <div class="section-title ">
                      <h2 class="primary-text header-font-size text-center mb-4 "><?php echo $about_details['name'] ?>
                      </h2>
                  </div>
                  <?php echo $about_details['description']; ?>
               
                 <!--  <div class="row col-md-12"> 
                  <div class="col-md-6"> 
                    <img src="<?php echo $about_details['image']; ?>" style="height: auto;width: 350px;">
                  <br>
                  </div>
                  <div class="col-md-6">
                    <p class="letter-spacing"><?php echo $about_details['description']; ?></p>
                  </div> 
                  </div>  -->
                </div>
              <?php } ?>
            <?php } ?>
        </div>
        
      </div>
    </section><!-- End About Us Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>
  <!-- End Footer -->

</body>
</html>