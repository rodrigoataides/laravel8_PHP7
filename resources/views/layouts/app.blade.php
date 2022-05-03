<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ilha Burguer</title>

    <!-- Scripts -->
    <script src="{{ asset(env('ASSETS').env('APP_PATH').'js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset(env('ASSETS').env('APP_PATH').'css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- icones -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.4-beta.33/inputmask.js"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- CARROUSEL -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- carrousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<style>
    /* .container_bg_img{
        background-image: url("{{ asset(env('ASSETS').env('APP_PATH').'imgs/fazenda_info_blue.png')}}");
        background-repeat: no-repeat;
        background-position: center;
        background-size: 50%;
    } */
</style>

<script>
    $(document).ready(function(){

        $(":input").inputmask();

    });

    function aplicarCarousel(loop=true, nav=true, margin=10, center=true, carousel){
        $('#'+carousel).owlCarousel({
            loop:loop,
            autoplay:true,
            interval : 2000,
            autoplayHoverPause:true,
            margin:margin,
            nav:nav,
            animateOut: 'fadeOut',
            responsiveClass:true,
            responsive:{
                0:{
                    items:1
                },
                500:{
                    items:2
                },
                800:{
                    items:3
                },
                1000:{
                    items:4
                },
                1300:{
                    items:5
                }
            }
        });
    }

    function con(method, url, objData, callback, text_load){
        //text_load == null ? $('#text_load').html("Aguarde, estamos processando sua requisição!") : $('#text_load').html(text_load);
        //$(".loader").fadeIn("slow");
        if(typeof(callback) === 'undefined'){ callback=function(){}; }
        objData['_token'] = '{{ csrf_token() }}';
        $.ajax({
            type: method,
            url: "{{ env('APP_URL') }}/"+url,
            dataType: "json",
            data: objData,
            async: true,
            success: function(data, xhr, textStatus){
                //$(".loader").fadeOut("slow");
                callback(data);
            }
        });
    }

    function conFile(method, url, formData, callback, text_load){
        //text_load == null ? $('#text_load').html("Aguarde, estamos processando sua requisição!") : $('#text_load').html(text_load);
        //$(".loader").css("display", "block");
        if(typeof(callback) === 'undefined'){ callback=function(){}; }
        $.ajax({
            url: "{{ env('APP_URL') }}/"+url,
            type: 'POST',
            enctype: 'multipart/form-data',
            dataType: "JSON",
            data: formData,
            processData: false, // impedir que o jQuery tranforma a "data" em querystring
            contentType: false, // desabilitar o cabeçalho "Content-Type"
            cache: false, // desabilitar o "cache"
            success: function(data, xhr, textStatus){
                //$(".loader").css("display", "none");
                callback(data);
            },
            error: function (e) {
                mensagemAlerta("Erro: ", e);
                //$(".loader").delay(1500).fadeOut("slow");
                //$(".loader").css("display", "none");
            }
        });
    }

    function mensagemConfirm(titulo, mensagem){
        var retorno = null;
        $('#mensagemConfirmModalLabel').html(titulo);
        $('#mensgagemConfirmModalMensage').html(mensagem);
        $('#mensagemConfirm').modal('show');
        document.getElementById('confirm').addEventListener('click', function(){
            return true;
        });
        document.getElementById('cancel').addEventListener('click', function(){
            return false;
        });
    }

    function mensagemAlerta(titulo, mensagem){
        $('#mensagemModalLabel').html(titulo);
        $('#mensagemModalMensage').html(mensagem);
        $('#mensagemModal').modal('show');
    }

    @if(isset($pessoa) && $pessoa != null)

        function openIndicacao(curso_id, curso_nome){
            var valor = "";
            valor+= "<p class=\"card-text\"><h5><strong><a href=\"#\" onclick=\"javascript: copyTicket();\">"+curso_nome+"</a></strong></h5></p>";
            valor+= "<input type=\"hidden\" id=\"ticket\" value=\"{{ env('APP_URL') }}/indicacaocurso/{{ $pessoa->id }}_"+curso_id+"\" />";
            valor+= "<p>Clique no nome do curso acima para copiar o link da indicação.</p>";
            valor+= "<div class=\"row col-md-12\">";
                valor+= "<div class=\"input-group input-lg\">";
                    valor+= "<input type=\"text\" class=\"form-control\" style=\"height: 46px; width: 130px;\" placeholder=\"Telefone contato\" value=\"\" id=\"telefone_whats_indicacao\" name=\"telefone_whats_indicacao\">";
                    valor+= "<div class=\"input-group-prepend\">";
                        valor+= "<span class=\"input-group-text\">";
                            valor+= "<a target=\"_blank\" hint=\"Enviar via WhatsApp\" href=\"#\" onclick=\"javascript: sendWhatsIndicacao("+curso_id+", \'"+curso_nome+"\');\"><img src=\"{{ asset(env('ASSETS').env('APP_PATH').'imgs/whatsapp.png')}}\" width=\"36\"></a>";
                        valor+= "</span>";
                    valor+= "</div>";
                valor+= "</div>";
                valor+= "<br><p>Ou digite um telefone e envie uma mensagem pelo whatsapp.</p>";
            valor+= "</div>";
            $('#indicacaoModalCurso').html(valor);

            $("#telefone_whats_indicacao").inputmask({
                mask: '(99) 99999-9999',
                placeholder: ' ',
                showMaskOnHover: false,
                showMaskOnFocus: false,
                onBeforePaste: function (pastedValue, opts) {
                var processedValue = pastedValue;

                //do something with it

                return processedValue;
                }
            });
        }
    @endif

    function openTermosConteudista(){
        //buscar o termo
        mensagemAlerta('Termos e condições', 'Implementar aqui o texto dos termos');
    }

</script>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-none">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/') }}">
                    {{-- <img src="{{ asset(env('ASSETS').env('APP_PATH').'imgs/android-icon-36x36.png')}}" class="img-fluid rounded" alt="...">&nbsp;&nbsp;&nbsp;Ilha Burger --}}
                    Nome e imagem do sistema
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Acesso') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Sistema</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <footer class="fixed-bottom bg-white shadow-sm">
        <!-- Copyright -->
        <div class="text-center">
            <span class="text-black">© 2022 Copyright:</span>&nbsp;
            <a class="link-dark" href="{{ url('/') }}">Fazenda Info</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>
</html>
