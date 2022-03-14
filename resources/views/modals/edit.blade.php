@extends('layouts.main')
@section('judul')
    Edit Data | Web App Pencatatan Buku
@endsection

    <!-- Modal -->
<div class="modal fade" id="edit_buku" tabindex="-1" aria-labelledby="editBukuModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Data | Web App Pencatatan Buku</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('buku', $buku->id) }}" method="POST" class="form-item">
                @csrf
                @method('PUT')
                    <div class="form-group">
                        <label for="id">ID Buku</label>
                        <input type="number" name="id" class="form-control col-md-9" id="cb" placeholder="Masukkan ID Buku" value="{{ $buku->id }}" readonly>
                    </div>
        
                    <div class="form-group">
                        <label for="judul">Judul Buku</label>
                        <input type="text" name="judul" class="form-control col-md-9" id="cb" placeholder="Masukkan Judul Buku" value="{{ $buku->judul }}"> 
                    </div>
        
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" name="author" class="form-control col-md-9" id="cb" placeholder="Masukkan Nama Author" value="{{ $buku->author }}">
                    </div>
        
                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" class="form-control col-md-9" id="cb" placeholder="Masukkan Nama Penerbit" value="{{ $buku->penerbit }}">
                    </div>
        
                    <div class="form-group">
                        <label for="sinopsis">Sinopis</label>
                        <textarea name="sinopsis" class="form-control col-md-9" id="cb" cols="2" rows="3" placeholder="Masukkan Sinopsis Buku" required>{{ $buku->sinopsis }}</textarea>
                        <!-- <input type="text" name="sinopsis" class="form-control col-md-9" id="cb" placeholder="Masukkan Sinopis Buku" value=""> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
                    <a name="batal" class="btn btn-danger" href="{{ url('/') }}" role="button" type="reset" onclick="return confirm('Apakah Anda Yakin?')">Batal</a>
                </form>
        </div>
      </div>
  </div>
</div>