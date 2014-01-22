window.YANA ?= {}

htmlElement = $('html')

initDebug = ->
  htmlElement.on 'keypress', (e) =>
    if e.which == 96
      htmlElement.toggleClass('debug')
      $(window).trigger('resize')

initHomeCircles = ->
  $('.home-circles .entry a[href]').each (idx, el) ->
    link = $(el)
    link.closest('.entry').css({cursor: 'pointer'}).on 'click', (e) ->
      document.location = link.attr('href')
      false

initHighContrast = ->
  contrastClass = 'high-contrast'
  htmlElement.addClass(allCookies.getItem('yana-contrast'))

  $('a.toggle-contrast').on 'click', (e) =>
    e.preventDefault()
    currentClass = ''
    if htmlElement.hasClass(contrastClass)
      htmlElement.removeClass(contrastClass)
      allCookies.removeItem('yana-contrast', '/')
    else
      htmlElement.addClass(contrastClass)
      currentClass = contrastClass
      allCookies.setItem('yana-contrast', currentClass, Infinity, '/')


    YANA.trackEvent('accessibility', 'toggle-contrast')
    $(window).trigger('resize')

initMobileNav = ->
  htmlElement.on 'keypress', (e) =>
    if e.which == 49
      htmlElement.toggleClass('show-nav')


initSidebarQuotes = ->
  if YANA.Quotes and YANA.Quotes.length > 0
    out = $('.sidebar-community-quote .text')
    if out.length > 0
      out.text(YANA.Quotes[Math.floor(Math.random() * YANA.Quotes.length)])

YANA.trackPageView = (href) ->
  try
    _gaq.push(['_trackPageview', href]);
  catch e

YANA.trackPageView = (category, action, opt_label, opt_value, opt_noninteraction) ->
  try
    _gaq.push(['_trackEvent', category, action, opt_label, opt_value, opt_noninteraction]);
  catch e

$(document).on 'ready', (e) ->
  initDebug()
  initSidebarQuotes()
  initHighContrast()
  initHomeCircles()
  initMobileNav()




