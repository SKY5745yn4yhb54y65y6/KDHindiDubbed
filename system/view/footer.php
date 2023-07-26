<?php echo analytics() ?> 
<!-- Footer -->
      <footer class="sticky-footer bg-gradient-dark">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span class="text-white">Copyright &copy; <?php echo config('site.copyright')?> <?php echo date('Y'); ?></span>
          </div>
          <?php if(isset($_SESSION['email'])):?>
          <br>
          <div class="copyright text-center my-auto">
            <span><a href="/page/privacy-policy">Privacy Policy</a> | <a href="/page/terms-conditions">Terms & Conditions</a> | <a href="/page/copyright-policy">Copyright Policy</a></span>
          </div>
          <?php endif;?>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-gradient-dark">
          <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true" class="text-white">×</span>
          </button>
        </div>
        <div class="modal-footer bg-gradient-dark">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="/login.php?action=logout">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="/assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->

</body>

</html>