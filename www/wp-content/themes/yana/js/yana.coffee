window.YANA ?= {}

$ = jQuery

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
  console.log('init', $('.nav-toggle').length)
  $('.nav-toggle').on 'click', (e) =>
    e.preventDefault()
    htmlElement.toggleClass('show-nav')

  htmlElement.on 'keypress', (e) =>
    if e.which == 49
      htmlElement.toggleClass('show-nav')

initGalleries = ->
  $('.gallery-wrapper .gallery').each (idx, el) ->
    gallery = $(el).closest('.gallery-wrapper')

    gallery.flexslider({
      animation: 'slide'
      selector: '.gallery > .gallery-item'
      animationLoop: true
      controlNav: false
      directionNav: false
      slideshow: false
      after: (slider) ->
        YANA.trackEvent('inline-gallery', 'show', slider.currentSlide)
    })


    $('nav a, img', gallery).on 'click', (evt) ->
      evt.preventDefault()
      dir = if $(this).hasClass('prev') then 'previous' else 'next'
      gallery.flexslider(dir)

initSidebarQuotes = ->
  if YANA.Quotes and YANA.Quotes.length > 0
    out = $('.sidebar-community-quote .text')
    if out.length > 0
      out.text(YANA.Quotes[Math.floor(Math.random() * YANA.Quotes.length)])

initSubscribe = ->
  return unless YANA.XHR_URL
  $('.enews form').on 'submit', (e) ->
    e.preventDefault()
    f = $(this)
    btn = f.find('button')
    msg = f.find('.note')
    email = f.find('input').val()

    if email == ""
      msg.text('Please enter your email address')
      return

    btn.attr('disabled', 'disabled')
    msg.text('Sending...')

    $.post YANA.XHR_URL, {action: 'yana_subscribe', email: email}, (d, s, xhr) ->
      msg.text(d.data.message)
      if d.success
        YANA.trackEvent('subscribe', 'success', email)
      btn.attr('disabled', null)


YANA.trackPageView = (href) ->
  try
    _gaq.push(['_trackPageview', href]);
  catch e

YANA.trackEvent = (category, action, opt_label, opt_value, opt_noninteraction) ->
  try
    _gaq.push(['_trackEvent', category, action, opt_label, opt_value, opt_noninteraction]);
  catch e

$(document).on 'ready', (e) ->
  initDebug()
  initSidebarQuotes()
  initHighContrast()
  initHomeCircles()
  initMobileNav()
  initSubscribe()
  initGalleries()




