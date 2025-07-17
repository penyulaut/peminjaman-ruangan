<!-- <div class="modal fade" id="editRoom" tabindex="-1" aria-labelledby="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModalLabel">Form Edit {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="text-align: left;">
                <form action="/dashboard/rooms/{{ $room->kode }}" method="post" enctype="multipart/form-data" id="editform">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="kode" class="form-label">Kode Ruangan</label>
                        <input type="text" class="form-control  @error('kode') is-invalid @enderror" id="kode" name="kode" required value="{{ old('kode') }}">
                        @error('kode')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Ruangan</label>
                        <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
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
                            <input type="number" class="form-control" id="lantai" name="lantai" required value="{{ old('lantai') }}">
                        </div>
                        <div class="col-6">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                        <input type="number" class="form-control" id="kapasitas" name="kapasitas" required value="{{ old('kapasitas') }}">
                        </div>
                    </div>                    
                    <div class="mb-3">
                        <label for="tipe" class="form-label">Tipe Ruangan</label>
                        <select class="form-select" name="tipe" id="tipe" required>
                            <option disabled>Pilih Tipe Ruangan</option>
                            <option value="Laboratorium" {{ old('tipe') === 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                            <option value="Ruang Kelas" {{ old('tipe') === 'Ruang Kelas' ? 'selected' : '' }}>Ruang Kelas</option>
                            <option value="Ruang Dosen" {{ old('tipe') === 'Ruang Dosen' ? 'selected' : '' }}>Ruang Dosen</option>
                            <option value="Ruang Umum" {{ old('tipe') === 'Ruang Umum' ? 'selected' : '' }}>Ruang Umum</option>
                            <option value="Auditorium" {{ old('tipe') === 'Auditorium' ? 'selected' : '' }}>Auditorium</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi Ruangan</label>
                        <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" required>{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="editbtn" name="editbtn">Simpan</button>
                    </div>
                </form>
            </div>      

        </div>
    </div>
</div> -->