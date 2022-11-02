<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.0.7/css/all.css">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1#success {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }

        h1#fail {
          color: #ff1f1f;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }

        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i#success {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }

      i#fail {
        color: #f91919;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        @if ($status == "success")
            <i id="success" class="fas fa-check"></i>
        @else
            <i id="fail" class="fas fa-times"></i>
        @endif
      </div>

        @if ($status == "success")
            <h1 id="success">Berhasil</h1>
        @else
            <h1 id="fail">Gagal</h1>
        @endif

        @if ($status == "success")
            <p>Email berhasil di verifikasi, Silahkan login ke aplikasi!</p>
        @else
            <p>Email gagal di verifikasi, Silahkan coba beberapa Saat lagi!</p>
        @endif
      </div>
    </body>
</html>
