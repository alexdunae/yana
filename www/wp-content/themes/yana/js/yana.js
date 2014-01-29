(function() {
  var htmlElement, initDebug, initHighContrast, initHomeCircles, initMobileNav, initSidebarQuotes, initSubscribe;

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
    console.log('init', $('.nav-toggle').length);
    $('.nav-toggle').on('click', function(e) {
      e.preventDefault();
      return htmlElement.toggleClass('show-nav');
    });
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

  initSubscribe = function() {
    if (!YANA.XHR_URL) {
      return;
    }
    return $('.enews form').on('submit', function(e) {
      var btn, email, f, msg;
      e.preventDefault();
      f = $(this);
      btn = f.find('button');
      msg = f.find('.note');
      email = f.find('input').val();
      if (email === "") {
        msg.text('Please enter your email address');
        return;
      }
      btn.attr('disabled', 'disabled');
      msg.text('Sending...');
      return $.post(YANA.XHR_URL, {
        action: 'yana_subscribe',
        email: email
      }, function(d, s, xhr) {
        msg.text(d.data.message);
        if (d.success) {
          YANA.trackEvent('subscribe', 'success', email);
        }
        return btn.attr('disabled', null);
      });
    });
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
    initMobileNav();
    return initSubscribe();
  });

}).call(this);
