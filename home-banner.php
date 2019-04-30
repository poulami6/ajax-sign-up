 <!-- banner -->
 <?php
 
 if ( isset( $_POST['submit'] ) ){
echo "hello";
    global $wpdb;


    $tablename=$wpdb->pc_instant_quote';

    $data=array(
        'bedrooms' => $_POST['bedrooms'], 
        'bathrooms' => $_POST['bathrooms'],
        'services' => $_POST['services'], 
        'weeks' => $_POST['weeks'],
        ;


     $wpdb->insert( $tablename, $data);

}
 ?>
            <div class="banner" style="background-image: url('<?php bloginfo('template_url'); ?>/images/banner.jpg');">
                <div class="container">
                    <div class="banner-outer">
                        <div class="banner-column banner-order-two">
                            <h2>So Fresh So Clean <br /> 
                                <strong>we promise</strong>
                            </h2>
                            <div class="quote-form">
                                <div class="quote-form-inner">
                                    <h4>Get an Instant Quote</h4>
                                    <form>
                                        <ul>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="select-box">
                                                <select name="bedrooms">
                                                    <option value="2" selected="">2</option>
                                                    <option value="4">4</option>
                                                    <option value="6">6</option>
                                                </select>
                                               </div>
                                            </li>
                                             <li>
                                                <label>Bathroom:</label>
                                                <div class="select-box">
                                                <select name="bathrooms">
                                                    <option value="4" selected="">4</option>
                                                    <option value="6">6</option>
                                                </select>
                                                </div>
                                            </li>
                                            <li>
                                               <input type="radio" name="services" id="radio1" value="1" class="radio-block">
                                                 <label class="radio" for="radio1">
                                                    <div class="radio-vertical">
                                                      1 Time Service
                                                   </div>
                                                </label>
                                            </li>
                                             <li>
                                                <input type="radio" name="services" id="radio2" value="2" class="radio-block">
                                                 <label class="radio" for="radio2">
                                                    <div class="radio-vertical">
                                                         Every week 
                                                   </div>
                                                 </label>
                                                 <p class="off">20% off</p>
                                            </li>
                                            <li>
                                                <input type="radio" name="weeks" id="radio3" value="3" class="radio-block" checked>
                                                  <label class="radio" for="radio3">
                                                    <div class="radio-vertical">
                                                       <b>Every 2weeks</b> <span>(Most Popular)</span>
                                                    </div> 
                                                  </label>
                                                <p class="off popular">15% off</p>
                                            </li>
                                            <li>
                                                <input type="radio" name="weeks" id="radio4" value="4" class="radio-block">
                                                 <label class="radio" for="radio4"><div class="radio-vertical"> Every 4weeks</div></label>
                                                <p class="off">5% off</p>
                                            </li>
                                            <li class="full-width">
                                                <input type="submit" value="Click here to get your instant quote" name="submit">
                                            </li>
                                        </ul>
                                    </form>
                                </div><!-- quote-form-inner -->
                            </div><!-- quote-form -->
                        </div>
                        <div class="banner-column banner-order-one">
                            <img src="<?php bloginfo('template_url'); ?>/images/banner-image.png" alt="">
                        </div>
                    </div>
                    <!-- banner-outer -->
                     </div>
            </div>