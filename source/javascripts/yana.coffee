YANA =
  initDebug: ->
    $(document).on 'keypress', (e) ->
      if e.which == 96
        $('html').toggleClass('debug');
        $(window).trigger('resize');

  trackPageView: (href) ->
    try
      _gaq.push(['_trackPageview', href]);
    catch e

  trackEvent: (category, action, opt_label, opt_value, opt_noninteraction) ->
    try
      _gaq.push(['_trackEvent', category, action, opt_label, opt_value, opt_noninteraction]);
    catch e

YANA.initDebug()

window.YANA = YANA
