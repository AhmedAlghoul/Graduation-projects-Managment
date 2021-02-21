</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="<?php echo $path; ?>/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $path; ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
  $("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
  $("#delete").click((e) => {
    con = confirm("Do you want to delete this project ?");
    if (!con) {
      e.preventDefault();
    }
  });
</script>

</body>

</html>