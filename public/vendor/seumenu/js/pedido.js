// currency formatting
function toBRL(value) {
  return currency(parseFloat(value), { symbol: 'R$ ', decimal: ',', separator: '.' }).format(true)
}

function showPopupMessage(title, msg, callback) {
  $.confirm({
    icon: 'fas fa-exclamation-circle',
    title: title,
    content: msg,
    buttons: {
      ok: {
        btnClass: 'btn-red',
        text: 'Ok',
        action: function () {
          if (callback) {
            callback()
            return
          }
        }
      }
    }
  })
}

function calculateTotal() {
  let totalProducts = 0

  for (let key in localStorage) {
    if (key.startsWith('prod_')) {
      let item = JSON.parse(localStorage.getItem(key))
      totalProducts += (item.price * item.qtt)
    }
  }

  let total = totalProducts
  let deliveryOption = $('a#entrega').hasClass('ativo') ? 'entrega' : 'retirada'

  $('#pedido-subtotal-valor').html(toBRL(totalProducts))

  if (deliveryOption == 'retirada') {
    $('#pedido-taxa-entrega').fadeOut(50)
    $('#pedido-subtotal').fadeOut(50)
    $('#pedido-total').fadeIn(50)
    $('#retirada').fadeIn(50)
  } else {
    $('#pedido-taxa-entrega').fadeIn(50)
    $('#pedido-subtotal').fadeIn(50)

    if (fixedDeliveryFee === null) {
      $('#pedido-total').fadeOut(50)
      $('#pedido-taxa-entrega-valor').html('Consulte')
    } else if (fixedDeliveryFee === 0) {
      $('#pedido-taxa-entrega-valor').html('Grátis')
    } else if (fixedDeliveryFee > 0) {
      total += fixedDeliveryFee
      $('#pedido-taxa-entrega-valor').html(toBRL(fixedDeliveryFee))
    }
  }

  $('#pedido-total-valor').html(toBRL(total))

  return total
}

function prepareOrderSummary() {
  // clean previous table items
  let tbl = $('#tbl-confirmacao-pedido > tbody')
  tbl.find('tr').remove()

  for (let key in localStorage) {
    if (key.startsWith('prod_')) {
      let item = JSON.parse(localStorage.getItem(key))

      let tr = $('<tr>')
      tr.append($('<td>').html(item.sku))
      tr.append($('<td>').html(item.name))
      tr.append($('<td>', { 'width': '20%', 'class': 'text-center' }).html(toBRL(item.price)))
      tr.append($('<td>', { 'class': 'text-center' }).html(item.qtt))
      tbl.append(tr)
    }
  }

  calculateTotal()
}

