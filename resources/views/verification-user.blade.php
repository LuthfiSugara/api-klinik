<!doctype html>
<html>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">

    <style>
        #content {
            display: block;
        }

        .internal {
            display: block;
        }
    </style>

    <title>Verifikasi User</title>
</head>

<body>
    <h2 style="font-weight: bold;">Verifikasi Email</h2>
    <p>Anda baru saja mendaftar di aplikasi <span style="font-weight: bolder;">Klinik</span> Untuk menyelesaikan proses pendaftaran. Konfirmasi Alamat email dengan mengklik tombol aktivasi berikut ini.</p>
    <a href="{{ url('/api/verification-email') . '/' . $details['id_user'] . '/' . $details['key_validation'] }}" style="background-color: #ff9800; color: white; padding-top: 5px; padding-bottom: 5px; padding-left: 10px; padding-right: 10px; text-decoration: none; border-radius: 5px;">Ya, Konfirmasi Pendaftaran</a>
    <p>Jika anda merasa tidak melakukan pendaftaran, mohon abaikan email ini.</p>
</body>

</html>
