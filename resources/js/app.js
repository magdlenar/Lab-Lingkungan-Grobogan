// Import Bootstrap bawaan Laravel
import './bootstrap';
import * as bootstrap from 'bootstrap';

// 🔹 Efek animasi muncul halus di Hero Section
document.addEventListener('DOMContentLoaded', () => {
    const hero = document.querySelector('.hero-section .row');
    if (hero) {
        hero.style.opacity = 0;
        hero.style.transform = 'translateY(20px)';
        hero.style.transition = 'opacity 0.8s ease, transform 0.8s ease';

        setTimeout(() => {
            hero.style.opacity = 1;
            hero.style.transform = 'translateY(0)';
        }, 100);
    }
});

// 🔹 Tambahkan smooth scroll ke semua anchor link dalam halaman
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        const targetId = this.getAttribute('href').substring(1);
        const target = document.getElementById(targetId);
        if (target) {
            e.preventDefault();
            window.scrollTo({
                top: target.offsetTop - 70,
                behavior: 'smooth'
            });
        }
    });
});

// Toggle password field
window.togglePassword = function(fieldId = "password", iconId = "iconPass") {
    let input = document.getElementById(fieldId);
    let icon = document.getElementById(iconId);

    if (!input || !icon) return;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    } else {
        input.type = "password";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    }
};

// Check confirm password (register page)
window.checkPasswordMatch = function() {
    let pass = document.getElementById("password");
    let confirm = document.getElementById("password_confirmation");
    let msg = document.getElementById("passwordMessage");

    if (!pass || !confirm || !msg) return;

    if (confirm.value.length > 0 && pass.value !== confirm.value) {
        msg.classList.remove("d-none");
    } else {
        msg.classList.add("d-none");
    }
};
window.togglePassword = function(id, iconId) {
    const input = document.getElementById(id);
    const icon = document.getElementById(iconId);

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    } else {
        input.type = "password";
        icon.classList.add("bi-eye-slash");
        icon.classList.remove("bi-eye");
    }
};


// JS PUNYA ADMIN ==============================================

const bulan = JSON.parse(`@json($bulan ?? ["Jan","Feb","Mar","Apr"])`);
    const totalPermintaan = JSON.parse(`@json($totalPermintaan ?? [10,15,8,12])`);

    const labelAkun = ["Admin", "Customer"];
    const dataAkun = JSON.parse(`@json($jumlahAkun ?? [5,20])`);

    new Chart(document.getElementById('chartPermintaan'), {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Total Permintaan Uji',
                data: totalPermintaan,
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    });

    new Chart(document.getElementById('chartAkun'), {
        type: 'doughnut',
        data: {
            labels: labelAkun,
            datasets: [{
                data: dataAkun
            }]
        },
        options: { responsive: true }
    });
    
    