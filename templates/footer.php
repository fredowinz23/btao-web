
        </div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/chart/chart.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/easing/easing.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/waypoints/waypoints.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?=$ROOT_DIR;?>templates/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?=$ROOT_DIR;?>templates/js/main.js"></script>
</body>

</html>

<script type="text/javascript">



<?php if ($success): ?>
	Swal.fire({
		title: "Success",
		text: "<?=$success;?>",
		icon: "success"
		});
<?php endif; ?>


<?php if ($error): ?>
	Swal.fire({
		title: "Error",
		text: "<?=$error;?>",
		icon: "error"
		});
<?php endif; ?>
</script>
