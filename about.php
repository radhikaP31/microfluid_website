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
    <hr style="margin: 2% 10%;background: #b5b5b5;" />
    <!-- ======= About Us Section ======= -->
    <section id="about-us container" class="about-us">
      <div class="row col-md-12">
        <div class="col-md-2">
          <nav class="navbar navbar-default block-filter-section">
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
          </nav>
        </div>
        <div class="col-md-9 container about-us-blocks " style="margin: unset;">
          <?php $about_data = $query_obj->getAboutUsInformation();
            if ($about_data->num_rows > 0) { 
              while($about_details = $about_data->fetch_assoc()) { ?>
                <div class="block-type <?php echo 'block-type-'.$about_details['tab_name']; ?>" data-block_type="<?php echo $about_details['tab_name']; ?>" style="display: none;">
                  
               
                  <div class="row col-md-12"> 
                  <div class="col-md-6"> 
                    <img src="<?php echo $about_details['image']; ?>" style="height: auto;width: 350px;">
                  <br>
                  </div>
                  <div class="col-md-6">
                    <p class="letter-spacing"><?php echo $about_details['description']; ?></p>
                  </div> 
                  </div> 
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