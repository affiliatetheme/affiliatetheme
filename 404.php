<?php get_header(); ?>

<div id="main" class="<?php echo at_get_section_layout_class( 'content' ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
				<div id="content">
					<h1><?php _e( 'Seite nicht gefunden', 'affiliatetheme' ); ?></h1>
					<p><?php _e( 'Es scheint so, als würde die Seite nicht existieren. Vielleicht hilft die Suche?', 'affiliatetheme' ); ?></p>
					<?php get_search_form(); ?>

					<?php if ( is_user_logged_in() ) { ?>
						<div class="alert alert-info" style="margin-top:30px;">
							<p class="h4"><?php _e( 'Hinweis für Administrator', 'affiliatetheme' ); ?></p>
							<p><?php _e( 'Solltest du vermehrt 404-Fehler bekommen, hilft es die Permalinks unter <strong>Einstellungen</strong> - <strong>Permalinks</strong> neu zu speichern.', 'affiliatetheme' ); ?></p>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
