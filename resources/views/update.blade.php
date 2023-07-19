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
                    <h1 class="h3 mb-0 text-gray-800">Halaman Update</h1>
                </div>

                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-md-6">
                        @if ($request->session()->has('pesan'))
                            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show"
                                role="alert">
                                <div class="d-flex w-100">
                                    <div class="bi flex-shrink-0 me-2 mr-2">
                                        <i class="fa-solid fa-square-check"></i>
                                    </div>
                                    <div>
                                        {{ $request->session()->get('pesan') }}
                                    </div>
                                    <div class="ms-auto">
                                        <button type="button" class="btn" data-bs-dismiss="alert"
                                            aria-label="Close">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <td>NIM</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Tanggal Lahir</td>
                                <td></td>
                            </tr>
                            @foreach ($mahasiswa as $mhs)
                                <tr>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->email }}</td>
                                    <td>{{ $mhs->tanggal_lahir }}</td>
                                    <td><a href="update/{{ $mhs->id }}" class="btn btn-primary">Ubah</a></td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>

        @include('templates.footer_content')

    </div>

</div>

@include('templates.footer')
