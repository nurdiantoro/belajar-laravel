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
                    <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                </div>

                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-6">
                        {{-- menampilkan pesan error dari validasi --}}
                        <?php
                        $error_nama = '';
                        $error_email = '';
                        if ($errors->any()) {
                            $error_nama = $errors->first('nama');
                            $error_email = $errors->first('email');
                        }
                        ?>

                        @if ($request->session()->has('pesan'))
                            <div class="alert alert-success">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <form action="user_detail" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama"
                                    value="{{ Auth::user()->name }}">
                                <small class="text-danger">{{ $error_nama }}</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" name="email"
                                    value="{{ Auth::user()->email }}">
                                <small class="text-danger">{{ $error_email }}</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto</label>
                                <input class="form-control" type="file" name="foto"
                                    value="{{ Auth::user()->foto }}">
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
