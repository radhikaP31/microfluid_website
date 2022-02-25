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
  <?php include 'header.php'; ?>
  <!-- Header end -->

  <main id="main">
    <hr style="margin: 2% 10%;" />
    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
      <div class="container" data-aos="fade-up">

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-right">
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#corpo_profile">Corporate Profile</a></li>
              <li><a data-toggle="tab" href="#management_values">Management Values</a></li>
              <li><a data-toggle="tab" href="#visin_mission">Vision & Mission</a></li>
              <li><a data-toggle="tab" href="#testimonials">Testimonials</a></li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
            <?php 
            $aboutInfo = $query_obj->getAboutUsInformation(); ?>
            <div id="">
              <!-- write tab section code here -->
            </div>
            <!-- design all section and give id of upper <li> nav tabs -->
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include 'footer.php';?>
  <!-- End Footer -->

</body>

</html>