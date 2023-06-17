
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap5.bundle.min.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!-- Data Tables -->
    <script src="assets/js/dataTables.min.js"></script>
    

    <!-- Summer Note -->
    <script src="assets/summernote/summernote.min.js"></script>
    <script src="assets/summernote/summernote-bs4.min.js"></script>
    <script>
        $(document).ready( function () {
            $('.summernote').summernote();
            $('.dropdown-toggle').dropdown();
            $('#myTable').DataTable();
        });
    </script>
    
    <!-- Alerty -->
    <script src="assets/js/alertify.min.js"></script>
    <script>
        $(document).ready(function () {
            <?php if(isset($_SESSION['message'])): ?>
                alertify.set('notifier','position', 'top-right');
                alertify.success("<?= $_SESSION['message']; ?>");
            <?php unset($_SESSION['message']); endif; ?>

        });
    </script>

</body>
</html>
