jQuery("#websand-contact-form").submit(function(event){

  if (jQuery("#wshq_subscribe_confirmation").is(":checked")) {

    jQuery.ajax({
      url: "http://" + jQuery("#wshq_domain").val() + ".websandhq.com/api/data/subscriber",
      type: "POST",
      beforeSend: function(xhr) {
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.setRequestHeader("Authorization", "Token " + jQuery("#wshq_subscribe_key").val());
      },
      data: JSON.stringify({
        subscriber: {
          first: jQuery("#wshq_subscriber_first").val(),
          email: jQuery("#wshq_subscriber_email").val(),
          source: jQuery("#wshq_source").val(),
          confirmed: 'true',
          subscribed_at: new Date(jQuery.now()).toISOString()
        }
      }),
      success: function(data, textStatus, jqXHR) {
        location.href = jQuery("#wshq_redirect").val()
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr);
      }
    });
  } else {
    jQuery("#wshq_confirmation").css({
      "border-color": "#F00", 
      "border-width":"2px", 
      "border-style":"solid"
    });
  }
  
  event.preventDefault();
})
