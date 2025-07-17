<div class="modal fade" id="addRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Tambah {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/rooms" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room_id" id="room_id">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Ruangan</label>
                        <input type="text" class="form-control @error('kode') is-invalid @enderror" id="kode" name="kode" required value="{{ old('kode') }}">
                        @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control  @error('nama') is-invalid @enderror" id="nama" name="nama" required value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class='mb-3'>
                        <label for='img' class='form-label'>Foto Ruangan</label>
                        <input class="form-control @error('img') is-invalid @enderror" type='file' id='img' name='img'/>
                        @error('img')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="lantai" class="form-label">Lantai</label>
                            <input type="number" class="form-control @error('lantai') is-invalid @enderror" id="lantai" name="lantai" required value="{{ old('lantai') }}">
                        </div>
                        <div class="col-6">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                        <input type="number"  class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" required value="{{ old('kapasitas') }}">
                        </div>
                    </div>                    
                    <div class="mb-3">
                        <label for="tipe" class="form-label">Tipe Ruangan</label>
                        <select class="form-select" name="tipe" id="tipe" required value="{{ old('tipe')}}">
                            <option selected disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium">Laboratorium</option>
                            <option value="Ruang Kelas">Ruang Kelas</option>
                            <option value="Ruang Dosen">Ruang Dosen</option>
                            <option value="Ruang Umum">Ruang Umum</option>
                            <option value="Auditorium">Auditorium</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label  @error('deskripsi') is-invalid @enderror">deskripsi ruangan</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>