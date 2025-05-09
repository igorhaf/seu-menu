const message_types = {
  STATIC: 0,
  TEMPORARY: 1,
  POPUP: 2
}

/**
 * Function to remove all alert messages from its container.
 */
function cleanMessagesContainer() {
  $('div.alert-container').empty().hide()
}

/**
 * Function to show info/alert/warning/error messages.
 * @param {String} msg The message text
 * @param {Integer} type Message type - see message_types constant
 * @param {String} className (option) Based on bootstrap class levels (info, danger...) - default: 'info'
 * @param {Object} focusTo (option) object to be focused after show message - default: null
 * @param {Integer} timeOut (option) Time out in miliseconds to message gone - default: 5s (5000).
 */
function showMessage(msg, type, className='info', focusTo=null, timeOut=5000) {
  if (type == null) type = message_types.TEMPORARY

  let container = $('div.alert-container')

  let static_or_tmp = $(`
    <div class="alert" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
      <div class="message"></div>
    </div>`)

  if (type == message_types.STATIC || type == message_types.TEMPORARY) {
    if (type == message_types.STATIC) container.html('')

    static_or_tmp.addClass('alert-' + className)
    static_or_tmp.find('.message').html(msg)
    container.append(static_or_tmp)

    if (type == message_types.STATIC) {
      // container.show()
      static_or_tmp.show()
      // $("html, body").animate({ scrollTop: 0 }, "fast")
    } else {
      static_or_tmp.slideDown(50)
      window.setTimeout(function() {
        static_or_tmp.slideUp(500)
        cleanMessagesContainer()
      }, timeOut)
    }

    if (focusTo) {
      focusTo.focus()
    }

  } else if (type == message_types.POPUP) {
    $.confirm({
      type: 'red',
      icon: 'fas fa-exclamation-circle',
      title: 'Ops! Verifique o erro.',
      content: msg,
      buttons: {
        entendi: {
          text: 'Ok! Entendi',
          action: function () { },
          btnClass: 'btn-red',
        }
      },
      onDestroy: function () {
        if (focusTo) {
          focusTo.focus()
        }
      }
    })
  }
}

/**
 * Basic function to validate an email address with regular expression.
 * @param {String} email The email address
 */
function validateEmail(email) {
  return /^\w+([\+\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)
}

/**
 * Function to remove all accents and set the whole text to lowercase.
 * @param {String} s String to be normalized.
 */
function normalize(s) {
  let vector = [
    [new RegExp(/\s/g), ' '],
    [new RegExp(/[àáâãäå]/g), 'a'],
    [new RegExp(/æ/g), 'ae'],
    [new RegExp(/ç/g), 'c'],
    [new RegExp(/[èéêë]/g), 'e'],
    [new RegExp(/[ìíîï]/g), 'i'],
    [new RegExp(/ñ/g), 'n'],
    [new RegExp(/[òóôõö]/g), 'o'],
    [new RegExp(/œ/g), 'oe'],
    [new RegExp(/[ùúûü]/g), 'u'],
    [new RegExp(/[ýÿ]/g), 'y'],
    [new RegExp(/\W/g), '']
  ]

  let words = s.toLowerCase().split(' ')
  let normalized = []
  words.forEach(function (w) {
    vector.forEach(function (item) { w = w.replace(item[0], item[1]).trim() })
    normalized.push(w)
  })
  return normalized.join(' ')
}

/**
 * Function to verify if the number is even or not.
 * @param {Integer} n Number to be verified
 */
function isEven(n) {
  return n % 2 == 0
}

/**
 * Function to sort alphabetically an array of objects by some specific key.
 * @param {String} property Key of the object to sort.
 */
function dynamicSort(property) {
    var sortOrder = 1

    if (property[0] === "-") {
        sortOrder = -1
        property = property.substr(1)
    }

    return function (a, b) {
        if (sortOrder == -1) {
            return b[property].localeCompare(a[property])
        } else {
            return a[property].localeCompare(b[property])
        }
    }
}

$(document).ready(function() {
  // fields masks
  $('input.mobile').mask('(99) 99999-9999')
  $('input.zip_code,input.cep').mask('99999-999')
  $('input.landline').mask('(99) 9999-9999')

  let mobileMask = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009'
  }

  let options = {
    onKeyPress: function(val, e, field, options) {
      field.mask(mobileMask.apply({}, arguments), options)
    }
  }
  $('input.phone').mask(mobileMask, options)
})
