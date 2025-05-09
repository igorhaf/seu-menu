@extends('layouts.admin')

@section('content')
    <p class="help-block">Clique no nome para editar uma variação ou adicional. Arraste com o <i class="fas fa-arrows-alt"></i> para reordenar, ou use o <i class="fas fa-power-off"></i> para ativar ou desativar.</p>

    <div class="row">

        <div class="col-lg-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Gerenciar item</h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Editar informações do produto</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" enctype="multipart/form-data" action="{{route('admin-update-menu-item', $item->id)}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <div id="menuItemPhoto" style="cursor: pointer" class="shadow-sm p-1 mb-9 bg-white rounded text-center">
                                                @if($item->photo != null)
                                                    <img style="max-height: 6rem; max-width: 6rem;" src="{{$item->photo}}" />
                                                @else
                                                    <i class="far fa-image fa-5x"></i>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label>Nome</label>
                                                        <input name="name" value="{{$item->name}}" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label>Valor </label>
                                                    <div class="input-group">

                                                        <div class="input-group-prepend">
                                                            <span  class="btn btn-secondary btn-user">
                                                                R$
                                                            </span>
                                                        </div>
                                                        <input id="menu_price_manager" type="text" value="{{number_format($item->price, 2, ',', '.')}}" name="price" placeholder="0,00" class="form-control">

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-9">
                                    <br>
                                    <div class="form-group">
                                        <label>Imagem do produto</label>
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input menu-item-photo" id="customFileLang" lang="es">
                                            <label class="custom-file-label" for="customFileLang">
                                                @if($item->photo != null)
                                                    {{basename($item->photo)}}
                                                @else
                                                    Nenhuma imagem
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <br>
                                    <div class="form-group">
                                        <label>Visibilidade</label>
                                        <input type="checkbox" name="visibility" {{($item->visible==true?'checked':'')}} data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-onstyle="success" data-offstyle="danger">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Descrição</label>
                                        <textarea name="description" class="form-control" rows="2">{{$item->description}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Observações</label>
                                        <textarea class="form-control" name="observations" rows="2">{{$item->observations}}</textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Categoria</label>
                                        <select name="menu_category_id" class="form-control">
                                            @foreach($categories as $key => $category)
                                                <option value="{{$key}}" {{($key==$item->menu_category_id)?'selected':''}} >{{$category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12  form-group">
                                    <button type="button" data-toggle="modal" data-target="#deleteItemModal"  class="btn btn-danger mr-auto">Excluir</button>
                                    <button type="submit" style="float: right" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-lg-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><br></h1>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Variação</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-item-variable-store')}}">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{$item->id}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                            <input type="text" name="variable" placeholder="Título da variação" class="form-control" required>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_item_variable col-12">
                            <tbody>
                            @foreach($variables as $variable)
                                <tr  id="item_{{$variable->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $variable->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button"  data-id="{{$variable->id}}" data-variable="{{$variable->variable}}"  class="editVariable btn btn-{{  $variable->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff"  style="text-align: left" data-toggle="modal" data-target="#editVariableModal">
                                                <div class="text float-left" >{{$variable->variable}}</div>
                                            </a>
                                            <a href="{{route('admin-item-variable-change-visibility', $variable->id)}}" role="button" class="btn btn-{{  $variable->visible === true ? "primary":"secondary" }} btn-lg">
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-5">
                            <h6 style="padding-top: 10px;" class="m-0 font-weight-bold text-primary">Combo</h6>
                        </div>
                        <div class="col-7">
                            <form role="form" method="post" action="{{route('admin-change-combo-limit-menu-item', $item->id)}}">
                                @csrf
                                <div class="row">
                                    <div class="col-8">
                                        <div class="input-group">
                                            <input id="comboLimit" value="{{$item->combo_limit}}" type="number" min="0" name="combo_limit" placeholder="Limite" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="input-group">
                                            <button type="submit" class="btn btn-primary btn-user">
                                                Salvar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-combo-store')}}">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{$item->id}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <small>Adicione opções ao combo.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group">
                                               <select name="combo_menu_item_id" class="form-control">
                                                    @foreach($itens as $key => $menu_itens)
                                                        <option value="{{$menu_itens->id}}">{{$menu_itens->name}}</option>
                                                    @endforeach
                                                </select>

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary btn-user">
                                                    Adicionar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_item_variable col-12">
                            <tbody>
                            @foreach($combo_itens as $combo_item)
                                <tr  id="item_{{$combo_item->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $combo_item->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button"  data-min="{{$combo_item->min}}" data-max="{{$combo_item->max}}"   data-name="{{$combo_item->menu_item->name}}"  data-id="{{$combo_item->id}}" class="editComboItem btn btn-{{  $combo_item->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff; text-align: left" data-toggle="modal" data-target="#editComboItemModal">
                                                <div class="text float-left" >{{$combo_item->menu_item->name}}</div>
                                            </a>
                                            <a href="{{route('admin-combo-change-visibility', $combo_item->id)}}" role="button" class="btn btn-{{  $combo_item->visible === true ? "primary":"secondary" }} btn-lg">
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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Opcionais</h6>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form role="form" method="post" action="{{route('admin-item-additional-store')}}">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{$item->id}}">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <input type="text" name="name" placeholder="Nome do opcional" class="form-control" required>
                                    </div>
                                    <br><br>
                                    <div class="col-6">
                                        <div class="input-group">

                                            <div class="input-group-prepend">
                                                <span  class="btn btn-user" id="increase_decrease_signal_additional">
                                                    + R$
                                                </span>
                                            </div>
                                            <input type="text" id="increase_decrease_value_additional" name="increase_decrease_value" placeholder="0,00" class="form-control">

                                        </div>
                                    </div>
                                    <div class="col-3" style="padding-left: 0rem!important;">
                                        <input type="checkbox" id="increase_decrease_additional" name="increase_decrease"  data-toggle="toggle" data-on="Acrescimo" data-off="Decrescimo" data-onstyle="success" data-offstyle="danger" checked>
                                    </div>
                                    <div class="col-3">
                                        <button type="submit" class="btn btn-primary btn-user">
                                            Adicionar
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <table class="db_item_additional col-12">
                            <tbody>
                            @foreach($additionals as $additional)
                                <tr  id="item_{{$additional->id}}">
                                    <td>
                                        <div class="btn-group btn-block" role="group">
                                            <a role="button" class="btn btn-{{  $additional->visible === true ? "primary":"secondary" }} btn-lg">
                                         <span class="icon text-white-50 handle">
                                           <i class="fas fa-arrows-alt"></i>
                                        </span>
                                            </a>
                                            <a role="button" data-toggle="modal" data-target="#editAdditionalModal" data-id="{{$additional->id}}" data-name="{{$additional->name}}" data-increase_value="{{number_format($additional->increase_value, 2, ',', '.')}}" data-decrease_value="{{number_format($additional->decrease_value, 2, ',', '.')}}"  class="editAdditional btn btn-{{  $additional->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff; text-align: left">
                                                <div class="text float-left" >{{$additional->name}}</div>
                                                <div class="text small font-italic float-right" >{{(!empty($additional->decrease_value))?($additional->decrease_value > 0)?'-':'':''}}{{(!empty($additional->increase_value))?($additional->increase_value > 0)?'+':'':''}}R$ {{number_format(($additional->increase_value == null)?$additional->decrease_value:$additional->increase_value, 2, ',', '.')}}</div>
                                            </a>
                                            <a href="{{route('admin-item-additional-change-visibility', $additional->id)}}" role="button" class="btn btn-{{  $additional->visible === true ? "primary":"secondary" }} btn-lg">
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
        <div class="col-lg-4">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800"><br></h1>
            </div>
            @foreach($variables as $variable)
                <div class="col-lg-12">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Opções da variação {{$variable->variable}}</h6>
                        </div>
                        <div class="card-body">
                            <form role="form" method="post" action="{{route('admin-variable-option-store')}}">
                                @csrf
                                <input type="hidden" name="menu_item_id" value="{{$item->id}}">
                                <input type="hidden" name="item_variable_id" value="{{$variable->id}}">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" name="option" placeholder="Nome da opção" class="form-control"  required>
                                        </div>
                                        <br><br>
                                        <div class="col-6">
                                            <div class="input-group">

                                                <div class="input-group-prepend">
                                                <span  class="btn btn-success btn-user" id="increase_decrease_signal_variable_option">
                                                    + R$
                                                </span>
                                                </div>
                                                <input type="text"  name="increase_decrease_value" placeholder="0,00" class="increase_decrease_value_variable form-control">

                                            </div>
                                        </div>
                                        <div class="col-3" style="padding-left: 0rem!important;">
                                            <input type="checkbox" id="increase_decrease_variable_option" name="increase_decrease"  data-toggle="toggle" data-on="Acrescimo" data-off="Decrescimo" data-onstyle="success" data-offstyle="danger" checked>
                                        </div>
                                        <div class="col-3">
                                            <button type="submit" class="btn btn-primary btn-user">
                                                Adicionar
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <table class="db_variable_option col-12">
                                <tbody>
                                @foreach($variable->variable_options as $variable_option)
                                    <tr  id="item_{{$variable_option->id}}">
                                        <td>
                                            <div class="btn-group btn-block" role="group">
                                                <a role="button" class="btn btn-{{  $variable_option->visible === true ? "primary":"secondary" }} btn-lg">
                                                 <span class="icon text-white-50 handle">
                                                   <i class="fas fa-arrows-alt"></i>
                                                </span>
                                                </a>
                                                <a href="{{route('admin-manage-menu-item', $variable_option->id)}}" role="button" class="editVariableOption btn btn-{{  $variable_option->visible === true ? "primary":"secondary" }} btn-lg btn-block" style="color: #fff; text-align: left"  data-target="#editVariableOptionModal" data-id="{{$variable_option->id}}" data-name="{{$variable_option->option}}" data-toggle="modal"  data-increase_value="{{number_format($variable_option->increase_value, 2, ',', '.')}}" data-decrease_value="{{number_format($variable_option->decrease_value, 2, ',', '.')}}">
                                                    <div class="text float-left" >{{$variable_option->option}}</div>
                                                    <div class="text small font-italic float-right" >{{(!empty($variable_option->decrease_value))?($variable_option->decrease_value > 0)?'-':'':''}}{{(!empty($variable_option->increase_value))?($variable_option->increase_value > 0)?'+':'':''}}R$ {{number_format(($variable_option->increase_value == null)?$variable_option->decrease_value:$variable_option->increase_value, 2, ',', '.')}}</div>
                                                </a>
                                                <a href="{{route('admin-variable-option-change-visibility', $variable_option->id)}}" role="button" class="btn btn-{{  $variable_option->visible === true ? "primary":"secondary" }} btn-lg">
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
        </div>
    </div>
@endsection
@section('modals')
    <div class="modal fade" id="editVariableModal" tabindex="-1" role="dialog" aria-labelledby="editVariableModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando variação </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-update-item-variable')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                @csrf
                                <input type="hidden" name="id" id="variableId">
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" name="variable" id="variableVariable" placeholder="Título da variação" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteItemVariableModal"  class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAdditionalModal" tabindex="-1" role="dialog" aria-labelledby="editAdditionalModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando Adicional </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-item-additional-update')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="additionalId">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" id="additionalName" name="name" placeholder="Nome do opcional" class="form-control"  required>
                            </div>
                            <br><br>
                            <div class="col-9">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                                <span  class="btn btn-user" id="additionalIncreaseSignal">
                                                    +
                                                </span>
                                    </div>
                                    <input type="text" id="additionalIncreaseDecreaseValue" name="increase_decrease_value" placeholder="0,00" class="form-control">

                                </div>
                            </div>
                            <div class="col-3" style="padding-left: 0rem!important;">
                                <input type="checkbox" id="additionalIncreaseDecrease" name="increase_decrease"  data-toggle="toggle" data-on="Acrescimo" data-off="Decrescimo" data-onstyle="success" data-offstyle="danger" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteItemAdditionalModal"  class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editComboItemModal" tabindex="-1" role="dialog" aria-labelledby="editComboItemModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando opção de combo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-combo-update')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="comboItemId">
                        <div class="row">
                            <div class="col-12">
                                <input  type="text" id="comboItemName" name="comboItemName" class="form-control" disabled>
                            </div>
                            <br><br>
                            <div class="col-6">
                                <p>Mínimo</p>
                            </div>
                            <div class="col-6">
                                <p>Máximo</p>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="number" id="comboItemMin" name="combo_item_min" placeholder="0" class="form-control">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="number" id="comboItemMax" name="combo_item_max" placeholder="0" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteComboItemModal"  class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editVariableOptionModal" tabindex="-1" role="dialog" aria-labelledby="editVariableOptionModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editando opção da variação</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form role="form" method="post" action="{{route('admin-update-variable-option')}}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="variableOptionId">
                        <div class="row">
                            <div class="col-12">
                                <input type="text" id="variableOptionName" name="option" placeholder="Nome do opcional" class="form-control" required>
                            </div>
                            <br><br>
                            <div class="col-9">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                                <span  class="btn btn-user" id="variableOptionIncreaseSignal">
                                                    +
                                                </span>
                                    </div>
                                    <input type="text" id="variableOptionIncreaseDecreaseValue" name="increase_decrease_value" placeholder="0,00" class="form-control">

                                </div>
                            </div>
                            <div class="col-3" style="padding-left: 0rem!important;">
                                <input type="checkbox" id="variableOptionIncreaseDecrease" name="increase_decrease"  data-toggle="toggle" data-on="Acrescimo" data-off="Decrescimo" data-onstyle="success" data-offstyle="danger" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" data-toggle="modal" data-target="#deleteItemVariableOptionModal"  class="btn btn-danger mr-auto" type="button">Excluir</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir este item?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação excluirá este produtos e todas variações e adicionais vinculados a ele e não poderá ser desfeita.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary mr-auto" type="button" data-dismiss="modal">Cancelar</button>
                    <a href="{{route('admin-delete-menu-item', $item->id)}}" class="btn btn-danger" role="button">Excluir</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteItemVariableModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir esta variação?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação não poderá ser desfeita.</p>
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

    <div class="modal fade" id="deleteItemVariableOptionModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir esta opção de variação?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação não poderá ser desfeita.</p>
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

    <div class="modal fade" id="deleteItemAdditionalModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModal" aria-hidden="true">
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
                            <p>Tem certeza que deseja excluir este adicional?</p>
                            <p class="alert-danger"><i class="fas fa-exclamation-triangle"></i> Esta ação não poderá ser desfeita.</p>
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
        $('#customFileLang').on('change',function(){
            //get the file name
            var fileName = document.getElementById("customFileLang").files[0].name; ;
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })
        $(function() {
            $("#increase_decrease_value").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $(".increase_decrease_value_variable").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#menu_price").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
            $("#menu_price_manager").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
        })
        $('table.db_variable_option tbody').sortable({
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
                $.post('{{ route('admin-variable-option-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_variable_option tr').css('min-width', $('table.db_variable_option').width());
        });

        $('table.db_item_variable tbody').sortable({
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
                $.post('{{ route('admin-item-variable-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_item_variable tr').css('min-width', $('table.db_item_variable').width());
        });

        $('table.db_item_additional tbody').sortable({
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
                $.post('{{ route('admin-item-additional-reposition') }}', $(this).sortable('serialize'), function(data) {
                    if(!data.success) {
                        alert('Whoops, something went wrong :/');
                    }
                }, 'json');
            }
        });
        $(window).resize(function() {
            $('table.db_item_additional tr').css('min-width', $('table.db_item_additional').width());
        });

        $(document).on("click", ".editAdditional", function () {
            //Update Delivery points
            var id = $(this).data('id');
            var name = $(this).data('name');
            var increase_decrease_value;

            if($(this).data('increase_value') !== "0,00"){
                increase_decrease_value = $(this).data('increase_value');
                $('#additionalIncreaseSignal').html('+ R$').addClass('btn-success');
                $('#additionalIncreaseDecrease').bootstrapToggle("on");
            }
            if($(this).data('decrease_value') !== "0,00"){
                increase_decrease_value = $(this).data('decrease_value');
                $('#additionalIncreaseSignal').html('- R$').addClass('btn-danger');
                $('#additionalIncreaseDecrease').bootstrapToggle("off");
            }
            if($(this).data('decrease_value') === "0,00" && $(this).data('increase_value') === "0,00"){
                $('#additionalIncreaseSignal').html('+ R$').addClass('btn-success');
                $('#additionalIncreaseDecrease').bootstrapToggle("on");
            }
            $(".modal-body #additionalIncreaseDecreaseValue").val(increase_decrease_value);
            $("#deleteItemAdditionalModal .modal-footer a").attr( 'href', '{{route('admin-delete-item-additional')}}/'+id);
            console.log(id);
            $(".modal-body #additionalId").val( id );
            $(".modal-body #additionalName").val( name );
        });

        $(document).on("click", ".editVariable", function () {
            console.log('test')
            //Update Delivery points
            var id = $(this).data('id');
            var variable = $(this).data('variable');
            $("#deleteItemVariableModal .modal-footer a").attr( 'href', '{{route('admin-delete-item-variable')}}/'+id);
            $(".modal-body #variableId").val( id );
            $(".modal-body #variableVariable").val( variable );
        });

        $('#variableOptionIncreaseDecrease').on('change',function(e){
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('#variableOptionIncreaseSignal').html('+ R$').addClass('btn-success').removeClass('btn-danger')
            }else{
                $('#variableOptionIncreaseSignal').html('- R$').addClass('btn-danger').removeClass('btn-success')
            }
        })

        $('#additionalIncreaseDecrease').on('change',function(e){
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('#additionalIncreaseSignal').html('+ R$').addClass('btn-success').removeClass('btn-danger')
            }else{
                $('#additionalIncreaseSignal').html('- R$').addClass('btn-danger').removeClass('btn-success')
            }
        })

        $('#increase_decrease_additional').on('change',function(e){
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('#increase_decrease_signal_additional').html('+ R$').addClass('btn-success').removeClass('btn-danger')
            }else{
                $('#increase_decrease_signal_additional').html('- R$').addClass('btn-danger').removeClass('btn-success')
            }
        });
        $('#increase_decrease_variable_option').on('change',function(e){
            e.preventDefault();
            if($(this).prop("checked") == true){
                $('#increase_decrease_signal_variable_option').html('+ R$').addClass('btn-success').removeClass('btn-danger')
            }else{
                $('#increase_decrease_signal_variable_option').html('- R$').addClass('btn-danger').removeClass('btn-success')
            }
        })
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#menuItemPhoto').html("<img src='"+e.target.result+"' width='100' height='100' />");
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".menu-item-photo").change(function() {
            readURL(this);
        });
        $('#menuItemPhoto').click(function(){ $('#customFileLang').trigger('click'); });

        $(document).on("click", ".editVariableOption", function () {
            //Update Delivery points
            var id = $(this).data('id');
            var name = $(this).data('name');
            var increase_decrease_value;
            if($(this).data('increase_value') !== "0,00"){
                increase_decrease_value = $(this).data('increase_value');
                $('#variableOptionIncreaseSignal').html('+ R$').addClass('btn-success');
                $('#variableOptionIncreaseDecrease').bootstrapToggle("on");
            }
            if($(this).data('decrease_value') !== "0,00"){
                increase_decrease_value = $(this).data('decrease_value');
                $('#variableOptionIncreaseSignal').html('- R$').addClass('btn-danger');
                $('#variableOptionIncreaseDecrease').bootstrapToggle("off");
            }
            if($(this).data('decrease_value') === "0,00" && $(this).data('increase_value') === "0,00"){
                $('#variableOptionIncreaseSignal').html('+ R$').addClass('btn-success');
                $('#variableOptionIncreaseDecrease').bootstrapToggle("on");
            }
            $(".modal-body #variableOptionIncreaseDecreaseValue").val(increase_decrease_value);
            $("#deleteItemVariableOptionModal .modal-footer a").attr( 'href', '{{route('admin-delete-item-variable-option')}}/'+id);
            $(".modal-body #variableOptionId").val( id );
            $(".modal-body #variableOptionName").val( name );
        });

        $(document).on("click", ".editComboItem", function () {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var min_value= $(this).data('min');
            var max_value= $(this).data('max');
            $("#deleteComboItemModal .modal-footer a").attr( 'href', '{{route('admin-delete-combo')}}/'+id);
            $(".modal-body #comboItemId").val( id );
            $(".modal-body #comboItemName").val( name );
            $(".modal-body #comboItemMin").val( min_value );
            $(".modal-body #comboItemMax").val( max_value );

        });

        $( document ).ready(function() {
            $('#increase_decrease_signal_additional').html('+ R$').addClass('btn-success')
            $('#increase_decrease_signal_variable_option').html('+ R$').addClass('btn-success')
            $('#comboLimit').inputSpinner()
            $('#comboItemMin').inputSpinner()
            $('#comboItemMax').inputSpinner()
        });
    </script>
@stop
