<div style="height: 60px; width: 100%"></div>
</div>
<!-- End the wrapper -->

<?php
Views::RenderDialogs($dialogs);
?>

<!-- Footer -->
<footer class="footer-container fixed-bottom">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p style="text-align: center; padding: 10px; font-family: 'Raleway', arial; color: white">Copyright © 2019 Connected Rail</p>
            </div>
        </div>
    </div>
</footer>

<?php if ($shouldLoadPageSpecificScript) { ?> <script src="../../assets/scripts/<?php echo(strtolower($name));?>.js"></script> <?php } ?>

</body>
</html>

