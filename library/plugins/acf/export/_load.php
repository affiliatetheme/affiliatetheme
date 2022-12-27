<?php
add_action('admin_menu', 'load_import_export_page', 10);
function load_import_export_page() {
    add_submenu_page('themes.php', __('Import / Export', 'affiliatetheme-backend'), __('Import / Export', 'affiliatetheme-backend'), 'switch_themes', 'at_import_export_data', 'affiliatetheme_import_export_page');

    function affiliatetheme_import_export_page() {
        $fields = acf_get_field_groups();
        if ($fields) {
            $choices = array();
            foreach ($fields as $field) {
                if (substr($field['title'], 0, 6) != 'Option')
                    continue;

                $choices[$field['key']] = $field['title'];
            }
        }

        ?>
        <div class="wrap" id="at-import-page">
            <h1><?php _e('affiliatetheme.io &raquo; Import / Export', 'affiliatetheme-backend'); ?></h1>

            <h2 class="nav-tab-wrapper" id="at-api-tabs">
                <a class="nav-tab nav-tab-active" id="option-tab" href="#top#option"><?php _e('Optionen', 'affiliatetheme-backend'); ?></a>
                <a class="nav-tab" id="customizer-tab" href="#top#customizer"><?php _e('Customizer', 'affiliatetheme-backend'); ?></a>
            </h2>

        <div class="tabwrapper">
            <!-- START: Option Tab-->
            <div id="option" class="at-api-tab active">
                <div id="at-import-settings" class="metabox-holder postbox">

                    <div class="inside">
                        <h3 class="hndle"><span><?php _e('Optionen › Exportieren', 'affiliatetheme-backend'); ?></span></h3>

                        <p><?php _e('Wähle aus welche Einstellungen exportiert werden sollen', 'affiliatetheme-backend'); ?></p>

                        <select name="group_ids" class="widefat" multiple style="height:120px">
                            <?php
                            if ($choices) {
                                foreach ($choices as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option><?php
                                }
                            }
                            ?>
                        </select>

                        <h4><?php _e('Exportierte Daten', 'affiliatetheme-backend'); ?></h4>

                        <textarea class="widefat" id="exported-fields" style="height:200px;margin-bottom:15px;"></textarea>

                        <a class="button button-primary" id="export-fields"><?php _e('Einstellungen exportieren', 'affiliatetheme-backend'); ?></a>


                        <p>&nbsp;</p>


                        <h3 class="hndle"><span><?php _e('Optionen › Importieren', 'affiliatetheme-backend'); ?></span></h3>

                        <p><?php _e('Füge hier die exportierten Daten ein und bestätige mit dem Button den Import.', 'affiliatetheme-backend'); ?></p>

                        <div class="alert alert-warning">
                            <?php _e('Wichtiger Hinweis: Während des Importvorgangs werden alle aktuellen Einstellungen<strong>überschrieben!</strong>', 'affiliatetheme-backend'); ?>
                        </div>

                        <textarea class="widefat" id="imported-fields" style="height:200px;margin-bottom:15px;"></textarea>

                        <a class="button button-primary" id="import-fields" style="margin-bottom:15px;"><?php _e('Einstellungen importieren', 'affiliatetheme-backend'); ?></a>

                        <div id="fields-message"></div>
                    </div>
                </div>
            </div>

            <!-- START: Customizer Tab-->
            <div id="customizer" class="at-api-tab">
                <div id="at-import-settings" class="metabox-holder postbox">

                    <div class="inside">
                        <h3 class="hndle"><span><?php _e('Customizer › Exportieren', 'affiliatetheme-backend'); ?></span></h3>

                        <h4><?php _e('Exportierte Daten', 'affiliatetheme-backend'); ?></h4>

                        <textarea class="widefat" id="exported-customizer" style="height:200px;margin-bottom:15px;"></textarea>

                        <a class="button button-primary" id="export-customizer"><?php _e('Einstellungen exportieren', 'affiliatetheme-backend'); ?></a>


                        <p>&nbsp;</p>


                        <h3 class="hndle"><span><?php _e('Customizer › Importieren', 'affiliatetheme-backend'); ?></span></h3>

                        <p><?php _e('Füge hier die exportierten Daten ein und bestätige mit dem Button den Import.', 'affiliatetheme-backend'); ?></p>

                        <div class="alert alert-warning"><?php _e('Wichtiger Hinweis: Während des Importvorgangs werden alle aktuellen Anpassungen <strong>überschrieben!</strong>', 'affiliatetheme-backend'); ?></div>

                        <textarea class="widefat" id="imported-customizer" style="height:200px;margin-bottom:15px;"></textarea>

                        <a class="button button-primary" id="import-customizer" style="margin-bottom:15px;"><?php _e('Einstellungen importieren', 'affiliatetheme-backend'); ?></a>

                        <div id="customizer-message"></div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                /*
                 * Fields
                 */
                jQuery('#export-fields').click(function() {
                    var group_ids = jQuery('select[name=group_ids]').val();

                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: "action=at_export_fields&group_ids=" + group_ids,
                        success: function(data){
                            jQuery('textarea#exported-fields').val(data).fadeIn();
                        }
                    });
                });

                jQuery('#import-fields').click(function() {
                    var data = jQuery('textarea#imported-fields').val();

                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: "action=at_import_fields&data=" + data,
                        success: function(data){
                            jQuery('#fields-message').html(data).fadeIn();
                        }
                    });
                });

                /*
                 * Customizer
                 */
                jQuery('#export-customizer').click(function() {
                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: "action=at_export_customizer",
                        success: function(data){
                            jQuery('textarea#exported-customizer').val(data).fadeIn();
                        }
                    });
                });

                jQuery('#import-customizer').click(function() {
                    var data = jQuery('textarea#imported-customizer').val();

                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: "action=at_import_customizer&data=" + data,
                        success: function(data){
                            jQuery('#customizer-message').html(data).fadeIn();
                        }
                    });
                });

                // Tabs
                jQuery("#at-api-tabs a.nav-tab").click(function(e){
                    jQuery("#at-api-tabs a").removeClass("nav-tab-active");
                    jQuery(".at-api-tab").removeClass("active");

                    var a = jQuery(this).attr("id").replace("-tab","");
                    jQuery("#"+a).addClass("active");
                    jQuery(this).addClass("nav-tab-active");
                });

                jQuery(document).ready(function(e) {
                    var a=window.location.hash.replace("#top#","");
                    (""==a||"#_=_"==a) &&(a=jQuery(".at-api-tab").attr("id")),jQuery('#at-api-tabs a').removeClass('nav-tab-active'),jQuery('.at-api-tab').removeClass('active'),jQuery("#"+a).addClass("active"),jQuery("#"+a+"-tab").addClass("nav-tab-active");
                })
            </script>
        </div>
        <?php
    }
}

