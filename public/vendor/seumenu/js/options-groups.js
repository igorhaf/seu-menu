// options-groups.js
var BreakException = {}

var OGOption = class {
  constructor(uuid, product, name, group, price, isHalfPortion, category) {
    this.uuid = uuid
    this.product = product
    this.name = name
    this.group = group
    this.price = parseFloat(price)
    this.isHalfPortion = isHalfPortion
    this.category = category
  }

  isOption(uuid) {
    return this.uuid === uuid
  }
}


var OGManager = class {
  constructor() {
    this.options = []
  }

  clear() {
    this.options = []
  }

  updateItemInLocalStorage(uuid, newPrice) {
    let item = JSON.parse(loadFromLocalStorage(uuid))
    item.price = parseFloat(newPrice)
    saveToLocalStorage(uuid, JSON.stringify(item))
  }

  addOption(option) {
    self = this
    // is it a half item? if not, just add to the list
    if (!option.isHalfPortion) {
      this.options.push([option])

    // otherwise, let's find it's perfect pair or add alone
    } else {
      let added = false

      try {
        this.options.forEach(function (obj) {
          if (obj.length == 2) {
            if (obj[1] == null && obj[0].category == option.category && obj[0].product != option.product) {
              obj[1] = option

              if (useMoreExpensiveHalf) {
                if (obj[0].price > obj[1].price) {
                  obj[1].price = obj[0].price
                  self.updateItemInLocalStorage(obj[1].uuid, obj[1].price)
                } else if (obj[1].price > obj[0].price) {
                  obj[0].price = obj[1].price
                  self.updateItemInLocalStorage(obj[0].uuid, obj[0].price)
                }
              }

              throw BreakException
            }
          }
        })
      } catch (e) {
        if (e === BreakException) {
          added = true
        } else {
          throw e
        }
      }

      if (!added) {
        this.options.push([option, null])
      }
    }
  }

  isCorrect(uuid) {
    let result = null

    try {
      this.options.forEach(function (obj) {
        // is a full-portion product?
        if (obj.length == 1 && obj[0].isOption(uuid)) {
          result = true
          throw BreakException

        // is a half-portion ? is it fulfilled?
        } else if (obj.length == 2) {

          if (obj[0] !== null && obj[1] !== null) {
            result = obj[0].isOption(uuid) || obj[1].isOption(uuid)
            if (result) {
              throw BreakException
            }

          } else {
            result = (
              (obj[0] !== null && obj[0].isOption(uuid)) || (obj[1] !== null && obj[1].isOption(uuid))
            )
            if (result) {
              result = false
              throw BreakException
            }
          }
        }
      })
    } catch (e) {
      if (e !== BreakException) throw e
    }

    return result
  }

  validate() {
    // I do not need to validate full-portions... only half-portions.
    let halfItemsLeft = []

    this.options.forEach(function(obj) {
      if (obj.length == 2) {
        if (obj[0] !== null && obj[1] === null) {
          halfItemsLeft.push(obj[0])
        } else if (obj[0] === null && obj[1] !== null) {
          halfItemsLeft.push(obj[1])
        }
      }
    })

    return (halfItemsLeft.length === 0) ? true : halfItemsLeft
  }

  getPairOf(uuid) {
    let pair = null
    try {
      this.options.forEach(function(obj) {
        if (obj.length == 2) {
          if (obj[0].uuid == uuid) {
            pair = obj[1].uuid
          } else if (obj[1].uuid == uuid) {
            pair = obj[0].uuid
          }

          if (pair != null) throw BreakException
        }
      })
    } catch (e) {
      if (e !== BreakException) throw e
    }

    return pair
  }
}

var OG = new OGManager()
