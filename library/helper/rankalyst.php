<?php
/**
 * Rankalyst API
 *
 * @author		Christian Lang
 * @version		1.0
 * @category	helper
 */

/**
* Rankalyst Widget Class
*/ 
add_action('wp_dashboard_setup', array('AT_Rankalyst_Widget','init') );
class AT_Rankalyst_Widget {
    /**
     * The id of this widget.
     */
    const wid = 'at_rankanalyst_widget';

    /**
     * Hook to wp_dashboard_setup to add the widget.
     */
    public static function init() {
        //Register widget settings...
        self::update_dashboard_widget_options(
            self::wid,                                  //The  widget id
            array(                                      //Associative array of options & default values
                'username' => '',
				'apikey' => '',
				'project_id' => '',
            ),
            true                                        //Add only (will not update existing options)
        );

        //Register the widget...
        wp_add_dashboard_widget(
            self::wid,                                  //A unique slug/ID
            __( 'Rankalyst Statistik', 'affiliatetheme-backend' ),//Visible name for the widget
            array('AT_Rankalyst_Widget','widget'),      //Callback for the main widget content
            array('AT_Rankalyst_Widget','config')       //Optional callback for widget configuration content
        );
    }

    /**
     * Load the widget code
     */
    public static function widget() {
		$username = self::get_dashboard_widget_option(self::wid, 'username');
		$apikey = self::get_dashboard_widget_option(self::wid, 'apikey');
		$project_id = self::get_dashboard_widget_option(self::wid, 'project_id');
		$ref_url = 'http://go.endcore.64905.digistore24.com/';
		$check = ($username && $apikey && $project_id ? true : false);
        
		if(!$check) {
			echo '<h4 style="text-align:right; padding-right: 40px; padding-top: 10px">' . __( 'Bitte prüfe die Einstellungen &and;', 'affiliatetheme-backend' ) . '</h4>&nbsp;';
            ?>
            <div class="rankalyst-text">
                <a href="<?php echo $ref_url; ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/_/img/rankalyst.png"></a>
                <p><?php printf(__('Mit <a href="%s" target="_blank">Rankalyst</a> kannst du 10 Keywords kostenlos tracken!', 'affiliatetheme-backend'), $ref_url); ?></p>
                <a href="<?php echo $ref_url; ?>" target="_blank" class="button button-primary"><?php _e('Kostenlos starten', 'affiliatetheme-backend'); ?></a>
            </div>
            <?php
		}
		
		/* @TODO Rankingchange <span class="plus">+</span> bzw Minus ausgeben, jenachdem ob Change positiv oder negativ. */

        ?>
        <div class="rankalyst-data">
            <ul class="rankalyst-tabs">
                <li><a href="#" data-type="organic" class="active"><?php _e('Organic', 'affiliatetheme-backend'); ?></a></li>
                <li><a href="#" data-type="mobile"><?php _e('Mobile', 'affiliatetheme-backend'); ?></a></li>
                <li><a href="#" data-type="local"><?php _e('Local', 'affiliatetheme-backend'); ?></a></li>
            </ul>

            <div class="rankalyst-tab active" data-type="organic">
                <?php
                $rankalyst = new AT_Rankalyst_API($username, $apikey, $project_id, 1);
                if($rankalyst) {
	                $response = $rankalyst->data();
	                if($response) {
		                if ( $response->status != 'success' ) {
			                echo '<div class="rankalyst-text"><p style="color: #c01313; margin-top: 10px">' . $response->message . '</p></div>';
		                } else {
			                if ( $response->data ) {
				                $data = $response->data->items;
				                $rankalyst->output( $data );
			                }
		                }
	                }
                }
                ?>
            </div>

           <div class="rankalyst-tab" data-type="mobile">
                <?php
                $rankalyst = new AT_Rankalyst_API($username, $apikey, $project_id, 2);
                if($rankalyst) {
	                $response = $rankalyst->data();
	                if($response) {
		                if ( $response->status != 'success' ) {
			                echo '<div class="rankalyst-text"><p style="color: #c01313; margin-top: 10px">' . $response->message . '</p></div>';
		                } else {
			                if ( $response->data ) {
				                $data = $response->data->items;
				                $rankalyst->output( $data );
			                }
		                }
	                }
                }
                ?>
            </div>

             <div class="rankalyst-tab" data-type="local">
                <?php
                $rankalyst = new AT_Rankalyst_API($username, $apikey, $project_id, 3);
                if($rankalyst) {
	                $response = $rankalyst->data();
	                if($response) {
		                if ( $response->status != 'success' ) {
			                echo '<div class="rankalyst-text"><p style="color: #c01313; margin-top: 10px">' . $response->message . '</p></div>';
		                } else {
			                if ( $response->data ) {
				                $data = $response->data->items;
				                $rankalyst->output( $data );
			                }
		                }
	                }
                }
                ?>
            </div>
        </div>
        <?php
    }

