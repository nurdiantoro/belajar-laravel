@include('templates.header')

<div id="wrapper">
    @include('templates.sidebar')

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            @include('templates.topbar_content')

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Halaman Read Detail</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <td>ID</td>
                                <td> : </td>
                                <td>{{ $mahasiswa->id }}</td>
                            </tr>
                            <tr>
                                <td>NIM</td>
                                <td> : </td>
                                <td>{{ $mahasiswa->nim }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td> : </td>
                                <td>{{ $mahasiswa->nama }}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> : </td>
                                <td>{{ $mahasiswa->email }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td> : </td>
                                <td><?php echo date('d F Y', strtotime($mahasiswa->tanggal_lahir)); ?></td>
                            </tr>
                        </table>

                        <a href="{{ url()->previous() }}" class="btn btn-primary">
                            <i class="fa-solid fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>

        @include('templates.footer_content')

    </div>

</div>

@include('templates.footer')
