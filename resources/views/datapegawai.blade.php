@extends('layout.admin')
@section('content')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Pegawai</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Data Pegawai</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
<div class="container">
  <a href="/tambahpegawai" class="btn btn-success mb-4">Tambah</a>
  <div class="row g-3 align-items-center">

    <div class="col-auto">
      <form action="/pegawai" method="GET">
        <input type="search" name="search" class="form-control" >
      </form>
    </div>

    <div class="col-auto">
      <a href="/exportpdf" class="btn btn-info ">Export PDF</a>  
    </div>

    <div class="col-auto">
      <a href="/exportexcel" class="btn btn-success ">Export Excel</a>  
    </div>

    <div class="col-auto">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Import data
      </button> 
    </div>
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="/importexcel" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <input type="file" name="file" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>

      </div>
    </div>
  <!-- end button modal !-->

  </div>
  <div class="row">
    {{-- @if ($message = Session::get('success'))
      <div class="alert alert-success" role="alert">
        {{ $message }}
      </div>
    @endif --}}
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama</th>
              <th scope="col">Foto</th>
              <th scope="col">Jenis kelamin</th>
              <th scope="col">No telpon</th>
              <th scope="col">Dibuat</th>
              <th scope="col">aksi</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($data as $index => $row)
              <tr>
                  <th scope="row">{{ $index + $data->firstItem() }}</th>
                  <td>{{ $row->nama }}</td>
                  <td>
                    <img src="{{ asset('fotopegawai/'.$row->foto) }}" style="width: 40px; ">
                  </td>
                  <td>{{ $row->jeniskelamin }}</td>
                  <td>{{ $row->notelpon }}</td>
                  <td>{{ $row->created_at->format('D M Y') }}</td>
                  <td>
                      <a href="/show/{{ $row->id }}" class="btn btn-warning">Edit</a>
                      <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</a>
                  </td>
                </tr>    
              @endforeach
            
          </tbody>
        </table>
  </div>
  {!! $data->links() !!}
</div>

</div>



































@endsection