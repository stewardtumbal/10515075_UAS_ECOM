@extends('templates/header')

@section('content')

<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Data Siswa
        <small>SMKN 1 Cimahi</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Siswa</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      @include('templates/feedback')
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href='{{ url("siswa/add") }}' class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah </a>
        </div>
        <div class="box-body">
          <table class="table table-stripped">
            <thead>
              <tr>
                <th>No</th>
                <th>Foto</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Kelas</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach($result as $row)
              <tr>
                <td>{{ !empty($i) ? ++$i : $i = 1 }}</td>
                <td><img src='{{ asset("uploads/".@$row->foto) }}' width="80px" class="img"></td>
                <td>{{ $row->nama_lengkap }}</td>
                <td>{{ $row->jenis_kelamin_display }}</td>
                <td>{{ $row->alamat }}</td>
                <td>{{ $row->no_telp }}</td>
                <td>{{ $row->kelas->nama_kelas }}</td>
                <td><a href='{{ url("siswa/$row->nis/edit") }}' class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></a>
                  <form action='{{ url("siswa/$row->nis/delete") }}' method="GET" style="display:inline;"> <!-- Jika Pakai GET di routes/web.php "delete" ganti jadi get -->
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
    @endsection
  </div>
  <!-- /.content-wrapper -->