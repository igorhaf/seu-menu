@extends('layouts.admin')

@section('content')
<!-- ========Service-Details-Section Starts Here ========-->
<div class="get-service padding-bottom padding-top">
    <div class="container">
        <br />
        <h2>Dados do estabelecimento</h2>
        <br />
        <hr>
        <br />
        <small class="required">* Campos obrigatórios</small>
        <br /><br />
        <form method="POST" action="{{route('user-profile-update', $settings->id)}}" class="get-service-form">
            @csrf
            <div class="row">

                <div class="input-group col-12">
                    <label for="details">Endereço do menu <small class="required">*</small></label><br>

                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="slug"  value="{{$settings->schema_name}}"  id="exp" placeholder="Ex: dudu_lanches">
                    @if(config('tenant.mode') != 'standalone')
                    <div class="input-group-append">
                        <div class="input-group-text">.seumenu.shop</div>
                    </div>
                    @endif
                    @error('slug')
                    <span class="invalid-feedback" style="display: block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <br />
                    <label for="name">Nome do estabelecimento <small class="required">*</small></label>
                    <input class="pula form-control @error('name') is-invalid @enderror"  type="text" name="name"  value="{{ $settings->name }}" id="name" placeholder="Ex: Pastelaria do João">
                    @error('name')
                    <span class="invalid-feedback" style="display: block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-6">
                    <br />
                    <label for="phone">Telefone <small class="required">*</small></label>
                    <input class="pula form-control @error('phone') is-invalid @enderror"  type="text" name="phone"  value="{{ $settings->phone }}" id="phone_tenant" placeholder="Ex: (11) 9 8888-8888">
                    @error('phone')
                    <span class="invalid-feedback" style="display: block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="cep">CEP <small class="required">*</small><small id='mensagem'></small></label>
                    <input class="pula form-control @error('cep') is-invalid @enderror" type="text" name="cep" value="{{ $settings->cep }}" id="cep" placeholder="Ex: 52000-000">
                    @error('cep')
                    <span class="invalid-feedback" style="display: block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <label for="state">Estado <small class="required">*</small></label>
                    <select  class="pula form-control @error('state') is-invalid @enderror" name="state" id="state">
                        <option value="">Selecione</option>
                        <option {{($settings->state == 'AC')?'selected':''}} value="AC">Acre</option>
                        <option {{($settings->state == 'AL')?'selected':''}} value="AL">Alagoas</option>
                        <option {{($settings->state == 'AP')?'selected':''}} value="AP">Amapá</option>
                        <option {{($settings->state == 'AM')?'selected':''}} value="AM">Amazonas</option>
                        <option {{($settings->state == 'BA')?'selected':''}} value="BA">Bahia</option>
                        <option {{($settings->state == 'CE')?'selected':''}} value="CE">Ceará</option>
                        <option {{($settings->state == 'DF')?'selected':''}} value="DF">Distrito Federal</option>
                        <option {{($settings->state == 'ES')?'selected':''}} value="ES">Espírito Santo</option>
                        <option {{($settings->state == 'GO')?'selected':''}} value="GO">Goiás</option>
                        <option {{($settings->state == 'MA')?'selected':''}} value="MA">Maranhão</option>
                        <option {{($settings->state == 'MT')?'selected':''}} value="MT">Mato Grosso</option>
                        <option {{($settings->state == 'MS')?'selected':''}} value="MS">Mato Grosso do Sul</option>
                        <option {{($settings->state == 'MG')?'selected':''}} value="MG">Minas Gerais</option>
                        <option {{($settings->state == 'PA')?'selected':''}} value="PA">Pará</option>
                        <option {{($settings->state == 'PB')?'selected':''}} value="PB">Paraíba</option>
                        <option {{($settings->state == 'PR')?'selected':''}} value="PR">Paraná</option>
                        <option {{($settings->state == 'PE')?'selected':''}} value="PE">Pernambuco</option>
                        <option {{($settings->state == 'PI')?'selected':''}} value="PI">Piauí</option>
                        <option {{($settings->state == 'RJ')?'selected':''}} value="RJ">Rio de Janeiro</option>
                        <option {{($settings->state == 'RN')?'selected':''}} value="RN">Rio Grande do Norte</option>
                        <option {{($settings->state == 'RS')?'selected':''}} value="RS">Rio Grande do Sul</option>
                        <option {{($settings->state == 'RO')?'selected':''}} value="RO">Rondônia</option>
                        <option {{($settings->state == 'RR')?'selected':''}} value="RR">Roraima</option>
                        <option {{($settings->state == 'SC')?'selected':''}} value="SC">Santa Catarina</option>
                        <option {{($settings->state == 'SP')?'selected':''}} value="SP">São Paulo</option>
                        <option {{($settings->state == 'SE')?'selected':''}} value="SE">Sergipe</option>
                        <option {{($settings->state == 'TO')?'selected':''}} value="TO">Tocantins</option>
                        <option {{($settings->state == 'EX')?'selected':''}} value="EX">Estrangeiro</option>
                    </select>
                    @error('state')
                    <span class="invalid-feedback" style="display: block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-4">
                    <label for="city">Cidade <small class="required">*</small></label>
                    <input class="pula form-control @error('city') is-invalid @enderror" type="text" value="{{ $settings->city }}" name="city" id="city" placeholder="Ex: São Paulo">
                    @error('city')
                    <span class="invalid-feedback" style="display: block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="address">Endereço <small class="required">*</small></label>
                <input class="pula form-control @error('address') is-invalid @enderror" value="{{ $settings->address }}" type="text" name="address" id="address" placeholder="Rua... Av...">
                @error('address')
                <span class="invalid-feedback" style="display: block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="row">
                <div class="form-group col-4">
                    <label for="address_number">Número</label>
                    <input class="pula form-control" type="text" name="address_number" id="address_number" value="{{ $settings->address_number }}" placeholder="Ex: 540">
                </div>
                <div class="form-group col-4">
                    <label for="address_complement">Complemento</label>
                    <input class="pula form-control" type="text" name="address_complement" id="address_complement" value="{{ $settings->address_complement }}" placeholder="Ex: Bloco C">
                </div>
                <div class="form-group col-4">
                    <label for="district">Bairro <small class="required">*</small></label>
                    <input class="pula form-control @error('district') is-invalid @enderror" type="text"  value="{{ $settings->district }}" name="district" id="district" placeholder="Ex: Liberdade">
                    @error('district')
                    <span class="invalid-feedback" style="display: block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">

            </div>
            <div class="form-group">
                <input class="float-right btn btn-success" type="submit" value="Atualizar">
            </div>
        </form>
    </div>
</div>
<!-- ========Service-Details-Section Ends Here ========-->
    @endsection
