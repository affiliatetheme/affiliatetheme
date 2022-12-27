<?php
/**
 * Welcome Tour
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	pointer
 */
class WordImpress_Theme_Tour {

    private $pointer_close_id = 'affiliatetheme_tour'; //value can be cleared to retake tour

    /**
     * Class constructor.
     *
     * If user is on a pre pointer version bounce out.
     */
    function __construct() {
        global $wp_version;

        //pre 3.3 has no pointers
        if (version_compare($wp_version, '3.4', '<'))
            return false;

        //version is updated ::claps:: proceed
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    /**
     * Enqueue styles and scripts needed for the pointers.
     */
    function enqueue() {
        if (!current_user_can('manage_options'))
            return;

        // Assume pointer shouldn't be shown
        $enqueue_pointer_script_style = false;

        // Get array list of dismissed pointers for current user and convert it to array
        $dismissed_pointers = explode(',', get_user_meta(get_current_user_id(), 'dismissed_wp_pointers', true));
        //print_r($dismissed_pointers); die();

        // Check if our pointer is not among dismissed ones
        if (!in_array($this->pointer_close_id, $dismissed_pointers)) {
            $enqueue_pointer_script_style = true;

            // Add footer scripts using callback function
            add_action('admin_print_footer_scripts', array($this, 'intro_tour'));
        }

        // Enqueue pointer CSS and JS files, if needed
        if ($enqueue_pointer_script_style) {
            wp_enqueue_style('wp-pointer');
            wp_enqueue_script('wp-pointer');
        }

    }


    /**
     * Load the introduction tour
     */
    function intro_tour() {

        $adminpages = array(
            'themes' => array(
                'content' => "<h3>" . __('Willkommen im affiliatetheme.io', 'affiliatetheme-backend') . "</h3>"
                    . "<p>" . __('Bevor du los legst musst du dein Theme aktivieren, das kannst du hier unter dem Punkt Lizenz erledigen. Anschließend kannst du unter Anpassen die Farben deiner Seite anpassen.', 'affiliatetheme-backend') . "</p>", //Content for this pointer
                'id' => 'menu-appearance',
                'position' => array(
                    'edge' => 'left',
                    'align' => 'center'
                ),
                'button2' => __('Weiter', 'affiliatetheme-backend'),
                'function' => 'window.location="' . admin_url('admin.php?page=acf-options-allgemein&welcome_tour=1') . '";'
            ),
            'acf-options-allgemein' => array(
                'content' => '<h3>' . __('Allgemeine Optionen', 'affiliatetheme-backend') . '</h3><p>' . __('An dieser Stelle kannst du z.B. eigenen CSS oder JavaScript Code laden oder andere allgemeine Einstellungen vornehmen.', 'affiliatetheme-backend') . '</p>',
                'id' => 'acf-options-allgemein',
                'position' => array(
                    'edge' => 'left',
                    'align' => 'center'
                ),
                'button2' => __('Weiter', 'affiliatetheme-backend'),
                'function' => 'window.location="' . admin_url('admin.php?page=acf-options-design&welcome_tour=2') . '";'
            ),
            'acf-options-design' => array(
                'content' => '<h3>' . __('Design', 'affiliatetheme-backend') . '</h3><p>' . __('Passe das Layout deiner Seite an deine Bedürfnisse an, es stehen dir viele Möglichkeiten zur Auswahl.', 'affiliatetheme-backend') . '</p>',
                'id' => 'acf-options-allgemein_2',
                'position' => array(
                    'edge' => 'left',
                    'align' => 'center'
                ),
                'button2' => __('Weiter', 'affiliatetheme-backend'),
                'function' => 'window.location="' . admin_url('admin.php?page=acf-options-blog&welcome_tour=3') . '";'
            ),
            'acf-options-blog' => array(
                'content' => "<h3>" . __('Blog', 'affiliatetheme-backend') . "</h3>"
                    . "<p>" . __("Du nutzt einen Blog? Passe die Ausgabe an!", 'affiliatetheme-backend') . "</p>",
                'id' => 'acf-options-allgemein_3',
                'button2' => __('Weiter', 'affiliatetheme-backend'),
                'function' => 'window.location="' . admin_url('admin.php?page=acf-options-produkte&welcome_tour=4') . '";'
            ),
            'acf-options-produkte' => array(
                'content' => "<h3>" . __('Produkte', 'affiliatetheme-backend') . "</h3>"
                    . "<p>" . __('Produkte sind der Hauptbestandteil des Themes, hier kannst du z.B. Taxonomien erstellen oder viele Einstellungen bearbeiten.', 'affiliatetheme-backend') . "</p>",
                'id' => 'acf-options-allgemein_4',
                'button2' => __('Weiter', 'affiliatetheme-backend'),
                'function' => 'window.location="' . admin_url('admin.php?page=endcore_api_dashboard&welcome_tour=5') . '";'
            ),
            'endcore_api_dashboard' => array(
                'content' => "<h3>" . __('Import', 'affiliatetheme-backend') . "</h3>"
                    . "<p>" . __('Wir bieten dir verschiedene Schnittstellen an um Produkte automatisiert zu importieren. Sobald du eine Schnittstelle als Plugin aktivierst, wird diese hier erscheinen.', 'affiliatetheme-backend') . "</p>",
                'id' => 'toplevel_page_endcore_api_dashboard',
                'button2' => __('Weiter', 'affiliatetheme-backend'),
                'function' => 'window.location="' . admin_url('admin.php?page=affiliatetheme_debug&welcome_tour=6') . '";'
            ),
            'affiliatetheme_debug' => array(
                'content' => "<h3>" . __('Debug', 'affiliatetheme-backend') . "</h3>"
                    . "<p>" . __('Wenn du Probleme hast, schau bitte erstmal hier - oftmals fehlen Serverfunktionen. Ansonsten kannst du jederzeit das Supportforum benutzen. Und jetzt viel Spaß mit deinem neuen Theme!', 'affiliatetheme-backend') . "</p>",
                'id' => 'toplevel_page_affiliatetheme_debug',
            ),
        );


        $page = '';
        $screen = get_current_screen();


        //Check which page the user is on
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }
        if (empty($page)) {
            $page = $screen->id;
        }

        $function = '';
        $button2 = '';
        $opt_arr = array();

        //Location the pointer points

        //print_r(strpos($adminpages[$page]['id'], 'acf-options-'));

        if (!empty($adminpages[$page]['id'])) {
            if('1' == strpos($adminpages[$page]['id'], 'cf-options-')) {
                $id = '#toplevel_page_acf-options-allgemein .wp-submenu li.current';
            } else {
                $id = '#' . $adminpages[$page]['id'];
            }
        } else {
            $id = '#' . $screen->id;
        }


        //Options array for pointer used to send to JS
        if ('' != $page && in_array($page, array_keys($adminpages))) {
            $align = (is_rtl()) ? 'right' : 'left';
            $opt_arr = array(
                'content' => $adminpages[$page]['content'],
                'position' => array(
                    'edge' => (!empty($adminpages[$page]['position']['edge'])) ? $adminpages[$page]['position']['edge'] : 'left',
                    'align' => (!empty($adminpages[$page]['position']['align'])) ? $adminpages[$page]['position']['align'] : $align
                ),
                'pointerWidth' => 400
            );
            if (isset($adminpages[$page]['button2'])) {
                $button2 = (!empty($adminpages[$page]['button2'])) ? $adminpages[$page]['button2'] : __('Weiter', 'affiliatetheme-backend');
            }
            if (isset($adminpages[$page]['function'])) {
                $function = $adminpages[$page]['function'];
            }
        }

        $this->print_scripts($id, $opt_arr, __('Schließen', 'affiliatetheme-backend'), $button2, $function);
    }


