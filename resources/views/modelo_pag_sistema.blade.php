@extends('layouts.appaccess')

@section('content')

    <script>
        $(document).ready(function(){
            $("#table").DataTable({
                aoColumns: [
                    {mData: 'opcao'},
                    {mData: 'id', visible: false},
                    {mData: 'nome'},
                ],
                "scrollY":        "300px",
                "scrollCollapse": true,
                "paging":         false,
                "order":          true,
                "filter":         false,
                language: dataTableLanguage
            });
        });

        function loadCadastro(){
            $('#form_')[0].reset();
            $('#id').val('');
            $('#div_lista').fadeOut('faster', () => $('#div_cadastro').fadeIn('faster'));
        }

        function loadLista(){
            $('#form_')[0].reset();
            $('#id').val('');
            loadListaItens();
            $('#div_cadastro').fadeOut('faster', () => $('#div_lista').fadeIn('faster'));
        }

    </script>

    <div class="container" id="div_cadastro">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <form id="form_fazenda">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control form-control-sm" id="nome" name="nome" placeholder="Nome do Menu" required="required"  aria-describedby="infoPJFazenda">
                                <div id="infoPJFazenda" class="form-text"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer text-right">
                <a href="#" onclick="javascript: " class="btn btn-sm btn-success">Gravar</a>
                <a href="#" onclick="javascript: " class="btn btn-sm btn-warning">Fechar</a>
            </div>
        </div>
    </div>
    <div class="container" id="div_lista">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                <table class="table table-striped" id="table_estoque" name="table_estoque">
                    <thead>
                        <th><small>Opções</small></th>
                        <th><small>Nome</small></th>
                    </thead>
                </table>
            </div>
            <div class="card-footer text-right">
                <a href="#" onclick="javascript: " class="btn btn-sm btn-success">Cadastro</a>
            </div>
        </div>
    </div>

@endsection
