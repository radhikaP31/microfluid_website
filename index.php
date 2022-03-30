<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home | Microfluid Process Equipment</title>
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


  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero head_content">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(assets/img/slide/slide-1.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <!-- <div class="text-left"><a href="" class="btn btn-primary primary-text" style="border-radius: 30px;padding: 7px 20px 7px 20px;"><b>Read More</b></a></div>
 -->            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <!-- <div class="carousel-item" style="background-image: url(assets/img/slide/slide-2.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>Lorem Ipsum Dolor</h2>
              <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div> -->

        <!-- Slide 3 -->
        <!-- <div class="carousel-item" style="background-image: url(assets/img/slide/slide-3.jpg);">
          <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
              <h2>Sequi ea ut et est quaerat</h2>
              <p>Ut velit est quam dolor ad a aliquid qui aliquid. Sequi ea ut et est quaerat sequi nihil ut aliquam. Occaecati alias dolorem mollitia ut. Similique ea voluptatem. Esse doloremque accusamus repellendus deleniti vel. Minus et tempore modi architecto.</p>
              <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
            </div>
          </div>
        </div> -->

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
  </section><!-- End Hero -->

  <main id="main">


    <!-- ======= What we offer/services Section ======= -->
    <section id="what-we-offer services" class="what-we-offer services section-bg">
      <div class="container">

        <div class="section-title">
          <h2 class="primary-text header-font-size">What We Offer</strong></h2>
        </div>

        <div class="row">
          <?php $whatWeOfferData = $common->getIndependentDataByTypeCode('WTOFR'); 
          if ($whatWeOfferData->num_rows > 0) { 
            while($offer = $whatWeOfferData->fetch_assoc()) { ?>
              <div class="col-lg-3 col-md-6 align-items-stretch min-height310  " >
                <div class="icon-box rounded shadow mb-5">
                  <div class="icon">
                    <img alt="<?= $offer['mstr_nm']; ?>" src="<?= $offer['mstr_img']; ?>">
                  </div>
                  <h4><a href="<?= $offer['mstr_link']; ?>" class="service_name primary-text"><?= $offer['mstr_nm']; ?>&nbsp;&nbsp;<i class="fa fa-arrow-right" style="font-size: 13px;"></i></a></h4>
                </div>
              </div>
            <?php } ?>
          <?php } ?>  
          <br>   
        </div>
      </div>
            <div class="text-center">
        <a href="#" class="btn btn-primary primary-text" style="border-radius: 30px;padding: 7px 20px 7px 20px;"><b>Read More</b></a>
      </div> 
    </section><!-- End What we offer/services Section -->

