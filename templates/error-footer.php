</main>
</body>
<script>
    const baseURL = "<?= APP_URL ?>";

    document.querySelector("#loader-container").style.display = 'none'
    document.querySelector(".back-btn").addEventListener('click', (e) => {
        history.back()
    })
</script>

</html>