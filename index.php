<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('admin/db_connect.php');
ob_start();
ob_end_flush();
include('header.php');


?>

<body id="page-top">
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <header class="header" id="home">
    <div class="navbar">
      <a href="#" class="logo"> <i class="fas fa-laptop-code"></i> anggi </a>
      <nav class="nav-links">
        <a href="#home">home</a>
        <a href="#lelang">lelang</a>
        <a href="#reviews">review</a>
      </nav>
      <div class="nav-links icons">
        <?php if (isset($_SESSION['login_id'])) : ?>
          <a class="" href="admin/ajax.php?action=logout2"><?= $_SESSION['login_name'] ?> <div id="login-btn" class="fas fa-power-off"></div></a>
        <?php else : ?>
          <a href="javascript:void(0)" id="login_now" class="js-scroll-trigger">
            <div id="login-btn" class="fas fa-user"></div>
          </a>
        <?php endif; ?>
      </div>
    </div>
    <div class="header-content">
      <div class="container grid-2">
        <div class="column-1">
          <h1 class="header-title">Mulai Lelang <br> Di Anggi Lelang <br> & Dapatkan Barang Impian!</h1>
          <p class="text">
            Pusat lelang dengan harga terjangkau dan kualitas terbaik. Dapatkan barang impian anda di Anggi Lelang!
          </p>
          <a href="#lelang" class="btn-home">Mulai Sekarang</a>
        </div>

        <div class="column-2 image">
          <img src="./images/illust/undraw_pair_programming_re_or4x.svg" class="img-element z-index" alt="" />
        </div>
      </div>
    </div>
  </header>
  <div class="wave">
    <img src="images/illust/wave.png" alt="">
  </div>
  <nav class="bottom-navbar">
    <a href="#home" class="fas fa-home"></a>
    <a href="#lelang" class="fas fa-list"></a>
    <a href="#reviews" class="fas fa-comments"></a>
    <a href="#about" class="fas fa-address-card"></a>
  </nav>
  <main id="main-field">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';
    include $page . '.php';
    ?>

  </main>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Confirmation</h5>
        </div>
        <div class="modal-body">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span class="fa fa-arrow-right"></span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
  <div class="mountain">
    <img src="images/illust/mountain.png" alt="">
  </div>
  <!-- Lelang ends -->

  <footer>
    <div class="left-col">
      <a href="#" class="logo"> <i class="fas fa-laptop-code"></i> lelang </a>

      <div class="footer-link">
        <a href="#">Home</a>
        <a href="#lelang">Lelang</a>
        <a href="#reviews">Reviews</a>
      </div>
    </div>

    <div class="right-col">
      <div class="social-media">
        <div class="social-link">
          <img class="facebook" src="images/icon-facebook.svg" alt="Facebook logo">
        </div>
        <div class="social-link">
          <img class="twitter" src="images/icon-twitter.svg" alt="Twitter logo">
        </div>
        <div class="social-link">
          <img class="pinterest" src="images/icon-pinterest.svg" alt="Pinterest logo">
        </div>
        <div class="social-link">
          <img class="instagram" src="images/icon-instagram.svg" alt="Instagram logo">
        </div>
      </div>
      <div class="copyright">&#169; 2023 Anggi. All rights reserved.</div>
    </div>
  </footer>
  <?php include('footer.php') ?>

  <script src="./js/isotope.pkgd.min.js"></script>
  <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  <script src="./js/script.js"></script>
</body>
<script type="text/javascript">
  $('#login').click(function() {
    uni_modal("Login", 'login.php')
  })
  $('.datetimepicker').datetimepicker({
    format: 'Y-m-d H:i',
  })
  $('#find-car').submit(function(e) {
    e.preventDefault()
    location.href = 'index.php?page=search&' + $(this).serialize()
  })
</script>
<?php $conn->close() ?>

</html>