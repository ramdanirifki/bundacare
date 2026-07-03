import Alpine from 'alpinejs';
import './splash';
import Swal from 'sweetalert2';

window.Swal = Swal;
window.Alpine = Alpine;

Alpine.start();

/*
|--------------------------------------------------------------------------
| Bottom Navigation
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.nav-item').forEach(item => {
    item.addEventListener('click', function (e) {
      const href =
        this.dataset.href ||
        this.getAttribute('href');

      const currentPath = window.location.pathname;

      const isConsultationPage =
        currentPath === '/konsultasi' ||
        currentPath.startsWith('/konsultasi/');

      /*
      |--------------------------------------------------------------------------
      | Sedang di halaman konsultasi
      |--------------------------------------------------------------------------
      */

      if (isConsultationPage) {
        e.preventDefault();

        // Klik menu konsultasi lagi
        if (href === '/konsultasi') {
          Swal.fire({
            icon: 'info',
            title: 'Anda sedang berada di halaman konsultasi',
            text:
              'Silakan selesaikan atau keluar dari konsultasi terlebih dahulu.',
            confirmButtonText: 'Mengerti',
            confirmButtonColor: '#7E57C2',
            allowOutsideClick: false,
            allowEscapeKey: false
          });

          return;
        }

        // Klik menu lain
        Swal.fire({
          icon: 'warning',
          title: 'Keluar dari konsultasi?',
          text:
            'Proses konsultasi yang belum selesai akan dibatalkan.',
          showCancelButton: true,
          confirmButtonText: 'Ya, keluar',
          cancelButtonText: 'Tetap di sini',
          confirmButtonColor: '#E53935',
          cancelButtonColor: '#7E57C2',
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false
        }).then(result => {
          if (result.isConfirmed) {
            window.location.href = href;
          }
        });

        return;
      }

      /*
      |--------------------------------------------------------------------------
      | Membuka menu konsultasi
      |--------------------------------------------------------------------------
      */

      if (href === '/konsultasi') {
        e.preventDefault();

        Swal.fire({
          icon: 'question',
          title: 'Panduan Konsultasi',
          html: `
            <div style="text-align:left;line-height:1.6;color:#5E5B77;">
              <p style="margin-bottom:16px;">
                Konsultasi ini digunakan untuk membantu mengenali kondisi awal berdasarkan gejala yang dipilih.
              </p>

              <ol style="padding-left:18px;margin:0;display:flex;flex-direction:column;gap:10px;">
                <li>
                  <b>1. Pilih gejala utama</b><br>
                  <small>Pilih satu gejala utama yang paling sesuai.</small>
                </li>

                <li>
                  <b>2. Jawab pertanyaan lanjutan</b><br>
                  <small>Sistem akan memberikan pertanyaan sesuai gejala.</small>
                </li>

                <li>
                  <b>3. Lihat hasil diagnosis</b><br>
                  <small>Lihat kemungkinan kondisi dan rekomendasi.</small>
                </li>
              </ol>
            </div>
          `,
          showCancelButton: true,
          confirmButtonText: 'Mulai Konsultasi',
          cancelButtonText: 'Batal',
          confirmButtonColor: '#7E57C2',
          cancelButtonColor: '#FFFFFF',
          reverseButtons: true,
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            const cancel = Swal.getCancelButton();

            if (cancel) {
              cancel.style.color = '#2D2A4A';
              cancel.style.border =
                '1px solid #E8E5F3';
            }
          }
        }).then(result => {
          if (result.isConfirmed) {
            window.location.href = href;
          }
        });
      }
    });
  });
});

/*
|--------------------------------------------------------------------------
| PWA
|--------------------------------------------------------------------------
*/

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker
      .register('/serviceworker.js')
      .then(() => {
        console.log('PWA Ready');
      })
      .catch(err => {
        console.log(err);
      });
  });
}