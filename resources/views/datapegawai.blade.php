@extends('layout.admin')
@push('css')

<link href ="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPpeVMTNDbiYZxYbOOl7+AMvyTG2x" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLpb9M36zpMScbmUNIcHUqk"
crossorigin="anonymous" referrerpolicy="no-referrer">


@endpush
@section('content')


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard v2</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v2</li>
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
</div>
@endsection


@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@0.5.1/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-gtEjrD/SeCtmISkJkNuaaKMoLD0//ElJI9smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
crossorigin="anonymous">  </script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toaster.js/latest/toastr.min.js"
integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $('.delete').click(function(){
    var pegawaiid = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');

    swal({
      title:"Yakin ?",
      text :"Kamu akan menghapus data pegawai dengan nama "+ nama + " ",
      icon :"warning",
      buttons: true,
      dangerMode:true,
    })
    .then((willDelete)=> {
        if(willDelete){
          window.location = "/delete/" + pegawaiid + ""
          swal("Data berhasil dihapus",{
            icon : "success",
          });
        }else {
          swal("Data tidak jadi dihapus");
        }
    });
  });
</script>
<script>
  @if (Session::has('success'))
  toastr.success("{{ Session::get('success') }}")
  @endif
</script>


@endpush