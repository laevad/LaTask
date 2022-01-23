<!-- Footer -->
<footer class="page-footer font-small fixed-bottom   bg-light ">
    <div class="footer-copyright text-center py-3">&copy; <?php echo date('Y')?> Copyright
        <a href="#" class="text-light"></a>
    </div>
</footer>
<!-- Footer -->

<script src="<?php echo url_for('assets/bootstrap%20files/js/jquery-3.4.1.slim.min.js')?>"></script>
<script src="<?php echo url_for('assets/bootstrap%20files/js/popper.min.js')?>"></script>
<script src="<?php echo url_for('assets/bootstrap%20files/js/bootstrap.min.js')?>"></script>
<script>
    $('.alert').alert();
</script>
<script>
    $(document).on("click", ".browse", function() {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file").val(fileName);
    });
</script>
</body>
</html>
<?php

db_disconnect($db);
?>
