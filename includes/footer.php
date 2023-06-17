    <?php include('includes/footer-top.php'); ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap5.bundle.min.js"></script>
    
    <!-- Owl Carousel -->
    <script src="assets/js/owl.carousel.min.js"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:15,
            nav:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })
    </script>

    <!-- AlertifyJS -->
    <script src="assets/js/alertify.min.js"></script>

    <script src="assets/js/custom.js"></script>

    <script>
        $(document).ready(function () {
            <?php 
            if(isset($_SESSION['message']))
            { 
                ?>
                    alertify.success("<?= $_SESSION['message']; ?>");
                <?php 
                unset($_SESSION['message']); 
            } 
            ?>
        });
    </script>
</body>
</html>