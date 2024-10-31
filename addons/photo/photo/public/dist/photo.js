/* global vcv */
(function ($) {
    vcv.on('photoReady', function () {
      var zoomItem = $('.pavc-photo-zoom-wrap')
      zoomItem.each(function () {
        var $source = $(this)
        $source.trigger('zoom.destroy')
        var imgSrc = $source.find('.pavc-photo-image').data('img-src')
  
        $source.find('.zoomImg').each(function () {
          $(this).remove()
        })
  
        $source.zoom({
          url: imgSrc
        })
      })
    })
  
    vcv.on('ready', function () {
      $(function () {
        vcv.trigger('photoReady')
      })
    })
  })(window.jQuery)