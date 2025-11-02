@extends('layouts.app')

@section('title', 'Riwayat Sortir')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>History </h1>
    </div>
    <div class="section-body">
        <h2 class="section-title">Daftar Hasil Penyortiran Tomat</h2>
        <p class="section-lead">
            Halaman ini menampilkan semua riwayat hasil buah tomat yang telah disortir oleh sistem.
        </p>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Riwayat Sortir </h4>
                        <div class="d-flex align-items-center">
                            <label for="filterGrade" class="mr-2 mb-0 font-weight-bold">Filter Grade:</label>
                            <select id="filterGrade" class="form-control form-control-sm" style="width: 120px;">
                                <option value="">Semua</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>
                    </div>

                    <div class="px-4 pb-3">
                        <div class="d-flex align-items-center">
                            <label for="filterDate" class="mr-2 mb-0 font-weight-bold">Filter Tanggal:</label>
                            <input type="date" id="filterDate" class="form-control form-control-sm" style="width: 200px;">
                        </div>
                    </div>

                    <div class="card-body pt-0">
                        
                        <div class="table-responsive">
                            <table class="table table-striped" id="activityTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Grade</th>
                                        <th>Bobot</th>
                                        <th>Ukuran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($histories as $index => $item)
                                        <tr data-id="{{ $item->id_history }}"
                                            data-date="{{ $item->tanggal }}"
                                            data-grade="{{ $item->grade }}"
                                            data-photo="{{ asset('storage/foto/' . $item->foto) }}"
                                            data-bobot="{{ $item->bobot }}"
                                            data-ukuran="{{ $item->ukuran }}">
                                            
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td><span class="badge {{ $item->badge_class }}">{{ $item->grade }}</span></td>
                                            <td>{{ $item->bobot }} gram</td>
                                            <td>{{ $item->ukuran }} cm</td>
                                            <td>
                                                <button class="btn btn-sm btn-info btn-detail">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>

                                                <button class="btn btn-sm btn-danger btn-delete"
                                                        data-id="{{ $item->id_history }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                Belum ada data riwayat sortir.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

{{-- MODAL DETAIL --}}
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="detailModalLabel">Detail Tomat</h5>
          </div>
          <div class="modal-body text-center">
              <img id="detailPhoto" src="" alt="Foto Tomat"
                   class="img-fluid rounded shadow mb-3"
                   style="max-height: 260px; border: 3px solid #e3e3e3; object-fit: cover;">

              <table class="table table-borderless text-left mb-0">
                  <tr>
                      <th width="30%">Tanggal</th>
                      <td id="detailTanggal"></td>
                  </tr>
                  <tr>
                      <th>Grade</th>
                      <td id="detailGrade"></td>
                  </tr>
                  <tr>
                      <th>Bobot</th>
                      <td id="detailBobot"></td>
                  </tr>
                  <tr>
                      <th>Ukuran</th>
                      <td id="detailUkuran"></td>
                  </tr>
              </table>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          </div>
      </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateInput = document.getElementById('filterDate');
    const gradeSelect = document.getElementById('filterGrade');
    const rows = document.querySelectorAll('#activityTable tbody tr');

    // === FILTER ===
    function filterTable() {
        const selectedDate = dateInput.value;
        const selectedGrade = gradeSelect.value;

        rows.forEach(row => {
            const rowDate = row.getAttribute('data-date');
            const rowGrade = row.getAttribute('data-grade');
            const matchDate = !selectedDate || rowDate.includes(selectedDate);
            const matchGrade = !selectedGrade || rowGrade === selectedGrade;
            row.style.display = (matchDate && matchGrade) ? '' : 'none';
        });
    }
    dateInput.addEventListener('change', filterTable);
    gradeSelect.addEventListener('change', filterTable);

    // === DETAIL MODAL ===
   document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const row = this.closest('tr');

            // ambil semua data dari atribut data-*
            const photoUrl = row.dataset.photo;
            const tanggal = row.dataset.date;
            const grade = row.dataset.grade;
            const bobot = row.dataset.bobot;
            const ukuran = row.dataset.ukuran;

            // isi ke elemen modal
            document.getElementById('detailPhoto').src = photoUrl;
            document.getElementById('detailTanggal').textContent = tanggal;
            document.getElementById('detailGrade').textContent = grade;
            document.getElementById('detailBobot').textContent = bobot;
            document.getElementById('detailUkuran').textContent = ukuran;

            // pastikan td grade tidak ikut class badge dari tabel utama
            document.getElementById('detailGrade').className = '';

            // tampilkan modal
            $('#detailModal').modal('show');
        });
    });


    // === HAPUS DATA ===
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            const id_history = this.dataset.id;
            const url = `/history/${id_history}/delete`;

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(url, {
                        method: 'GET',
                        headers: { 'Accept': 'application/json' }
                    })
                    .then(res => res.json())
                    .then(data => {
                      if (data.success) {
                        // Buat alert popup melayang kanan atas
                        const alertDiv = document.createElement('div');
                        alertDiv.className = 'alert alert-success alert-dismissible fade show shadow-lg';
                        alertDiv.style.cssText = `
                            width: 500px;
                            margin-left: auto;
                            animation: slideInRight 0.4s ease;
                            pointer-events: all;
                        `;
                        alertDiv.innerHTML = `
                            <strong></strong> ${data.message}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        `;

                        // Tampilkan alert di pojok kanan atas
                        document.getElementById('alertContainer').appendChild(alertDiv);

                        // Hapus baris tabel
                        button.closest('tr').remove();

                        // Hilangkan alert otomatis setelah 3 detik
                        setTimeout(() => {
                            alertDiv.classList.remove('show');
                            alertDiv.classList.add('fade');
                            alertDiv.remove();
                        }, 3000);
                    }


                    })
                    .catch(() => {
                        Swal.fire('Error!', 'Tidak dapat terhubung ke server.', 'error');
                    });
                }
            });
        });
    });
});
</script>

<!-- Alert Popup -->
<!-- Alert Popup -->
<div id="alertContainer" 
     class="position-fixed" 
     style="top: 30px; right: 300px; z-index: 2000; max-width: 250px; width: 100%; pointer-events: none;">
</div>


@endsection
