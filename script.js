<script type="text/javascript">
    


    

    jQuery("#instant_quote").on('click', function() {
            alert('dfddd');
            
                var bedrooms = jQuery('#bedrooms').val();
                var bathrooms = jQuery('#bathrooms').val();
                var radio1=jQuery('#radio1').val();
                var radio2=jQuery('#radio2').val();
                var radio3=jQuery('#radio3').val();
                var radio4=jQuery('#radio4').val();
                var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
                
                var data = {'bedrooms':bedrooms,
                            'bathrooms':bathrooms,
                            'radio1':radio1,
                            'radio2':radio2,
                            'radio3':radio3,
                            'radio4':radio4,
                            'action':'makeBooking'};

                jQuery.ajax({
                    url: ajaxurl,     
                    data: data,
                    type : 'POST',
                    success:function(response) { 
                        
                        alert(response)
                    }
                });
           
        });
    
</script>