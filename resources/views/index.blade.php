@extends('layouts.main')

@section('judul')
    Web App Pencatatan Buku | Dito Kostolani Faruki - XI RPL 2
@endsection

@section('content')
<h2 class="mb-4">Dashboard | Web App Pencatatan Buku</h2>
<div class="mb-3">
    <a name="tambah" id="tambah" class="btn btn-primary" href="{{ url('modal.tambah') }}" role="button" data-bs-target="#tambah_buku" data-bs-toggle="modal">&#43; Tambah Data</a>
    <a name="reset" id="res" class="btn btn-warning" href="{{ url('/') }}" role="button">&#8634; Refresh</a>
    <!-- <a name="logout" id="out" class="btn btn-danger" href="" role="button">
        <i class="fa fa-sign-out"></i>
    </a> -->

    <!-- Search Box -->
    <form action="{{ url()->current() }}" method="GET" id="cari">
        @csrf
        <div class="input-group">
            <input type="search" name="search" value="{{ request('keyword') }}" class="form-control" placeholder="Search by Judul">
            <button class="btn btn-primary" type="submit">&#128269;</button>
        </div>
    </form>

</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<!-- Main Tables -->
<table class="table table-striped table-hover table-inverse table-responsive" id="table_id">
    <thead class="table-secondary">
        <tr align="center">
            <th>No</th>
            <th>Judul Buku</th>
            <th>Author</th>
            <th>Penerbit</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($bukus as $no => $buku)
        <tr>
            <td align="center" width="50px">{{ ++$no }}</td>
            <td width="300px">
               <a href="#detail_buku{{ $buku->id }}" data-bs-toggle="modal" data-bs-target="#detail_buku{{ $buku->id }}">{{ $buku->judul }}</a>
            </td>
            <td align="center" width="150px">{{ $buku->author }}</td>
            <td align="center" width="150px">{{ $buku->penerbit }}</td>
            <td align="center" width="150px">
                <a name='edit' id='edit' class='btn btn-success' href="{{ url('modals.edit', $buku->id) }}" role='button' data-bs-toggle="modal" data-bs-target="#edit_buku">Edit</a>
                <a role="button" href="{{ url('delete', $buku->id) }}" type="submit" class="btn btn-danger" name="delete" id="delete" onclick="return confirm('Apakah Anda Yakin?')">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@include('modals.detail')
@include('modals.edit')
@include('modals.tambah')
<!-- Main Tables -->
@endsection