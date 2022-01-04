<script src="/assets/js/index.js"></script>

<!-- flatpickr for human-friendly dates -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    config = {
        enableTime: true,
        dateFormat: "D, M j, Y",
        altInput: true,
        altFormat: "D, M j, Y",
    }

    flatpickr("input[type=datetime]", config);
</script>
</body>

</html>