function postOrder() {
  let change = 0
  let paymentMethod = null

  let deliveryOption = $('a#entrega').hasClass('ativo') ? 'entrega' : 'retirada'

  if (phoneIsRequired && $('#phone').val().trim().length != 15) {
    showPopupMessage('Telefone obrigatório', 'Por favor, digite o número do seu telefone celular para prosseguir.', function () { $('#phone').focus() })
    return
  }

  if (nameIsRequired && $('#name').val().trim() == '') {
    showPopupMessage('Nome obrigatório', 'Por favor, preencha o campo com seu nome completo.', function () { $('#name').focus() })
    return
  }

  if ((addressIsRequired) && (deliveryOption == 'entrega')) {
    if ($('#address').val().trim() == '') {
      showPopupMessage('Endereço obrigatório', 'Por favor, digite o endereço para entrega.', function () { $('#zip_code').focus() })
      return
    }
    if ($('#number').val().trim() == '') {
      showPopupMessage('Número obrigatório', 'Por favor, digite o numero do local para entrega.', function () { $('#number').focus() })
      return
    }
    /* Zip code isn't mandatory anymore.
     * if ($('#zip_code').val().trim() == '') {
      showPopupMessage('CEP obrigatório', 'Por favor, digite o CEP do local da entrega.', function() { $('#zip_code').focus() })
      return
    } */
    if ($('#additional2').val().trim() == '') {
      showPopupMessage('Bairro obrigatório', 'Por favor, digite o Bairro para entrega.', function () { $('#additional2').focus() })
      return
    }
  }

  if (deliveryOption == 'entrega') {
    if (!$('#dinheiro').is(':checked') && !$('#maquininha').is(':checked') && !$('#aplicativo').is(':checked') ) {
      showPopupMessage('Forma de pagamento', 'Por favor, selecione qual a forma de pagamento desejada', function () { $('#dinheiro').focus() })
      return
    }

    if ($('#dinheiro').is(':checked')) {
      let changeField = $('input[name="change"]')
      let noChange = $('input[name="no-change"]')

      if (!noChange.is(':checked')) {
        if (changeField.val().trim() == '') {
          showPopupMessage('Troco não informado', 'Por favor, informe troco para quanto precisa. Se não precisar, marque o select "Sem Troco".', function () { changeField.focus() })
          return
        } else {
          change = parseFloat(changeField.val().replace(',', '.'))

          if (change < calculateTotal()) {
            showPopupMessage('Troco inválido', 'O valor do troco não pode ser menor que o valor do pedido. Por favor, informe o valor correto.', function () { $('input[name="change"]').focus() })
            return
          }
        }
      }
    } else if ($('#maquininha').is(':checked')) {
      if ($('#selecaoBandeiraMaq').val() == '') {
        showPopupMessage('Bandeira não informada', 'Por favor, informe a bandeira do cartão que deseja utilizar na maquininha.', function () { $('#selecaoBandeira').focus() })
        return
      }
    } else if ($('#aplicativo').is(':checked')) {
        if ($('#selecaoBandeiraApp').val() == '') {
            showPopupMessage('Bandeira não informada', 'Por favor, informe a bandeira do cartão que deseja utilizar na maquininha.', function () { $('#selecaoBandeira').focus() })
            return
        }
    }

    $(this).attr('disabled', 'disabled')

    if ($('#dinheiro').is(':checked')) {
      paymentMethod = $('#dinheiro').data('uuid')
    } else {
      paymentMethod = $('#selecaoBandeira').val()
    }
  }

  let order = {
    'name': $('#name').val(),
    'address': $('#address').val(),
    'number': $('#number').val(),
    'city': $('#city').val(),
    'zip_code': $('#zip_code').val(),
    'additional1': $('#additional1').val(),  // complemento
    'additional2': $('#additional2').val(),  // bairro
    'additional3': $('#additional3').val(),  // ponto de referência
    'city': $('#city').val(),
    'state': $('#state').val(),
    'phone': $('#phone').val(),
    'notes': $('#obsConfirmacao').val(),
    'payment_method': paymentMethod,
    'delivery_option': deliveryOption,
    'change': change,
  }

  $.ajax({
    type: 'POST',
    async: false,
    dataType: 'json',
    url: urlOrder,
    cache: false,
    data: {
      csrfmiddlewaretoken: csrfToken,
      order: JSON.stringify(order)
    },
    success: function (data) {
      /*
       * Uma opção aqui é detectar o tipo de device - se for computador, podemos
       * simplesmente continuar com o mesmo comportamento.
       * Mas se for um mobile, alteramos a div toda, mostrando os dados finais do
       * pedido (página 3) e direcionamos para a api do whatsapp. O comportamento
       * provavelmente será limpo ao ponto de não fechar a página do cliente no
       * e estará atualizado com os dados do pedido.
       * */
      if (data.error == 0) {
        localStorage.clear()
        let msg = encodeURIComponent(data.whatsapp_message)
        let whatsappNumber = $('#whatsapp-phone').val()
        var md = new MobileDetect(window.navigator.userAgent)

        if (md.mobile()) {
          $('#confirmacao-pedido').hide()
          $('#pedido-concluido').show()
          $('#voltar-cardapio').hide()
          window.location.href = 'https://api.whatsapp.com/send?phone=550' + whatsappNumber + '&text=' + msg
        } else {
          window.open('https://api.whatsapp.com/send?phone=550' + whatsappNumber + '&text=' + msg, '_blank')
          window.location.href = data.order_url
        }
      } else {
        showPopupMessage('Pedido não enviado.', data.message)
      }
    },
    error: function (error) {
      $(this).removeAttr('disabled')
      showPopupMessage('Oops! Erro encontrado', error.message)
    }
  })
}

