
<!-- Start Footer -->
<footer id="footer" class="py-5 bg-dark text-white">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-4 col-sm-12">
          <h5 class="text-uppercase">About</h5>
          <p>
            {{ env('APP_NAME') }} is a Fictional Ecommerce Website. 
            This is a LARAVEL APP by Robert Miras. The purpose of this app 
            is to showcase the skills of what I am capable of. Please do not try 
            any real transactions here. Mostly the features of an ecommerce site is implemented in this app, only for showing
            the skills only for my Portfolio. If you want to get in touch with me, please contact me with my email: mrmirasrobert@gmail.com

          </p>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
          <h5 class="text-uppercase">Categories</h5>
          <ul class="category-footer m-0 p-0">
            <li>
              <a href="#">Electronics</a>
            </li>
            <li>
              <a href="#">Clothes</a>
            </li>
            <li>
              <a href="#">Food</a>
            </li>
            <li>
              <a href="#">Supplies</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-12">
          <h5 class="text-uppercase mt-3">Social</h5>
          <ul class="category-footer p-0 mb-2">
            <li>
              <i class="fab fa-github"></i>
              <a href="https://github.com/mirasrobert">Github</a>
            </li>
            <li>
              <i class="fab fa-facebook-f"></i>
              <a href="https://www.facebook.com/MirasRobert">Facebook</a>
            </li>
            <li>
              <i class="fab fa-twitter"></i>
              <a href="#">Twitter</a>
            </li>
            <li>
              <i class="fab fa-instagram"></i>
              <a href="https://www.instagram.com/robertmiras/">Instagram</a>
            </li>
          </ul>
        </div>

        <hr />
        <p class="lead">
          &copy;
          <span id="year"></span>
          <span>{{ env('APP_NAME') }} Made By Robert Miras &hearts;.</span>
        </p>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

