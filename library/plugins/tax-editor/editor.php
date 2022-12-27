<?php
class AT_Term_Description_Editor {
	public $taxonomies;

	public function __construct( array $taxonomies ) {
		$this->taxonomies = $taxonomies;
	}

	public function execute() {
		if ( current_user_can( 'publish_posts' ) ) {
			remove_filter( 'pre_term_description', 'wp_filter_kses' );
			remove_filter( 'term_description', 'wp_kses_data' );

			if ( ! current_user_can( 'unfiltered_html' ) ) {
				add_filter( 'pre_term_description', 'wp_kses_post' );
				add_filter( 'term_description', 'wp_kses_post' );
			}
		}

		if ( isset( $GLOBALS['wp_embed'] ) ) {
			add_filter( 'term_description', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
			add_filter( 'term_description', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
		}

		add_filter( 'term_description', 'wptexturize' );
		add_filter( 'term_description', 'convert_smilies' );
		add_filter( 'term_description', 'convert_chars' );
		add_filter( 'term_description', 'wpautop' );
		add_filter( 'term_description', 'shortcode_unautop' );
		add_filter( 'term_description', 'do_shortcode', 11);

		foreach ( $this->taxonomies as $taxonomy ) {
			add_action( $taxonomy . '_edit_form_fields', array( $this, 'render_editor_edit' ), 1, 2 );
			add_action( $taxonomy . '_add_form_fields', array( $this, 'render_editor_add' ), 1, 1 );
		}
	}

	/*
	 * Editor "bearbeiten"
	 */
	public function render_editor_edit( $tag, $taxonomy ) {
		$settings = array(
			'textarea_name' => 'description',
			'textarea_rows' => 10,
		);

		?>
		<tr class="form-field term-description-wrap at-term-description">
			<th scope="row" valign="top"><label for="description"><?php _e( 'Beschreibung', 'affiliatetheme-backend' ); ?></label></th>
			<td><?php wp_editor( htmlspecialchars_decode( $tag->description ), 'html-description', $settings ); ?>
				<p class="description"><?php _e( 'Die Beschreibung wird oberhalb der Produktauflistung angezeigt. Wenn du einen Text darunter anzeigen willst, dann nutze den unteren Editor (Erweritere Beschreibung)', 'affiliatetheme-backend' ); ?></p></td>
			<script type="text/javascript">
				jQuery( 'textarea#description' ).closest( '.form-field' ).remove();
			</script>
		</tr>
		<?php
	}

	/*
	 * Editor "hinzufügen"
	 */
	public function render_editor_add( $taxonomy ) {
		$settings = array(
			'textarea_name' => 'description',
			'textarea_rows' => 7,
		);

		?>
		<div class="form-field term-description-wrap at-term-description">
			<label for="tag-description"><?php _ex( 'Beschreibung', 'affiliatetheme-backend' ); ?></label>
			<?php wp_editor( '', 'html-tag-description', $settings ); ?>
			<p><?php _e( 'Die Beschreibung wird oberhalb der Produktauflistung angezeigt. Wenn du einen Text darunter anzeigen willst, dann nutze den unteren Editor (Erweritere Beschreibung)', 'affiliatetheme-backend' ); ?></p>

			<script type="text/javascript">
				jQuery( 'textarea#tag-description' ).closest( '.form-field' ).remove();

				jQuery(function() {
					jQuery( '#addtag' ).on( 'mousedown', '#submit', function() {
						tinyMCE.triggerSave();
					});
				});
			</script>
		</div>
		<?php
	}
}

/*
 * Editor ausführen
 */
add_action( 'wp_loaded', 'at_term_description_editor', 999 );
function at_term_description_editor() {
	$taxonomies = get_taxonomies( '', 'names' );
	$taxonomies = apply_filters( 'at_term_description_taxonomies', $taxonomies );

	$plugin = new AT_Term_Description_Editor( $taxonomies );
	$plugin->execute();

	add_filter( 'at_term_description_editor', $plugin );
}