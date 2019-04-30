jQuery(document).ready(function(event) {

 jQuery('#formoid').submit(ajaxSubmit);

 function ajaxSubmit() {
    var BookingForm = jQuery(this).serialize();
    jQuery.ajax({
      action:  'make_booking',
      type:    "POST",
      url:     MBAjax.admin_url,
      data:    BookingForm,
      success: function(data) {
         jQuery("#feedback").html(data);
      }
    });
    return false;
  }
});