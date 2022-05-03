<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ilha Burger</title>

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

    <!-- jquery.mask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Chart and animations -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.1/dist/Chart.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <!-- jquery-ui -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <style>
        input.uppercase { text-transform: uppercase; }
        input.lowercase { text-transform: lowercase; }
        .card-header{
            font-size: 16px;
            color: #4F4F4F;
            font-weight: bold;
        }
        label {
            font-size: 11px;
            color: #707070;
            font-weight: bold;
        }

        .btn {
            .btn-sm;
        }

        .nav-link:focus, .nav-link:hover {
            color: #0005A0;
        }

        .nav-link {
            color: #000000;
        }

        .bg-hamburger-nav {
            /* The image used */
            background-image: linear-gradient(rgba(255,255,255,0.7),rgba(255,255,255,0.7)), url("{{ asset(env('ASSETS').env('APP_PATH').'imgs/fundo_menu_ilha.jpg')}}");

            min-height: 380px;

            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;


            /* Needed to position the navbar */
            position: relative;
        }

    </style>

    <script>
        $(document).ready(function(){

            $( ".card" ).draggable();

            $('.dropdown-toggle').dropdown();

            $(":input").inputmask();

            loadConfMask();

            @if(isset($mensagem))
                mensagemAlerta("{{ $mensagem['titulo'] }}", "{{ $mensagem['mensagem'] }}");
            @endif

            if (window.innerWidth < 992) {

                // close all inner dropdowns when parent is closed
                document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown){
                everydropdown.addEventListener('hidden.bs.dropdown', function () {
                    // after dropdown is hidden, then find all submenus
                    this.querySelectorAll('.submenu').forEach(function(everysubmenu){
                        // hide every submenu as well
                        everysubmenu.style.display = 'none';
                    });
                })
                });

                document.querySelectorAll('.dropdown-menu a').forEach(function(element){
                element.addEventListener('click', function (e) {
                    let nextEl = this.nextElementSibling;
                    if(nextEl && nextEl.classList.contains('submenu')) {
                        // prevent opening link if link needs to open dropdown
                        e.preventDefault();
                        if(nextEl.style.display == 'block'){
                        nextEl.style.display = 'none';
                        } else {
                        nextEl.style.display = 'block';
                        }

                    }
                });
                })
            }

            $('.uppercase').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });

            $('.lowercase').keyup(function() {
                this.value = this.value.toLocaleLowerCase();
            });

        });

        function loadPage(page){
            $("#containner").load("{{ asset(env('APP_URL'))."/"}}"+page+" #containner");
        }

        function loadConfMask(){
            /*jquery.mask*/
            $('.date').mask('00/00/0000');
            $('.time').mask('00:00:00');
            $('.date_time').mask('00/00/0000 00:00:00');
            $('.cep').mask('00000-000');
            $('.phone').mask('0000-0000');
            $('.phone_with_ddd').mask('(00) 0000-0000');
            $('.phone_us').mask('(000) 000-0000');
            $('.mixed').mask('AAA 000-S0S');
            $('.cpf').mask('000.000.000-00', {reverse: true});
            $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
            $('.money').mask('000.000.000.000.000,00', {reverse: true});
            $('.money2').mask("#.##0,00", {reverse: true});
            $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                'Z': {
                    pattern: /[0-9]/, optional: true
                }
                }
            });
            $('.ip_address').mask('099.099.099.099');
            $('.percent').mask('##0,00%', {reverse: true});
            $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
            $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
            $('.fallback').mask("00r00r0000", {
                translation: {
                    'r': {
                    pattern: /[\/]/,
                    fallback: '/'
                    },
                    placeholder: "__/__/____"
                }
                });
            $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
            //Medidas
            $('.gr').mask("#.##0", {reverse:true});
            $('.kg').mask("#.##0,000", {reverse:true});
            $('.und').mask("#.##0", {reverse:true});
            $('.l').mask("#.##0,000", {reverse:true});
            $('.ml').mask("#.##0,000", {reverse:true});
            $('.pc').mask("#.##0", {reverse:true});
            $('.lt').mask("#.##0", {reverse:true});
            $('.pt').mask("#.##0", {reverse:true});
            /*Fim jquery.mask*/
        }

        function aplicarCarousel(loop=true, nav=true, margin=10, center=true, carousel){
            $('#'+carousel).owlCarousel({
                loop:loop,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                margin:margin,
                nav:nav,
                animateOut: 'fadeOut',
                responsive:{
                    0:{
                        items:1
                    },
                    400:{
                        items:3
                    },
                    800:{
                        items:4
                    },
                    1200:{
                        items:5
                    }
                }
            });
        }

        function con(method, url, objData, callback, text_load = ''){
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

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md" style="background-color: #000000">
            <div class="container">
                <a class="navbar-brand text-light" href="{{ url('/home') }}">
                    <img src="{{ asset(env('ASSETS').env('APP_PATH').'imgs/android-icon-36x36.png')}}" class="img-fluid rounded" alt="...">&nbsp;&nbsp;&nbsp;Loja - Ilha Burger
                </a>
                {{-- <span class="text-light"></span> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-static-top pl-4 pr-4" id="ul_menus"></ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    {{-- <img src="{{ asset(env('ASSETS').env('APP_PATH').'imgs/android-icon-36x36.png')}}" class="img-fluid rounded" alt="..."> --}}
                    Menu
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ asset(env('APP_URL')).'/home' }}">Home</a>
                        </li>
                        @foreach ($menus as $menu)
                            @if (sizeof($menu->submenu) > 0)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $menu->nome }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($menu->submenu as $submenu)
                                        <li><a class="dropdown-item" href="{{ asset(env('APP_URL')).'/'.$submenu->route }}">{{ $submenu->nome }}</a></li>
                                        {{-- <li><a class="dropdown-item" href="#" onclick='javascript: loadPage("{{$submenu->route }}");'>{{ $submenu->nome }}</a></li> --}}
                                        {{-- <div class="dropdown-divider"></div> --}}
                                    @endforeach
                                </ul>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ asset(env('APP_URL')).'/'.$menu->route }}" aria-current="page">{{ $menu->nome }}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            <div class="container-fluid rounded-left">
                <div class="row flex-nowrap">
                    {{-- Menu Vertical --}}
                    {{-- <div class="col-auto col-md-2 col-xl-2 px-sm-2 px-0 bg-hamburger-nav" style="background-color: #00000069;">
                        <div class="d-flex flex-column align-items-center align-items-sm-start text-light min-vh-100">
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                                <li class="nav-item">
                                    <a href="{{ asset(env('APP_URL')).'/home' }}" class="nav-link align-middle px-0">
                                        <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                                    </a>
                                </li>
                                @foreach ($menus as $menu)
                                <li>
                                    @if (sizeof($menu->submenu) > 0)
                                        <a href="#submenu{{ $menu->id }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                            <i class="fs-4 {{ $menu->icon }}"></i> <span class="ms-1 d-none d-sm-inline">{{ $menu->nome }}</span> </a>
                                        <ul class="collapse nav flex-column ms-1" id="submenu{{ $menu->id }}" data-bs-parent="#menu">
                                            @foreach ($menu->submenu as $submenu)
                                                <li class="w-100 fs-6">
                                                    <a href="{{ asset(env('APP_URL')).'/'.$submenu->route }}" class="nav-link px-0"> <i class="bi {{ $submenu->icon }}"></i> <span class="d-none d-sm-inline">{{ $submenu->nome }}</span></a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <a href="{{ asset(env('APP_URL')).'/'.$menu->route }}" class="nav-link px-0 align-middle">
                                            <i class="fs-4 {{ $menu->icon }}"></i> <span class="ms-1 d-none d-sm-inline">{{ $menu->nome }}</span></a>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                            <hr>
                        </div>
                    </div> --}}
                    <div class="col py-1 pb-4" style="background-color: #FFFFFF" id="containner">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="mensagemModal" class="modal" tabindex="-1" role="dialog" aria-labelledby="mensagemModalLabel" aria-hidden="true">
        <div class="modal-dialog col-md-8 modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mensagemModalLabel"></h5>
                </div>
                <div class="modal-body">
                    <span id="mensagemModalMensage" class="text-justify"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="cancel" onclick="javascript: $('#mensagemModal').modal('hide');">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <footer class="fixed-bottom bg-dark">
        <!-- Copyright -->
        <div class="text-center">
            <span class="text-light">© 2022 Copyright:</span>&nbsp;
            <a class="link-light" href="{{ url('/') }}">Ilha Burger by RDCA-TI</a>
        </div>
        <!-- Copyright -->
    </footer>
</body>
</html>
