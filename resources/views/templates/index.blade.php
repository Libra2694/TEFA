<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <title>AdminLTE 3 | Starter</title>
    @include('Template.head')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('Template.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('Template.left-sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            @if (auth()->user()->role == 'admin')
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <button class="btn btn-primary col-md-12">Form Penelitian</button>
                            @foreach ($template_penelitian as $pe)
                                <div class="col-md-3 mt-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Template {{ $pe['kategori_template'] }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <form method="POST" action="{{ route('templates.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="kategori"
                                                        value="{{ $pe['kategori_template'] }}">
                                                    <input type="hidden" name="jenis" value="penelitian">

                                                    <!-- Upload Panduan -->
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="file_panduan">Upload Panduan:</label>
                                                            @if ($pe['panduan'] && $pe['panduan']->path_template)
                                                                <span class="direct-chat-timestamp float-left">Last
                                                                    Update:
                                                                    {{ $pe['panduan']->updated_at }}</span>
                                                            @endif
                                                            <div class="custom-file">
                                                                <input type="file" name="file_panduan"
                                                                    id="file_panduan" class="form-control-file">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Template -->
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="file_template">Upload Template:</label>
                                                            @if ($pe['template'] && $pe['template']->path_template)
                                                                <span class="direct-chat-timestamp float-left">Last
                                                                    Update:
                                                                    {{ $pe['template']->updated_at }}</span>
                                                            @endif
                                                            <div class="custom-file">
                                                                <input type="file" name="file_template"
                                                                    id="file_template" class="form-control-file">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-primary col-md-12">Upload</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <button class="btn btn-success col-md-12 mt-2">Form Pengabdian</button>
                            @foreach ($template_pengabdian as $pg)
                                <div class="col-md-3 mt-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Template {{ $pg['kategori_template'] }}</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <form method="POST" action="{{ route('templates.store') }}"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="kategori"
                                                        value="{{ $pg['kategori_template'] }}">
                                                    <input type="hidden" name="jenis" value="pengabdian">

                                                    <!-- Upload Panduan -->
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="file_panduan">Upload Panduan:</label>
                                                            @if ($pg['panduan'] && $pg['panduan']->path_template)
                                                                <span class="direct-chat-timestamp float-left">Last
                                                                    Update:
                                                                    {{ $pg['panduan']->updated_at }}</span>
                                                            @endif
                                                            <div class="custom-file">
                                                                <input type="file" name="file_panduan"
                                                                    id="file_panduan" class="form-control-file">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Upload Template -->
                                                    <div>
                                                        <div class="form-group">
                                                            <label for="file_template">Upload Template:</label>
                                                            @if ($pg['template'] && $pg['template']->path_template)
                                                                <span class="direct-chat-timestamp float-left">Last
                                                                    Update:
                                                                    {{ $pg['template']->updated_at }}</span>
                                                            @endif
                                                            <div class="custom-file">
                                                                <input type="file" name="file_template"
                                                                    id="file_template" class="form-control-file">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-primary col-md-12">Upload</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @else
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Penelitian</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($template_penelitian as $ltpe)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        {{ $ltpe['kategori_template'] }}
                                                        <br>
                                                        @if ($ltpe['panduan'] && $ltpe['panduan']->path_template)
                                                            <small>Last upload panduan
                                                                : {{ $ltpe['panduan']->updated_at }}</small><br>
                                                        @else
                                                            <small>Panduan Belum Ada!</small><br>
                                                        @endif
                                                        @if ($ltpe['template'] && $ltpe['template']->path_template)
                                                            <small>Last upload template
                                                                : {{ $ltpe['template']->updated_at }}</small>
                                                        @else
                                                            <small>Template Belum Ada!</small>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="{{ $ltpe['panduan']->path_template ? 'storage/' . $ltpe['panduan']->path_template : '#' }}"
                                                            target="_blank" class="btn btn-info" download>Panduan</a>
                                                        <a href="{{ $ltpe['template']->path_template ? 'storage/' . $ltpe['template']->path_template : '#' }}"
                                                            target="_blank" class="btn btn-primary"
                                                            download>Template</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h3 class="card-title">Pengabdian</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($template_pengabdian as $ltpg)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        {{ $ltpg['kategori_template'] }}
                                                        <br>
                                                        @if ($ltpg['panduan'] && $ltpg['panduan']->path_template)
                                                            <small>Last upload panduan
                                                                : {{ $ltpg['panduan']->updated_at }}</small><br>
                                                        @else
                                                            <small>Panduan Belum Ada!</small><br>
                                                        @endif
                                                        @if ($ltpg['template'] && $ltpg['template']->path_template)
                                                            <small>Last upload template
                                                                : {{ $ltpg['template']->updated_at }}</small>
                                                        @else
                                                            <small>Template Belum Ada!</small>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <a href="{{ $ltpg['panduan']->path_template ? 'storage/' . $ltpg['panduan']->path_template : '#' }}"
                                                            target="_blank" class="btn btn-info" download>Panduan</a>
                                                        <a href="{{ $ltpg['template']->path_template ? 'storage/' . $ltpg['template']->path_template : '#' }}"
                                                            target="_blank" class="btn btn-primary"
                                                            download>Template</a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <!-- /.content-header -->

            <!-- Main content -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        @include('Template.footer')
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    @include('Template.script')
</body>

</html>
