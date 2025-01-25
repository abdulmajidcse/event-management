</main>

<footer class="bg-dark border-top border-body text-light text-center pt-3 pb-2">
    <div class="container">
        <p>&copy; <?php echo date('Y') . ' ' . config('name') ?>. All rights are reserved.</p>
    </div>
</footer>

<script src="<?php echo asset('/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo asset('/js/sweetalert2.all.min.js') ?>"></script>

<?php
$statusMessage = getStatusMessage();
if (!empty($statusMessage['message']) && !empty($statusMessage['type'])) {
?>
    <script>
        Swal.fire({
            icon: `<?php echo $statusMessage['type']; ?>`,
            title: `<?php echo ucfirst($statusMessage['type']); ?>`,
            text: `<?php echo $statusMessage['message']; ?>`,
            showConfirmButton: true,
        });
    </script>
<?php } ?>
</body>

</html>