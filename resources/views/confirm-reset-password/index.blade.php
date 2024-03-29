<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{!! '/dis/images/logo.png' !!}" type="image/x-icon">
    <link rel="shortcut icon" href="{!! '/dis/images/logo.png' !!}" type="image/x-icon">
    <title>Klinik Yazin Pratama</title>
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <style type="text/css">
      body{
      font-family: work-Sans, sans-serif;
      background-color: #f6f7fb;
      display: block;
      }
      a{
      text-decoration: none;
      }
      span {
      font-size: 14px;
      }
      p {
        font-size: 13px;
        line-height: 1.7;
        letter-spacing: 0.7px;
        margin-top: 0;
      }
      .text-center{
      text-align: center
      }
    </style>
  </head>
  <body style="margin: 30px auto;">
    <table style="margin: auto;">
      <tbody>
        <tr>
          <td>
            <table style="background-color: #f6f7fb; ">
              <tbody>
                <tr>
                  <td>
                    <table style="margin: 0 auto; margin-bottom: 30px">
                      <tbody>
                        <tr>
                          <td><img src="{!! asset('/dis/images/logo.png') !!}" alt="" style="align-self: center"></td>
                        </tr>
                      </tbody>
                    </table>
                    <table style="margin: 0 auto; background-color: #fff; border-radius: 8px">
                      <tbody>
                        <tr>
                          <td style="padding: 30px"> 
                            <h3>{{ $title }}</h3>
                            <div class="text-center">
                                {{-- <a href="{!! url('confirm-reset-password/'.$details['token']) !!}" style="padding: 10px; background-color: #7366ff; color: #fff; display: inline-block; border-radius: 4px; margin-bottom: 18px">Konfirmasi </a> --}}
                            </div>
                            <p>{{ $subTitle }}</p>
                            <p style="margin-bottom: 0">Terima Kasih,</p>
                            <p style="margin-bottom: 0">Klinik Yazin Pratama</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <table style="margin: 0 auto; margin-top: 30px">
                      <tbody>       
                        <tr style="text-align: center">
                          <td> 
                            <p style="color: #999; margin-bottom: 0">Jl. Musyawarah No.71 Saentis, Kab. Deli Serdang, Sumatera Utara</p>
                            <p style="color: #999; margin-bottom: 0">Powered By Klinik Yazin Pratama</p>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>
  </body>
</html>