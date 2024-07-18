<!-- resources/views/auth/register.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Jenis Registrasi</title>
    <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Pilih Jenis Registrasi</div>
                    <div class="card-body">
                        <p>Silakan pilih jenis akun yang ingin Anda daftarkan:</p>
                        <!-- <ul>
                            <li><a href="{{ route('register.user') }}">Registrasi sebagai User (Staff)</a></li>
                            <li><a href="{{ route('register.admin') }}">Registrasi sebagai Admin</a></li>
                        </ul> -->
                        <button><a href="{{ route('register.user') }}">Registrasi sebagai User (Staff)</a></button>
                        <button><a href="{{ route('register.admin') }}">Registrasi sebagai Admin</a></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
