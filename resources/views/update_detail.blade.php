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
                        <form action="{{ url('update/action') }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $mahasiswa->id }}">
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" value="{{ $mahasiswa->nim }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama"
                                    value="{{ $mahasiswa->nama }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ $mahasiswa->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="tanggal_lahir"
                                    value="{{ $mahasiswa->tanggal_lahir }}">
                            </div>

                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <a href="{{ url()->previous() }}" class="btn btn-outline-primary w-100">
                                        <i class="fa-solid fa-arrow-left"></i> Kembali</a>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <button class="btn btn-primary w-100" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>

        @include('templates.footer_content')

    </div>

</div>

@include('templates.footer')