$(document).ready(function () {
  /* Delivery address fields */
  $('input.price').mask('C00,00',
    {
      reverse: true,
      placeholder: '0,00',
      translation: {
        'C': {
          pattern: /[0-9]/, optional: true
        }
      }
    })

  $(document).on('blur', 'input[name="zip_code"]', function () {
    let address = $('#address')
    let additional1 = $('#additional1')
    let additional2 = $('#additional2')
    let city = $('#city')
    let state = $('#state')
    address.val('...')
    additional1.val('')
    additional2.val('...')
    city.val('')
    state.val('')

    let zipCode = $(this).val().match(/[0-9]+/g).join('')

    if (zipCode.length != 8) return

    $.get('/zc-lookup/' + zipCode + '/', function (data) {
      if (data.error == 0 && data.cep) {
        let cep = data.cep
        address.val(cep.logradouro)
        additional2.val(cep.bairro)
        city.val(cep.localidade)
        state.val(cep.uf)
      } else {
        address.val('')
        additional1.val('')
        additional2.val('')
        city.val('')
        state.val('')
      }
    })
  })

  $(document).on('blur', 'input[name="number"]', function () {
    if ($('input[name="additional1"]').val() == '') {
      $('.alerta-complemento').fadeIn(50)
    }
  })

  /* Delivery options */
  $(document).on('click', '.infoEntregaConfirmacao .seleciona a', function (event) {
    event.preventDefault()

    $('.infoEntregaConfirmacao .seleciona a').removeClass('ativo')
    $(this).addClass('ativo')

    clique = $(this).attr('data-open')

    if (clique == 'entrega') {
      $('.infoEntregaConfirmacao .formEntrega').fadeOut(50)
      $('.infoEntregaConfirmacao #entrega').fadeIn(50)
      $('.pagamentoConfirmacao').fadeIn(50)
    }

    if (clique == 'retirada') {
      $('.infoEntregaConfirmacao .formEntrega').fadeOut(50)
      $('.infoEntregaConfirmacao #retirada').fadeIn(50)
      $('.pagamentoConfirmacao').fadeOut(50)
    }

    if (clique == 'login') {
      $('.infoEntregaConfirmacao .formEntrega').fadeOut(50)
      $('.infoEntregaConfirmacao #login').fadeIn(50)
    }

    calculateTotal()
  })

  $(document).on('change', 'input[name="no-change"]', function () {
    if ($(this).is(':checked')) {
      $('input[name="change"]').attr('disabled', 'disabled').val('')

    } else {
      $('input[name="change"]').removeAttr('disabled')
    }
  })

  /* Payment options */
  $('.pagamentoConfirmacao input[type="radio"]').on('click', function () {
    let troco = $('.pagamentoConfirmacao .troco')
    let bandeirasMaq = $('.pagamentoConfirmacao .bandeirasMaq')
    let bandeirasApp = $('.pagamentoConfirmacao .bandeirasApp')
    // let h = $('.boxConfirmacao').height()

    if ($('.pagamentoConfirmacao input#dinheiro').is(':checked')) {
      troco.fadeIn(50)
      troco.find('#change').focus()
      // $('html, body').animate({scrollTop: h})
    } else {
      troco.fadeOut(50)
    }

    if ($('.pagamentoConfirmacao input#maquininha').is(':checked')) {
        bandeirasMaq.fadeIn(50)
      // $('html, body').animate({scrollTop: h})
    } else {
        bandeirasMaq.fadeOut(50)
    }

      if ($('.pagamentoConfirmacao input#aplicativo').is(':checked')) {
          bandeirasApp.fadeIn(50)
          // $('html, body').animate({scrollTop: h})
      } else {
          bandeirasApp.fadeOut(50)
      }
  })

  $(document).on('click', '#enviar-pedido', function (e) {
    $(this).blur()
    postOrder()
  })
})
