<div class="bg-primary text-white text-center p-1">
    <p>Copyright @ 2022</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    // <?php //if (isset($_SESSION['success'])) : ?>
    //     toastr.success("<?=$_SESSION['success']?>");
    // <?php //endif; ?>

    function deleteRecord(event) {
        let result = confirm('Are you sure you want to delete this record?');
        if(! result) {
            event.preventDefault();
        }
    }
</script>
</body>

</html>