<!-- <hr style="border-width: 2px;background-color: var(--secondary_color);" class="container"> -->

        <!-- ======= Field of application Section ======= -->
    <section id="field-appilication" class="field-appilication" style="background: #e2e2e2 !important">
      <div class="container">

        <div class="row">

          <div class="col-lg-4 col-md-6 align-items-stretch min-height310 mt-4" >
            <div class="icon-box field-find-more section-bg">
              <h4 class="primary-text header-font-size" style="text-align: left;padding-left: 7px;">Field of <br>Application</h4>
              <hr style="width: 47%;margin-left: 6px;border-width: 4px;background-color: var(--secondary_color);">
              <h4 class="primary-text body-font-size" style="text-align: left;padding-left: 7px;"><a href="#" class="text-black">Find a right solutions for your industry!!</a></h4>
            </div>
          </div>

          <?php $fieldApplication = $common->getIndependentDataByTypeCode('FOA'); 
          if ($fieldApplication->num_rows > 0) { 
            while($field = $fieldApplication->fetch_assoc()) { ?>
              <div class="col-lg-4 col-md-6 align-items-stretch mt-4" >
                <div class="field field-has-link field-has-icon field-has-content">
                    <div class="field-header">
                      <a target="_self" href="<?= $field['mstr_link']; ?>"><img alt="<?= $field['mstr_nm']; ?>" src="<?= $field['mstr_img']; ?>"></a>
                    </div>
                    <div class="field-content">
                      <h3 class="field-title">
                        <span class="iconify field-icon" data-icon="<?= $field['mstr_icon']; ?>"></span><?= $field['mstr_nm']; ?>
                      </h3><!-- <br> -->
                      <p class="field-desc text-black"><?= $field['mstr_desc']; ?></p>
                      <a class="read-more primary-text" target="_self" href="<?= $field['mstr_link']; ?>">Read More</a>
                    </div>
                </div>
              </div>
            <?php } ?>
          <?php } ?>
        </div>
        <br>
        <div class="text-center">
          <a href="#" class="btn btn-primary primary-text" style="border-radius: 30px;padding: 7px 20px 7px 20px;"><b>Read More</b></a>
        </div>
      </div>
    </section><!-- End Field of application Section -->

    <!-- <hr style="border-width: 2px;background-color: var(--secondary_color);" class="container"> -->

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us about-us-banner" style="background: url('assets/img/about-banner.png') no-repeat center top ; height:26rem ; background-size: cover;padding: 0px;background-attachment: fixed;">  
      <div class="banner-opacity" style="position: absolute;z-index: 0;opacity: 0.7;width: 100%;height: 100%;    background: #C4C4C4 !important;"></div>
        <div class="row col-md-12">
          <div class="col-md-7">
            <div class="about-section-title section-title">
              <h2 class="primary-text header-font-size" style="text-align: left;top: 30px;left: 30px;">About Us</h2>
              <p class="text-left body-font-size" style="padding-left: 30px;line-height: 28px;letter-spacing: 0.9px;">
                <br><br>From last many years of now, <span class="primary-text"> Microfluid Process Equipment </span> has been persistently in its profession to provide best-in-class products and after sales service.<br><br>
                <span class="primary-text"> Microfluid Process Equipment </span> have more than 25 years of experience in manufacturing, process industries and high pressure reciprocating pumps and homogenizers.
              </p>
            </div> 
            <div class="text-left" style="padding-left: 30px;padding-top: 16px;"><a href="#" class="btn primary-text about-read-more" style="border-radius: 30px;padding: 5px 20px 5px 20px;background: transparent;"><b>Read More</b></a></div>
          </div>
          <div class="col-md-5">
          
            <iframe style="padding-top: 7%;height: 100%;width: 100%;" id="player" src="https://www.youtube.com/embed/r5MhAK8lAmU" allowfullscreen="true" scrolling="no" frameborder="0"></iframe>

              <!-- <a target="_self" href="#"><img alt="Homogenizers" src="assets/img/application/homogenizers.jpeg" style="height: auto;width: 94%;padding-top: 33px;padding-left: 31%;"></a> -->
          </div>          
        </div>
    </section>
   <!-- End About Us Section -->

     <!-- ======= Our Clients Section ======= -->
<!--     <section id="our_clients" class="our_clients">
      <div class="container">
        <div class="client_section_title">
          <h2 class="primary-text">Our Valued Clients</h2>
          <div class="client-container">
            <?php 
              $our_clients = $query_obj->getOurClients(); //function for get all clients
              if ($our_clients->num_rows > 0) { 
                while($client = $our_clients->fetch_assoc()) { ?>
                <div class="wrapper" style="padding:0px 20px">
                  <div class="service_item ">
                    <div class="service_image ">
                      <img src="<?php echo BASE_URL .$client['image'];?>" class="img-responsive" alt="" / style="height: 100px;width: auto;margin: auto;">
                    </div>
                  </div>
                </div>
              <?php } 
              }?>
            </div>
        </div>
      </div>
    </section> -->
  <!-- End Our Clients Section -->

   <!-- <hr style="border-width: 3px;background-color: var(--primary_color);" class="container"> -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>
  <!-- End Footer -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>

</html>