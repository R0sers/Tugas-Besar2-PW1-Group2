document.addEventListener("DOMContentLoaded", () => {
    console.log("✅ Page1.js loaded");

    const buttons = document.querySelectorAll(".btn-mapel");

    console.log("Jumlah tombol:", buttons.length);

    buttons.forEach(btn => {
        btn.addEventListener("click", () => {
            const cat = btn.dataset.cat;
            console.log("Klik mapel:", cat);

            window.location.href = `quiz.php?cat=${cat}`;
        });
    });
});
