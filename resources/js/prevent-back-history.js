// resources/js/prevent-back-history.js

(function() {
  // Prevent going back to the previous page after logout
  if (window.location.pathname !== '/customer/sign-in') {
      window.history.pushState(null, '', window.location.href);
      window.onpopstate = function() {
          window.history.pushState(null, '', window.location.href);
      };
  }
})();
