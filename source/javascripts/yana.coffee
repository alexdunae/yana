YANA =
  htmlElement: $('html')

  initDebug: ->
    @htmlElement.on 'keypress', (e) =>
      if e.which == 96
        @htmlElement.toggleClass('debug')
        $(window).trigger('resize')

  initHighContrast: ->
    contrastClass = 'high-contrast'
    @htmlElement.addClass(allCookies.getItem('yana-contrast'))

    $('a.toggle-contrast').on 'click', (e) =>
      e.preventDefault()
      currentClass = ''
      if @htmlElement.hasClass(contrastClass)
        @htmlElement.removeClass(contrastClass)
        allCookies.removeItem('yana-contrast', '/')
      else
        @htmlElement.addClass(contrastClass)
        currentClass = contrastClass
        allCookies.setItem('yana-contrast', currentClass, Infinity, '/')


      @trackEvent('accessibility', 'toggle-contrast')
      $(window).trigger('resize')

  trackPageView: (href) ->
    try
      _gaq.push(['_trackPageview', href]);
    catch e

  trackEvent: (category, action, opt_label, opt_value, opt_noninteraction) ->
    try
      _gaq.push(['_trackEvent', category, action, opt_label, opt_value, opt_noninteraction]);
    catch e

$(document).on 'ready', (e) ->
  YANA.initDebug()
  YANA.initHighContrast()

window.YANA = YANA

