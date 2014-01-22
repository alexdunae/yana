(function() {
  var htmlElement, initDebug, initHighContrast, initHomeCircles, initMobileNav, initSidebarQuotes;

  if (window.YANA == null) {
    window.YANA = {};
  }

  htmlElement = $('html');

  initDebug = function() {
    var _this = this;
    return htmlElement.on('keypress', function(e) {
      if (e.which === 96) {
        htmlElement.toggleClass('debug');
        return $(window).trigger('resize');
      }
    });
  };

  initHomeCircles = function() {
    return $('.home-circles .entry a[href]').each(function(idx, el) {
      var link;
      link = $(el);
      return link.closest('.entry').css({
        cursor: 'pointer'
      }).on('click', function(e) {
        document.location = link.attr('href');
        return false;
      });
    });
  };

  initHighContrast = function() {
    var contrastClass,
      _this = this;
    contrastClass = 'high-contrast';
    htmlElement.addClass(allCookies.getItem('yana-contrast'));
    return $('a.toggle-contrast').on('click', function(e) {
      var currentClass;
      e.preventDefault();
      currentClass = '';
      if (htmlElement.hasClass(contrastClass)) {
        htmlElement.removeClass(contrastClass);
        allCookies.removeItem('yana-contrast', '/');
      } else {
        htmlElement.addClass(contrastClass);
        currentClass = contrastClass;
        allCookies.setItem('yana-contrast', currentClass, Infinity, '/');
      }
      YANA.trackEvent('accessibility', 'toggle-contrast');
      return $(window).trigger('resize');
    });
  };

  initMobileNav = function() {
    var _this = this;
    return htmlElement.on('keypress', function(e) {
      if (e.which === 49) {
        return htmlElement.toggleClass('show-nav');
      }
    });
  };

  initSidebarQuotes = function() {
    var out;
    if (YANA.Quotes && YANA.Quotes.length > 0) {
      out = $('.sidebar-community-quote .text');
      if (out.length > 0) {
        return out.text(YANA.Quotes[Math.floor(Math.random() * YANA.Quotes.length)]);
      }
    }
  };

  YANA.trackPageView = function(href) {
    var e;
    try {
      return _gaq.push(['_trackPageview', href]);
    } catch (_error) {
      e = _error;
    }
  };

  YANA.trackPageView = function(category, action, opt_label, opt_value, opt_noninteraction) {
    var e;
    try {
      return _gaq.push(['_trackEvent', category, action, opt_label, opt_value, opt_noninteraction]);
    } catch (_error) {
      e = _error;
    }
  };

  $(document).on('ready', function(e) {
    initDebug();
    initSidebarQuotes();
    initHighContrast();
    initHomeCircles();
    return initMobileNav();
  });

}).call(this);
