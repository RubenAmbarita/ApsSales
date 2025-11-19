/*
 * Lazy load background images for feature cards to improve performance.
 * Works only on elements with class .lazy-bg and data-bg="<image-url>".
 */
(function () {
  var elements = document.querySelectorAll('.card-apartment.lazy-bg[data-bg]');
  if (!elements.length) return;

  function loadBg(el) {
    var src = el.getAttribute('data-bg');
    if (!src) return;
    var img = new Image();
    img.onload = function () {
      el.style.backgroundImage = "url('" + src + "')";
      el.removeAttribute('data-bg');
      el.classList.remove('lazy-bg');
    };
    img.onerror = function () {
      // Fail silently, keep placeholder background-color
      el.removeAttribute('data-bg');
    };
    img.src = src;
  }

  if ('IntersectionObserver' in window) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting || entry.intersectionRatio > 0) {
          loadBg(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { rootMargin: '200px 0px', threshold: 0.01 });

    Array.prototype.forEach.call(elements, function (el) {
      observer.observe(el);
    });
  } else {
    // Fallback for older browsers: load on DOM ready
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
      Array.prototype.forEach.call(elements, loadBg);
    } else {
      document.addEventListener('DOMContentLoaded', function () {
        Array.prototype.forEach.call(elements, loadBg);
      });
    }
  }
})();