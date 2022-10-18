    </main>
    </body>
    <script src="/assets/vendor/mdb/js/core/popper.min.js"></script>
    <script src="/assets/vendor/mdb/js/core/bootstrap.min.js"></script>
    <script src="/assets/vendor/mdb/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="/assets/vendor/mdb/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="/assets/vendor/mdb/js/plugins/chartjs.min.js"></script>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/jquery/datatable.js"></script>
    <script src="/assets/vendor/jquery/jquery-b5.js"></script>
    <script src="/assets/vendor/toastr/js/toastr.min.js"></script>
    <script src="/assets/vendor/moment-js.js"></script>
    <script src="/assets/vendor/mdb5/js/mdb.min.js"></script>
    <script>
        const baseURL = "<?= APP_URL ?>";
        let tblMyDrive;
    </script>
    <script src="/assets/js/select2.js"></script>
    <script src="/assets/js/main.js"></script>
    <?php
    if (isset($data['js'])) { ?>
        <script src="/assets/js/<?= $data['js'] ?>.js"></script>
    <?php }
    ?>

    </html>