<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 35px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">


            <div class="content">
                <div class="title" style="max-width: 800px;">
                    <p>Atenção!</p>
                    <p>Você merece navegar em um ambiente rápido e seguro, por isso pedimos que acesse o sistema a partir de um dos seguintes navegadores :)</p>
                </div>
                <div style="display: flex; justify-content: space-around;">
                    <div>
                        <a href="https://www.google.com/intl/pt-BR/chrome/">
                            <div>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Google_Chrome_icon_%28September_2014%29.svg/1024px-Google_Chrome_icon_%28September_2014%29.svg.png" style="max-width: 150px;" alt="O Chrome é um navegador da Web rápido, seguro e gratuito." class="chr-full-bleed-hero__image" data-img-fallback="/chrome/static/images/fallback/chrome-logo.png">
                            </div>
                            <div>
                                Google Chrome
                            </div>
                        </a>
                    </div>
                    <div>
                        <a href="https://www.mozilla.org/pt-BR/firefox/download/thanks/">
                            <div>
                                <img src="https://www.mozilla.org/media/img/logos/firefox/logo-quantum-high-res.cfd87a8f62ae.png" style="max-width: 150px;" alt="O Chrome é um navegador da Web rápido, seguro e gratuito." class="chr-full-bleed-hero__image" data-img-fallback="/chrome/static/images/fallback/chrome-logo.png">
                            </div>
                            <div>
                                Mozilla Firefox
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>
