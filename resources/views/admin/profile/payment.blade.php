@extends('layouts.admin')

@section('content')
<!-- ========Service-Details-Section Starts Here ========-->

<div class="get-service padding-bottom padding-top">
    <div class="container">

        <br />
        <h2>Dados de pagamento</h2>
        <br />
        <hr>
        <br />
        <small class="required">* Campos obrigatórios</small>
        <br /><br />
        <div class="row">
            <form name="formPagamento" style="width: 100%" id="pagamento_finalizar" method="POST" action="{{route('do-payment')}}">
                @csrf
            <div class="col-md-12 mb-3 ">
                <label class="creditCard">Planos <small class="required">*</small></label>
                <select name="plans" class="custom-select d-block w-100">
                    <option value="">Selecione</option>
                    <option value="mensal">Plano Mensal - R$9.80</option>
                    <option value="semestral">Plano Semestral - R$54.90</option>
                    <option  value="anual">Plano Anual - R$99.90</option>
                </select>
            </div>
            <div class="col-md-12 order-md-1">
                <span id="msg"></span>
                <h4 class="mb-3">Dados do Comprador</h4>
                <span class="endereco" data-endereco=""></span>
                <span id="msg"></span>

                    <input type="hidden" name="payment_hash" id="pagseguro_token" value="">
                    <span id="msg"></span>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label>Nome <small class="required">*</small></label>
                            <input type="text" name="senderName" id="senderName" placeholder="Nome completo" value="" class="form-control" required>
                        </div>

                        <div class= "col-md-4 mb-3">
                            <label>CPF <small class="required">*</small></label>
                            <input type="text" name="senderCPF" id="senderCPF" placeholder="CPF sem traço" value="22111944785" class="form-control" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-2 mb-3">
                            <label>DDD <small class="required">*</small></label>
                            <input type="text" name="senderAreaCode" id="senderAreaCode" placeholder="DDD" value="11" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Telefone <small class="required">*</small></label>
                            <input type="text" name="senderPhone" id="senderPhone" placeholder="Somente número" value="56273440" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>E-mail <small class="required">*</small></label>
                            <input type="email" name="senderEmail" id="senderEmail" placeholder="E-mail do comprador" value="" class="form-control" required>
                        </div>
                    </div>
                    <br /><br />
                    <h4 class="mb-3">Escolha forma de pagamento <small class="required">*</small></h4>

                    <div class="custom-control custom-radio">
                        <input type="radio" checked="checked" name="paymentMethod" class="custom-control-input" id="creditCard" value="creditCard" onclick="tipoPagamento('creditCard')">
                        <label class="custom-control-label" for="creditCard">Cartão de Crédito</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" name="paymentMethod" class="custom-control-input" id="boleto" value="boleto" onclick="tipoPagamento('boleto')">
                        <label class="custom-control-label" for="boleto">Boleto</label>
                    </div>

                    <!-- Pagamento com cartão de crédito -->
                    <input type="hidden" name="bandeiraCartao" id="bandeiraCartao">
                    <input type="hidden" name="valorParcelas" id="valorParcelas">
                    <input type="hidden" name="tokenCartao" id="tokenCartao">
                    <input type="hidden" name="hashCartao" id="hashCartao">
                    <br />
                    <div class="row">
                        <div class="col-md-8 mb-3 creditCard">
                            <label class="creditCard">Numero do Cartão <small class="required">*</small></label>
                            <div class="input-group">
                                <input type="text"  name="numCartao" class="form-control" id="numCartao">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bandeira-cartao creditCard">   </span>
                                </div>
                            </div>
                            <small id="numCartao" class="form-text text-muted">
                                Preencha para ver o parcelamento
                            </small>
                        </div>
                        <div class="col-md-4 mb-3 creditCard">
                            <label class="creditCard">Quantidades de Parcelas <small class="required">*</small></label>
                            <select name="qntParcelas" id="qntParcelas" class="form-control select-qnt-parcelas creditCard">

                            </select>
                        </div>
                    </div>


                    <div class="row creditCard">
                        <div class="col-md-6 mb-3 creditCard">
                            <label class="creditCard">Nome do titular <small class="required">*</small></label>
                            <input type="text" name="creditCardHolderName" class="form-control" id="creditCardHolderName" placeholder="Nome igual ao escrito no cartão" value="">
                            <small id="creditCardHolderName" class="form-text text-muted">
                                Como está gravado no cartão
                            </small>
                        </div>
                        <div class="col-md-3 mb-3 creditCard">
                            <label class="creditCard">CPF do titular do cartão <small class="required">*</small></label>
                            <input type="text" name="creditCardHolderCPF" id="creditCardHolderCPF" placeholder="CPF sem traço" value="22111944785" class="form-control creditCard">
                        </div>
                        <div class="col-md-3 mb-3 creditCard">
                            <label class="creditCard">Data de nascimento <small class="required">*</small></label>
                            <input type="text" name="creditCardHolderBirthDate" id="creditCardHolderBirthDate" placeholder="Data de Nascimento. Ex: 12/12/1912" value="27/10/1987" class="form-control creditCard">
                        </div>
                    </div>
                    <div class="row creditCard">
                        <div class="col-md-4 mb-3 creditCard">
                            <label class="creditCard">Mês de Validade <small class="required">*</small></label>
                            <input type="text" name="mesValidade" id="mesValidade" maxlength="2" value="12"  class="form-control creditCard">
                        </div>
                        <div class="col-md-4 mb-3 creditCard">
                            <label class="creditCard">Ano de Validade <small class="required">*</small></label>
                            <input type="text" name="anoValidade" id="anoValidade" maxlength="4" value="2030" class="form-control creditCard">
                        </div>
                        <div class="col-md-4 mb-3 creditCard">
                            <label class="creditCard">CVV do cartão <small class="required">*</small></label>
                            <input type="text" name="numCartao" class="form-control creditCard" id="cvvCartao" maxlength="3" value="123">
                            <small id="cvvCartao" class="form-text text-muted creditCard">
                                Código de 3 digitos impresso no verso do cartão
                            </small>
                        </div>
                    </div>

                    <br /><br />
                    <h4 class="mb-3 creditCard">Endereço do titular do cartão</h4>
                    <div class="row creditCard">
                        <div class="col-md-2 mb-3">
                            <label class="creditCard">CEP <small class="required">*</small></label>
                            <input type="text" name="billingAddressPostalCode" class="form-control creditCard" id="billingAddressPostalCode" placeholder="CEP sem traço" value="">
                        </div>
                        <div class="col-md-6 mb-3 creditCard">
                            <label class="creditCard">Logradouro <small class="required">*</small></label>
                            <input type="text" name="billingAddressStreet" id="billingAddressStreet" placeholder="Av. Rua" value="" class="creditCard form-control">
                        </div>
                        <div class="col-md-2 mb-3 creditCard">
                            <label class="creditCard">Número</label>
                            <input type="text" name="billingAddressNumber" id="billingAddressNumber" placeholder="Número" value="" class="creditCard form-control">
                        </div>
                        <div class="col-md-2 mb-3 creditCard">
                            <label class="creditCard">Complemento</label>
                            <input type="text" name="billingAddressComplement" id="billingAddressComplement" placeholder="Complemento" value="" class="creditCard form-control">
                        </div>
                    </div>

                    <div class="row creditCard">
                        <div class="col-md-5 mb-3 creditCard">
                            <label class="creditCard">Bairro <small class="required">*</small></label>
                            <input type="text" name="billingAddressDistrict" id="billingAddressDistrict" placeholder="Bairro" value="" class="creditCard form-control">
                        </div>
                        <div class="col-md-5 mb-3 creditCard">
                            <label class="creditCard">Cidade <small class="required">*</small></label>
                            <input type="text" name="billingAddressCity" id="billingAddressCity" placeholder="Cidade" value="" class="creditCard form-control">
                        </div>
                        <div class="col-md-2 mb-3 creditCard">
                            <label class="creditCard">Estado <small class="required">*</small></label>
                            <select name="billingAddressState" class="custom-select d-block w-100 creditCard" id="billingAddressState">
                                <option value="">Selecione</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AP">AP</option>
                                <option value="AM">AM</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MT">MT</option>
                                <option value="MS">MS</option>
                                <option value="MG">MG</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PR">PR</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RS">RS</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="SC">SC</option>
                                <option value="SP">SP</option>
                                <option value="SE">SE</option>
                                <option value="TO">TO</option>
                            </select>
                        </div>
                    </div>
                    <br />
                    <input type="hidden" name="hashCartao" id="hashCartao">

                    <input type="submit" name="btnComprar" id="btnComprar" class="btn btn-success float-right" value="Contratar Plano">

                </div>
            </form>
        </div>
    </div>
</div>
<!-- ========Service-Details-Section Ends Here ========-->
    @endsection
