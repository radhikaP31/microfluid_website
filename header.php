<header id="header" class="header fixed-top" >
    <!-- email, contact info -->
    <div  class="container d-flex align-items-center" style="height:40px;padding-left: 0%;padding-right: 0%;margin-bottom: 1%;"> 
      <a href="index.php" class="logo mr-auto"><img src="assets/img/Logo.png" alt="" class="img-fluid"></a>
      <span class="primary-text" style="margin-right: 4%;"><i class="fa fa-phone fa-rotate-90"></i> +91 70168 65019  </span>
      <span class="primary-text" style="margin-right: 4%;width: 25%;letter-spacing: 1px;"><i class="fa fa-envelope"></i>&nbsp;<a class="primary-text hover-mail" href="mailto:sales@microfluidprocess.com">sales@microfluidprocess.com</a> </span>

      <a href="#" class="btn btn-primary primary-text get_quote" style="border-radius: 30px;"><b>Get a Fair Quote</b></a>
    </div>

    <div class="container-fluid d-flex align-items-center padding0 primary-bg">
      <nav class="nav-menu d-none d-lg-block" style="margin-left: 10%;">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>
          <li><a href="about.php">About Us</a></li>
          <li class="drop-down"><a href="">Products <i class="fa fa-sort-down" aria-hidden="true"></i></a>
            <ul>
              <li><a href="#">Product 1</a></li>
              <li><a href="#">Product 2</a></li>
              <li><a href="#">Product 3</a></li>
              <li><a href="#">Product 4</a></li>
              <li><a href="#">Product 5</a></li>
            </ul>
          </li>
          <li><a href="">Industries</a></li>
          <li><a href="">Service</a></li>
          <li><a href="">Clients</a></li>
          <li><a href="">Blogs</a></li>
          <li><a href="">Inquiry</a></li>
          <li><a href="">Contact</a></li>
          <!-- Second Dropdown inside one dropdown
          <li><a href="services.html">Services</a></li>
          <li><a href="portfolio.html">Portfolio</a></li>
          <li><a href="pricing.html">Pricing</a></li>
          <li><a href="blog.html">Blog</a></li>
          <li><a href="contact.html">Contact</a></li>
          <li class="drop-down"><a href="">Products</a>
            <ul>
              <li><a href="about.html">About Us</a></li>
              <li><a href="team.html">Team</a></li>
              <li><a href="testimonials.html">Testimonials</a></li>
              <li class="drop-down"><a href="#">Deep Drop Down</a>
                <ul>
                  <li><a href="#">Product 1</a></li>
                  <li><a href="#">Product 2</a></li>
                  <li><a href="#">Product 3</a></li>
                  <li><a href="#">Product 4</a></li>
                  <li><a href="#">Product 5</a></li>
                </ul>
              </li>
            </ul>
          </li> -->

        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin" style="margin-left: 4px;"><i class="icofont-linkedin"></i></i></a>
      </div>

    </div>
</header>

<!-- Creating object of classes -->
  <?php $query_obj = new Common_query(); ?>
  <?php $common = new Class_common(); ?>


<div class="header_space"></div>

<?php if(basename($_SERVER['PHP_SELF']) != 'index.php'){ ?>


<!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs" style="padding: 0px;height: 9rem;background-image: url(assets/img/breadcrumb/breadcrumb_img.png);background-size: cover;">
    <div style="position: absolute;z-index: 0;opacity: 0.7;width: 100%;height: 9rem;background: white;"></div>
    <div class="col-md-12 d-flex justify-content-between align-items-center" style="bottom: -4%;"> 
      <h3 class="text-left primary-text breadcrumb-text" ><?php echo $common->getLanguage('breadcrumb_desc'); ?></h3>       
    </div>
    <div class="col-md-12 d-flex justify-content-between align-items-center" style="bottom: -9%;background: rgb(113 113 113 / 54%);letter-spacing: 1.3px;"> 
      <h2  class="primary-text" style="margin: 9px 4rem;">
        <?php echo $common->breadcrumbs(' &#124; ','Home'); ?>
      </h2>         
    </div>
  </section>
<!-- End Breadcrumbs -->

<?php } ?>