    /**
     * Load widget config code.
     *
     * This is what will display when an admin clicks
     */
    public static function config() {
		$username = ( isset( $_POST['username'] ) ) ? stripslashes( $_POST['username'] ) : self::get_dashboard_widget_option(self::wid, 'username');
		$apikey = ( isset( $_POST['apikey'] ) ) ? stripslashes( $_POST['apikey'] ) : self::get_dashboard_widget_option(self::wid, 'apikey');
		$project_id = ( isset( $_POST['project_id'] ) ) ? stripslashes( $_POST['project_id'] ) : self::get_dashboard_widget_option(self::wid, 'project_id');
		
		self::update_dashboard_widget_options(
			self::wid,                                  //The  widget id
			array(                                      //Associative array of options & default values
				'username' => $username,
				'apikey' => $apikey,
				'project_id' => $project_id,
			)
		);
        ?>
		<p><label for="username"><?php _e('Benutzername:', 'affiliatetheme-backend'); ?></label> <input type="text" name="username" value="<?php echo $username; ?>" /></p>
		<p><label for="apikey"><?php _e('API Key:', 'affiliatetheme-backend'); ?></label> <input type="text" name="apikey" value="<?php echo $apikey; ?>" ></p>
		<p><label for="project_id"><?php _e('Projekt ID:', 'affiliatetheme-backend'); ?></label> <input type="text" name="project_id" value="<?php echo $project_id; ?>" ></p>

        <p><?php _e('Kein API Key vorhanden? Bitte wende dich an den Rankalyst Support: support@rankalyst.de', 'affiliatetheme-backend'); ?></p>
		<?php
    }

    /**
     * Gets the options for a widget of the specified name.
     *
     * @param string $widget_id Optional. If provided, will only get options for the specified widget.
     * @return array An associative array containing the widget's options and values. False if no opts.
     */
    public static function get_dashboard_widget_options( $widget_id='' )
    {
        //Fetch ALL dashboard widget options from the db...
        $opts = get_option( 'dashboard_widget_options' );

        //If no widget is specified, return everything
        if ( empty( $widget_id ) )
            return $opts;

        //If we request a widget and it exists, return it
        if ( isset( $opts[$widget_id] ) )
            return $opts[$widget_id];

        //Something went wrong...
        return false;
    }

    /**
     * Gets one specific option for the specified widget.
     * @param $widget_id
     * @param $option
     * @param null $default
     *
     * @return string
     */
    public static function get_dashboard_widget_option( $widget_id, $option, $default=NULL ) {

        $opts = self::get_dashboard_widget_options($widget_id);

        //If widget opts dont exist, return false
        if ( ! $opts )
            return false;

        //Otherwise fetch the option or use default
        if ( isset( $opts[$option] ) && ! empty($opts[$option]) )
            return $opts[$option];
        else
            return ( isset($default) ) ? $default : false;

    }

    /**
     * Saves an array of options for a single dashboard widget to the database.
     * Can also be used to define default values for a widget.
     *
     * @param string $widget_id The name of the widget being updated
     * @param array $args An associative array of options being saved.
     * @param bool $add_only If true, options will not be added if widget options already exist
     */
    public static function update_dashboard_widget_options( $widget_id , $args=array(), $add_only=false )
    { 		
        //Fetch ALL dashboard widget options from the db...
        $opts = get_option( 'dashboard_widget_options' );

        //Get just our widget's options, or set empty array
        $w_opts = ( isset( $opts[$widget_id] ) ) ? $opts[$widget_id] : array();

        if ( $add_only ) {
            //Flesh out any missing options (existing ones overwrite new ones)
            $opts[$widget_id] = array_merge($args,$w_opts);
        }
        else {
            //Merge new options with existing ones, and add it back to the widgets array
            $opts[$widget_id] = array_merge($w_opts,$args);
        }

        //Save the entire widgets array back to the db
        return update_option('dashboard_widget_options', $opts);
    }
}

