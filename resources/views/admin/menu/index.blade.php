@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-lg-4">
    <div class="col-lg-12">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Categorias</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Adicione novas categorias ao seu menu</h6>
            </div>
            <div class="card-body">
                <p class="help-block">Clique no nome para editar um produto ou categoria.</p>
                <p class="help-block">Arraste com o <i class="fas fa-arrows-alt"></i> para reordenar</p>
                <p class="help-block">Use o <i class="fas fa-power-off"></i> para ativar ou desativar.</p>
                <form role="form" method="post" action="{{route('admin-store-menu-category')}}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" name="name" placeholder="Nome da categoria" class="form-control">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary btn-user">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" style="display: block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                </form>
                <table class="db col-12">
                    <tbody>
                    @foreach($menu_categories as $menu_category)

                        <tr  id="item_{{$menu_category->id}}">
                            <td>
                                <div class="btn-group btn-block" role="group">
                                    <a role="button" class="btn btn-{{  $menu_category->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                    </a>
                                    <a role="button" data-photo="{{$menu_category->photo}}" data-id="{{$menu_category->id}}" data-name="{{$menu_category->name}}"  class="editCategory btn btn-{{  $menu_category->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-target="#editCategoryModal">
                                        <span class="text float-left" >{{$menu_category->name}}</span>
                                    </a>

                                    <a href="{{route('admin-change-visibility-menu-category', $menu_category->id)}}" role="button" class="btn btn-{{  $menu_category->visible === true ? "primary":"secondary" }} btn-lg">
                                        <span class="icon text-white-50">
                                           <i class="fas fa-power-off"></i>
                                        </span>
                                    </a>
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

        <div class="col-lg-8">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Produtos</h1>
            </div>
    @foreach($menu_categories as $menu_category)
    <div class="col-lg-12">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{$menu_category->name}}</h6>
            </div>
            <div class="card-body">
                <form role="form" method="post" action="{{route('admin-store-menu-item')}}">
                    @csrf
                    <input type="hidden" name="menu_category_id" value="{{$menu_category->id}}">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-7">
                                <div class="input-group">
                                    <input type="text" name="name_{{$menu_category->id}}" placeholder="Nome do produto" class="form-control">
                                </div>
                                @error('name_'.$menu_category->id)
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-5">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">R$</div>
                                    </div>
                                    <input type="text" id="menu_price" name="price" placeholder="0,00" class="form-control">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary btn-user">
                                            Adicionar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="help-block">Adicione novos produtos a sua categoria.</p>

                    </div>
                </form>
                <table class="db_item col-12">
                    <tbody>
                    @foreach($menu_category->menu_itens as $menu_item)
                        <tr  id="item_{{$menu_item->id}}">
                            <td>
                                <div class="btn-group btn-block" role="group">
                                    <a role="button" class="btn btn-{{  $menu_item->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                    </a>
                                    <a href="{{route('admin-manage-menu-item', $menu_item->id)}}" role="button" class="editCategory btn btn-{{  $menu_item->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" >
                                        <div class="text float-left" >{{$menu_item->name}}</div>
                                        <div class="text small font-italic float-right" >R$ {{number_format($menu_item->price, 2, ',', '.')}}</div>
                                    </a>
                                    <a href="{{route('admin-change-visibility-menu-item', $menu_item->id)}}" role="button" class="btn btn-{{  $menu_item->visible === true ? "primary":"secondary" }} btn-lg">
                                        <span class="icon text-white-50">
                                           <i class="fas fa-power-off"></i>
                                        </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endforeach
        </div></div>
@endsection
@section('modals')
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando Categoria </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin-update-menu-category')}}">

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <input type="hidden" name="id" id="menuCategoryId">
                                <div id="menuCategoryPhoto"  style="padding-top: 0.25rem !important; cursor: pointer;" class="shadow-sm p-1 mb-9 bg-white rounded text-center">
                                    <i class="far fa-image fa-5x"></i>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label>Imagem de capa</label>
                                    <div class="custom-file">
                                        <input type="file" name="photo" id="customFileLang" class="custom-file-input menu-category-cover" lang="es">
                                        <label class="custom-file-label" for="customFileLang">Selecione uma imagem</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text"  name="name" id="menuCategoryName" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteCategoryModal" class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmação </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Tem certeza que deseja excluir esta categoria?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação excluirá todos os produtos e variações vinculados a esta categoria e não poderá ser desfeita.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                    <a href="" class="btn btn-danger" role="button">Excluir</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#menuCategoryPhoto').html("<img src='"+e.target.result+"' width='450' height='150' />");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".menu-category-cover").change(function() {
            readURL(this);
        });
        $('#customFileLang').on('change',function(){
            //get the file name
            var fileName = document.getElementById("customFileLang").files[0].name; ;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        });

        $('#menuCategoryPhoto').click(function(){
            $('#customFileLang').trigger('click');
        });
        $('table.db_item tbody').sortable({
            'containment': 'parent',
            'revert': true,
            helper: function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width());
                });
                return $helper;
            },
            'handle': '.handle',
            update: function(event, ui) {
                $.post('{{ route('menu-item-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_item tr').css('min-width', $('table.db_item').width());
        });

        $('table.db tbody').sortable({
            'containment': 'parent',
            'revert': true,
            helper: function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width());
                });
                return $helper;
            },
            'handle': '.handle',
            update: function(event, ui) {
                $.post('{{ route('menu-category-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db tr').css('min-width', $('table.db').width());
        });

        $(document).on("click", ".editCategory", function () {
            //Update Menu Category
            var name = $(this).data('name');
            var photo = $(this).data('photo');
            var id = $(this).data('id');
            $(".modal-body #menuCategoryId").val( id );
            $(".modal-body #menuCategoryName").val( name );
            $("#deleteCategoryModal .modal-footer a").attr( 'href', '{{route('admin-delete-menu-category')}}/'+id);
            if(photo){
                $(".modal-body #menuCategoryPhoto").html('<img width="90px" height="90px" src="'+photo+'" />')
            }else{
                $(".modal-body #menuCategoryPhoto").html('<i class="far fa-image fa-5x"></i>')
            }
        });
    </script>
@stop