add_action('wp_ajax_at_export_fields', 'at_export_fields');
function at_export_fields() {
    $group_ids = explode(',', $_POST['group_ids']);

    if($group_ids) {
        $settings = array();

        foreach($group_ids as $key) {
            $fields = acf_get_fields($key);

            if($fields) {
                foreach($fields as $field) {
                    if($field['name'] == '')
                        continue;

                    $value = get_field($field['name'], 'option');
                    $value = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $value);

                    // remove style & script tags
                    $value = str_replace(array('<style>', '</style>', '<script>', '</script>'), '', $value);

                    $settings[$field['name']] = $value;
                }
            }
        }

        echo wp_json_encode($settings);
    }

    exit;
}

add_action('wp_ajax_at_import_fields', 'at_import_fields');
function at_import_fields() {
    $data_clean = stripcslashes($_POST['data']);
    $data =  json_decode(utf8_decode($data_clean), true);

    if ($data) {
        foreach ($data as $key => $val) {
            if($key == 'product_tax') {
                $key = 'field_553b70adc4323';
            }

            update_field($key, $val, 'option');
        }

        echo '<div class="alert alert-success">' . __('Importvorgang erfolgreich', 'affiliatetheme-backend') . '</div>';
    } else {
        echo '<div class="alert alert-danger">' . __('Es wurden keine Daten gefunden.', 'affiliatetheme-backend') . '</div>';
    }

    exit;
}

add_action('wp_ajax_at_export_customizer', 'at_export_customizer');
function at_export_customizer() {
    $mods = get_theme_mods();
    if($mods) {
        $settings = array();

        foreach($mods as $key => $val) {
            // Don't save widget data.
            if ( stristr( $key, 'widget_' ) )
                continue;

            // Don't save sidebar data.
            if ( stristr( $key, 'sidebars_' ) )
                continue;

            // Don't save empty data.
            if ( $val == '' )
                continue;

            $settings[$key] = $val;
        }

        echo json_encode($settings);
    }

    exit;
}

add_action('wp_ajax_at_import_customizer', 'at_import_customizer');
function at_import_customizer() {
    $data_clean = stripcslashes($_POST['data']);
    $data =  json_decode(utf8_decode($data_clean), true);

    if ($data) {
        foreach ($data as $key => $val) {
            set_theme_mod($key, $val);
        }

        echo '<div class="alert alert-success">' . __('Importvorgang erfolgreich', 'affiliatetheme-backend') . '</div>';
    } else {
        echo '<div class="alert alert-danger">' . __('Es wurden keine Daten gefunden.', 'affiliatetheme-backend') . '</div>';
    }

    exit;
}