    /**
     * Prints the pointer script
     *
     * @param string $selector The CSS selector the pointer is attached to.
     * @param array $options The options for the pointer.
     * @param string $button1 Text for button 1
     * @param string|bool $button2 Text for button 2 (or false to not show it, defaults to false)
     * @param string $button2_function The JavaScript function to attach to button 2
     * @param string $button1_function The JavaScript function to attach to button 1
     */
    function print_scripts($selector, $options, $button1, $button2 = false, $button2_function = '', $button1_function = '') {
        ?>
        <script type="text/javascript">
            //<![CDATA[
            (function ($) {

                var wordimpress_pointer_options = <?php echo json_encode( $options ); ?>, setup;

                //Userful info here
                wordimpress_pointer_options = $.extend(wordimpress_pointer_options, {
                    buttons: function (event, t) {
                        button = jQuery('<a id="pointer-close" style="margin-left:5px" class="button-secondary">' + '<?php echo $button1; ?>' + '</a>');
                        button.bind('click.pointer', function () {
                            t.element.pointer('close');
                        });
                        return button;
                    }
                });

                setup = function () {
                    $('<?php echo $selector; ?>').pointer(wordimpress_pointer_options).pointer('open');
                    <?php
                    if ( $button2 ) { ?>
                    jQuery('#pointer-close').after('<a id="pointer-primary" class="button-primary">' + '<?php echo $button2; ?>' + '</a>');
                    <?php } ?>
                    jQuery('#pointer-primary').click(function () {
                        <?php echo $button2_function; ?>
                    });
                    jQuery('#pointer-close').click(function () {
                        <?php if ( $button1_function == '' ) { ?>
                        $.post(ajaxurl, {
                            pointer: '<?php echo $this->pointer_close_id; ?>', // pointer ID
                            action: 'dismiss-wp-pointer'
                        });

                        <?php } else { ?>
                        <?php echo $button1_function; ?>
                        <?php } ?>
                    });

                };

                if (wordimpress_pointer_options.position && wordimpress_pointer_options.position.defer_loading) {
                    $(window).bind('load.wp-pointers', setup);
                } else {

                    $(document).ready(setup);
                }

            })(jQuery);
            //]]>
        </script>
    <?php
    }
}

$wordimpress_theme_tour = new WordImpress_Theme_Tour();