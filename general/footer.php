<script src="/assets/js/index.js"></script>

<!-- flatpickr for human-friendly dates -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
    config = {
        enableTime: false,
        dateFormat: "D j M Y",
        altInput: true,
        altFormat: "D j M Y",
    }

    flatpickr("input[type=datetime]", config);
</script>
</body>

</html>
