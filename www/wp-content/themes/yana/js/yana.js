(function() {
  var YANA;

  YANA = {
    htmlElement: $('html'),
    initDebug: function() {
      var _this = this;
      return this.htmlElement.on('keypress', function(e) {
        if (e.which === 96) {
          _this.htmlElement.toggleClass('debug');
          return $(window).trigger('resize');
        }
      });
    },
    initHighContrast: function() {
      var contrastClass,
        _this = this;
      contrastClass = 'high-contrast';
      this.htmlElement.addClass(allCookies.getItem('yana-contrast'));
      return $('a.toggle-contrast').on('click', function(e) {
        var currentClass;
        e.preventDefault();
        currentClass = '';
        if (_this.htmlElement.hasClass(contrastClass)) {
          _this.htmlElement.removeClass(contrastClass);
          allCookies.removeItem('yana-contrast', '/');
        } else {
          _this.htmlElement.addClass(contrastClass);
          currentClass = contrastClass;
          allCookies.setItem('yana-contrast', currentClass, Infinity, '/');
        }
        _this.trackEvent('accessibility', 'toggle-contrast');
        return $(window).trigger('resize');
      });
    },
    trackPageView: function(href) {
      var e;
      try {
        return _gaq.push(['_trackPageview', href]);
      } catch (_error) {
        e = _error;
      }
    },
    trackEvent: function(category, action, opt_label, opt_value, opt_noninteraction) {
      var e;
      try {
        return _gaq.push(['_trackEvent', category, action, opt_label, opt_value, opt_noninteraction]);
      } catch (_error) {
        e = _error;
      }
    }
  };

  $(document).on('ready', function(e) {
    YANA.initDebug();
    return YANA.initHighContrast();
  });

  window.YANA = YANA;

}).call(this);
