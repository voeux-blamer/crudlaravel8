<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>CRUD Laravel 8!</title>
  </head>
  <body>
    <h1 class="text-center mb-4">Data pegawai</h1>
    
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

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>
  <script>

    $('.delete').click(function(){
      var pegawai_id = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');
      swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this name "+nama+" ",
              icon: "warning",
              buttons: true,
              dangerMode: true,
        })
            .then((willDelete) => {
              if (willDelete) {
                window.location = "/delete/"+pegawai_id+""
                swal("Poof! Your data has been deleted!", {
                  icon: "success",
                });
              } else {
                swal("Your data is safe!");
              }
        });
    });
  </script>

  <script>
    @if(Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
    @endif


  </script>
</html>