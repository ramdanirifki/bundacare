<header class="sticky top-0 z-50 bg-white px-5 py-4 border-b">
  <div class="flex justify-between items-center">
    <div>
      <h1 class="font-bold text-violet-600 text-xl" style="font-family: 'Plus Jakarta Sans', sans-serif;">
        BundaCare
      </h1>

      <p class="text-xs text-gray-400">
        Sistem Pakar
      </p>
    </div>

    <button id="infoButton">
      <span class="material-symbols-outlined text-violet-600">
        info
      </span>
    </button>
  </div>
</header>

<script>
  document.getElementById('infoButton').addEventListener('click', function() {
    Swal.fire({
      icon: 'info',
      title: 'Informasi Aplikasi',
      html: `
      <div style="text-align:left;line-height:1.8;color:#5E5B77;">

        <p style="margin-bottom:12px;">
          <b>BundaCare</b> adalah aplikasi berbasis <b>sistem pakar</b> yang digunakan untuk membantu memberikan gambaran awal mengenai kondisi kesehatan berdasarkan gejala yang dipilih pengguna.
        </p>

        <p style="margin-bottom:12px;">
          Hasil yang diberikan oleh aplikasi ini <b>bukan diagnosis medis final</b>, melainkan hanya rekomendasi awal yang bersifat informatif.
        </p>

        <p>
          Untuk hasil yang lebih akurat, pengguna tetap disarankan untuk berkonsultasi dengan tenaga medis atau dokter profesional.
        </p>

      </div>
    `,
      confirmButtonText: 'Mengerti',
      confirmButtonColor: '#7E57C2',
      allowOutsideClick: true
    });
  });
</script>
