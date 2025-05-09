/* localStorage functions */
function removeFromLocalStorage(uuid) { localStorage.removeItem('item_' + uuid) }
function saveToLocalStorage(uuid, value) { localStorage.setItem('item_' + uuid, value) }
function loadFromLocalStorage(uuid) { return localStorage.getItem('item_' + uuid) }
/* End of localStorage functions */

function qttItems() {
  var qtt = 0
    $("#menuCheckout :input").each(function(){
        if($(this).val() > 0){
            qtt++
        }
    });
  return qtt
}


$(document).ready(function() {



	// Menu Mobile
	var slider = $('.menu-mobile').slideReveal()
	slider.slideReveal({
	  trigger: $('.bottaoMobile'),
	  push: false,
	  overlay: true
	})

	$('.menu-mobile li a').click(function (event) {
		slider.slideReveal('toggle')
	})

	// Ativa spinner do input "quantidade"
	$('.lista-produtos input[type="number"]').inputSpinner()
  $('.lista-produtos input[type="text"]').attr('pattern', '[0-9]*')

  // before bind input's change event, we need to load from localStorage

  // now, we can bind the input's change event
  $(document).on('change', '.lista-produtos input[data-uuid]', function (e) {
    e.stopImmediatePropagation()
    let target = $(e.target)
    let uuid = target.data('uuid')

    if (target.val() == 0) {
      if (target.data('group-option') == 1) {
        target.parents('.grupo-variacao .item-variacao').removeClass('selecionado meia-porcao')
      }

    }
  })

  $(document).on('click', '#confirmar-pedido', function(e) {
    e.stopImmediatePropagation()

    console.log(qttItems());
    if (qttItems() == 0) {
      $.confirm({
        type: 'red',
				icon: 'fas fa-exclamation-circle',
        title: 'Nenhum produto',
        content: 'Você precisa selecionar algum produto para prosseguir!',
				buttons: {
          entendi: {
            text: 'Ok! Entendi',
            action: function () { },
            btnClass: 'btn-red'
          }
        }
      })
    } else {
        $('#menuCheckout').submit();
    }
  })

	// Menu Superior //
	var posicaoInicial = $('.menu-superior').position().top
	$(document).scroll(function () {
		var posicaoScroll = $(document).scrollTop()
		if (posicaoInicial < posicaoScroll) {
			$('.menu-superior').addClass('fixo')
		} else {
			$('.menu-superior').removeClass('fixo')
		}
	})

	$('.menu-superior a').click(function (event) {
		$('.menu-superior a').removeClass('ativo')
		$(this).addClass('ativo')
	})

	// Filtros //
	filtro = $('.filtros-header .container').html()
	$('.filtro-fixo .container').html(filtro)

	$(document).scroll(function () {
		var posicaoScroll = $(document).scrollTop()
		if (posicaoScroll >= 367) {
			$('.filtro-fixo').fadeIn()
		} else {
			$('.filtro-fixo').fadeOut()
		}
	})

	// Horário Header //


    $('#modal-login-link').click(function (event) {
        $('#modal-form').open();
    })
	$(document).click(function(e) {
    if (!$(e.target).is('.horario-atendimento p.btn, .horario-atendimento .box-horarios *, .horario-atendimento p *')) {
        $('.horario-atendimento .box-horarios').fadeOut()
    }
  })

  // Acompanha Rolagem Filtros # //
  $('.secaoCategoria').each(function (idx, el) {
    el = $(el)
    var position = el.position()
    el.scrollspy({
      min: position.top,
      max: position.top + el.height(),
      onEnter: function (e) { $('.campoFiltro select').val('#' + e.id) },
      onLeave: function (e) { $('.campoFiltro select').val('#inicio') }
    })
  })
    $(document).on('change', '.campoFiltro select', function() {
        var url_local = url+$(this).val()
        window.location.replace(url_local);
    })
  // Pesquisa
  $(document).on('keyup', 'input[name="search"]', function() {
    let keywords = normalize($(this).val())

    if (keywords.length < 2) {
      $('section[class="video"]').show()
      $('section[class="aviso"]').show()
      $('.category-cover').show()
      $('.secaoCategoria').show()
      $('li.product').show()
    } else {
      $('section[class="video"]').hide()
      $('section[class="aviso"]').hide()
      $('.category-cover').hide()

      $('li.product').each(function (idx, obj) {
        obj = $(obj)

        let index = [
          obj.data('sku'),
          obj.data('name'),
          obj.data('description'),
          obj.data('category')
        ].join(' ')

        let _keywords = keywords.split(' ')

        let found = _keywords.filter(function (o) {
          return index.indexOf(o) > -1
        })

        if (found.length != _keywords.length) {
          $(this).hide()
        } else {
          $(this).show()
        }
      })

      $('.secaoCategoria').each(function (i, category) {
        if ($(category).find('li.product:visible').length == 0) {
          $(category).hide()
        }
      })
    }
  })

  // essential to stop click propagation
  $(document).on('click', 'button.btn.btn-decrement', function(e) {
    e.stopPropagation()
  })

  // group's options onclick event
  $(document).on('click', 'li.item-variacao', function (e) {
    let input = $(this).find('input[data-group-option="1"]')
    if (parseInt(input.val()) == 0) {
      input.val(1)
      input.trigger('change')
    }
  })

  $(document).on('shown.bs.collapse', '.collapse', function(e) {
    let el = $('button[data-target="#' + $(this).attr('id') + '"]')
    el.find('i').toggleClass('fa-angle-down  fa-angle-up')
  })

  // auto-open selected options' groups
  let groupsOptions = $('input[type="number"][data-group-option="1"]')
  for (let i = 0; i < groupsOptions.length; i++) {
    if (parseInt(groupsOptions[i].value) > 0) {
      $(groupsOptions[i]).parents('.collapse').collapse()
    }
  }

})

