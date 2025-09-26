
<!-- Javascript -->
<script src="<?= asset('libs/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= asset('libs/simplebar/simplebar.min.js') ?>"></script>

<?php if ($Campos == "Dashboard"): ?>
    <script src="<?= asset('libs/apexcharts/apexcharts.min.js') ?>"></script>
    <script src="<?= asset('js/stock-prices.js') ?>"></script>
    <script src="<?= asset('js/pages/index.init.js') ?>"></script>
<?php endif; ?>
<!-- Sweet-Alert --> 
<script src="<?= asset('libs/sweetalert2/sweetalert2.min.js') ?>"></script>
<script src="<?= asset('js/pages/sweet-alert.init.js') ?>"></script>
<script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
