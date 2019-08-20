(function ($) {
  
  //find the state the user selects
  function find_state( element ) {
    element.find('span').hide();
    return parseInt( element.html() );
  }

  $(document).on( 'click', '.ab-container-content button', function( event ) {
      event.preventDefault();

      state = find_state( $(this).clone() );

      $.ajax({
        url: ajaxdropdown.ajaxurl,
        type: 'post',
        data: {
          action: 'ajax_dropdown',
          query_vars: ajaxdropdown.query_vars,
          state: state
        },
        success: function( html ) {
          $('#state-req-container').find( 'state' ).hide();
          $('#state-req-container .test').hide();
          $('#state-req-container').append( html );
        }
      })
  })
})(jQuery);