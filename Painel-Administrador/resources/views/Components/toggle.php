<script>
    document.addEventListener("DOMContentLoaded", function () {

        const menuBtn = document.getElementById("menuBtn");
        const sidebar = document.getElementById("sidebar");

        menuBtn.addEventListener("click", function () {
            sidebar.classList.toggle("fechado");
        });

    });
</script>