/**
 * Rankalyst API Class
 */
class AT_Rankalyst_API {
	function __construct($username, $apikey, $project_id, $type = 1) {
		$this->username = $username;
		$this->apikey = $apikey;
		$this->project_id = $project_id;
        $this->type = $type;
		$this->response = '';
	}
	
	private function build_url() {
		$query = http_build_query([
			'username' => $this->username,
			'api_key' => $this->apikey,
			'project_id' => $this->project_id,
			'action' => 'project_keyword_rankings',
			'date' => date('Y-m-d'),
            'count' => '10',
            'scrape_type_id' => $this->type
		]);
				
		return $query;
	}
	
	private function connect() {
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => 'https://www.rankalyst.de/API?' . $this->build_url(),
			CURLOPT_USERAGENT => 'affiliatetheme.io backend'
		));

		$resp = curl_exec($curl);
		
		curl_close($curl);
		
		$this->response = $resp;
	}
	
	public function data() {
        if ( false === ( $data = get_transient( 'at_rankalyst_data_' . $this->project_id . '_' . $this->type ) ) ) {
            // connect
            $this->connect();

            $data = (object)array('status' => '', 'message' => '', 'data' => '');

            if ($this->response) {
                $data = json_decode($this->response);

                if ($data) {
                    /* add readable errors */
                    if ($data->status == 'unauth' || $data->status == 'fail') {
                        $data->message = __('Eine Verbindung kann nicht hergestellt werden. Bitte überprüfe deine Einstellungen.', 'affiliatetheme-backend');
                    } else if ($data->status == 'success') {
                        set_transient('at_rankalyst_data_' . $this->project_id . '_' . $this->type, $data, 6 * HOUR_IN_SECONDS);
                    }
                }
            }
        }

        return $data;
	}

    public function output($data) {
        ?>
        <table class="rankalyst-table">
            <thead>
                <tr>
                  <th><?php _e('Keyword', 'affiliatetheme-backend'); ?></th>
                  <th><?php _e('Ranking', 'affiliatetheme-backend'); ?></th>
                  <th><?php _e('Aktualisiert', 'affiliatetheme-backend'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($data as $item) {
                    $readable_date = date_i18n('d.m.Y', strtotime($item->date));
                    ?>
                    <tr>
                        <td>
                            <span data="keyword"><?php echo $item->keyword; ?></span>
                            <span data="url"><?php if($item->url) {?><a href="<?php echo $item->url; ?>" target="_blank"><span class="dashicons dashicons-external"></span></a><?php } ?></span>
                            <br>
                            <span data="search_volume"><?php printf('SV: %s', $item->search_volume); ?></span>
                        </td>
                      <td>
                        <span data="ranking"><?php echo $item->ranking; ?></span>
                        <span data="ranking_change">(<?php echo $item->ranking_change; ?>)</span>
                      </td>
                      <td>
                        <span data="date"><?php echo $readable_date; ?></span>
                      </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <div class="rankalyst-footer">
            <p><a href="<?php echo $ref_url; ?>" target="_blank"><?php _e('Du brauchst mehr Keywords? Rankalyst gibt\'s ab 11,50,- EUR!', 'affiliatetheme-backend'); ?></a></p>
        </div>

        <script type="text/javascript">
            jQuery('#at_rankanalyst_widget .rankalyst-tabs a').on('click', function(e) {
                var target = jQuery(this).data('type');

                // link
                jQuery('#at_rankanalyst_widget .rankalyst-tabs a').removeClass('active');
                jQuery(this).addClass('active');

                // target
                jQuery('#at_rankanalyst_widget .rankalyst-tab').removeClass('active');
                jQuery('#at_rankanalyst_widget .rankalyst-tab[data-type="' + target + '"]').addClass('active');

                e.preventDefault();

                return false;
            });
        </script>
        <?php
    }
}