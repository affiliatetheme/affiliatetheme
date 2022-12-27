<?php

$product_fields = new AT_Product_Fields( get_the_ID(), 'productdata' );
$fields         = $product_fields->get();

if ( $fields ) { ?>
	<table class="table table-details table-productdata table-condensed">
		<?php
		/*
		 * Felder
		 */
		if ( $fields ) {
			foreach ( $fields as $k => $v ) {
				$product_field = new AT_Product_Field( $v, get_the_ID() );
				$field         = $product_field->render();

				if ( ! $product_field->is_empty() ) {
					echo '<tr>';
					echo '<td>' . $field['label'] . '</td>';
					echo '<td>' . $field['value'] . '</td>';
					echo '</tr>';
				}
			}
		}
		?>
	</table>
<?php } ?>