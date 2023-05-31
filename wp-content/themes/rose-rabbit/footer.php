<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rose_and_Rabbit
 */

?>
 <!--Footer-->
 <footer class="footer-wrapper footer-layout1">
    <div class="footer-top">
       <div class="container">
          <div class="row align-items-stretch">
             <div class="col-md-4  d-lg-flex">
                <div class="social-style2">
                   <a href="#">
                      <i class="fab fa-facebook-f"></i>
                   </a>
                   <a href="#">
                      <i class="fab fa-twitter"></i>
                   </a> <a href="#">
                      <i class="fab fa-instagram"></i>
                   </a>
                   <a href="#">
                      <i class="fab fa-linkedin-in"></i>
                   </a>
                </div>
             </div>
             <div class="col-md-5 col-lg-4">
                <div class="vs-logo">
					<a href="#">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-Logo.png" alt="logo">
					</a>
				</div>
             </div>
             <div class="col-md-7 col-lg-4">
                <form action="#" class="form-style1">
                   <h3 class="form-title">Lorem, ipsum dolor.</h3>
                   <div class="form-group">
						<input type="email" placeholder="Enter your email...">
						<button class="vs-btn" type="submit">Subscribe</button>
					</div>
                </form>
             </div>
          </div>
       </div>
    </div>
    <div class="widget-area">
       <div class="container">
          <div class="row justify-content-between">
             <div class="col-md-6 col-xl-auto">
                <div class="widget footer-widget">
                   <h3 class="widget_title">Lorem, ipsum dolor.</h3>
                   <p class="footer-info"><i class="fal fa-map-marker-alt text-theme me-2"></i> Lorem ipsum
                      dolor sit.<br><a href="tel:+911234567890" class="text-inherit"><i class="fa fa-phone-alt text-theme me-2"></i>+91 98765 43215</a><br><a class="text-inherit" href="mailto:"><i class="fal fa-envelope text-theme me-2"></i>lorem@gamil.com</a>
                   </p>
                </div>
             </div>
             <div class="col-md-6 col-xl-auto">
                <div class="widget widget_nav_menu footer-widget">
                   <h3 class="widget_title">Lorem, ipsum dolor.</h3>
                   <div class="menu-all-pages-container footer-menu">
                      <ul class="menu">
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                      </ul>
                   </div>
                </div>
             </div>
             <div class="col-md-6 col-xl-auto">
                <div class="widget widget_nav_menu footer-widget">
                   <h3 class="widget_title">Lorem, ipsum dolor.</h3>
                   <div class="menu-all-pages-container footer-menu">
                      <ul class="menu">
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                      </ul>
                   </div>
                </div>
             </div>
             <div class="col-md-6 col-xl-auto">
                <div class="widget widget_nav_menu footer-widget">
                   <h3 class="widget_title">Lorem, ipsum dolor.</h3>
                   <div class="menu-all-pages-container footer-menu">
                      <ul class="menu">
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                         <li><a href="#">Lorem, ipsum.</a></li>
                      </ul>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
    <div class="copyright-wrap">
       <div class="container">
          <div class="row justify-content-between align-items-center">
             <div class="col-md-4 text-center">
                <p class="copyright-text">Copyright <i class="fal fa-copyright"></i> 2023 <a href="<?php echo esc_url( home_url( '/' ) ); ?>">ROSE&RABBIT</a></p>
             </div>
             <div class="col-md-4 text-center">
               <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-logo.svg">
             </div>
          </div>
       </div>
    </div>
 </footer>
 <!--Login Model-->
 <div id="myModal" class="modal">
    <div class="modal-content">
       <div class="modal-header1">
          <span class="close">&times;</span>
          <h2>Login</h2>
       </div>
       <div class="modal-body">
          <div class="container">
             <div class="row">
                <div class="col-lg-12 mt-5">
                   <form action="#" method="POST" class="ajax-contact form-style6">
                      <div class="form-group">
                         <input type="number" class="formwidth" name="name" id="name" placeholder="Enter Mobile No*">
                      </div>
                      <button class="vs-btn mb-5" type="submit">Submit</button>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
<?php wp_footer(); ?>
</body>
</html>
<script>

// jQuery('.mcsfw_remove').click(function(e) {
// console.log('clicked :>> ');
// })
</script>