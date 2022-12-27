<?php

$chart = at_price_trend_chart_data( get_the_ID() );
if ( $chart && ! empty( $chart['datasets'] ) ) {
	?>
	<div class="product-price_trend" id="price-trend">
		<?php if ( at_show_price_trend( get_the_ID(), 'bottom' ) ) { ?>
			<p class="h2"><?php _e( 'Preisverlauf', 'affiliatetheme' ); ?></p>
		<?php } ?>
		<div style="width:100%;">
			<canvas id="canvas"></canvas>
		</div>
	</div>

	<script type="text/javascript">
		var options = {
			tooltips: {
				callbacks: {
					label: function (tooltipItem, data) {
						var datasetLabel = data.datasets[tooltipItem.datasetIndex].label;
						var value        = tooltipItem.yLabel;
						return datasetLabel + ': ' + value + ' €';
					}
				}
			}
		};

		var data              = {
			<?php
			if($chart['labels']) { ?>
			labels: ["<?= implode( '","', $chart['labels'] ); ?>"],
			<?php
			}

			if($chart['datasets']) {
			$i = 0;
			?>
			datasets: [
				<?php
				foreach($chart['datasets'] as $k => $v) {
				if ( $i != 0 ) echo ',';

				$data = array();
				foreach ( $v as $item ) {
					$data[] = $item['price'];
				}

				// define colors
				$colors = array(
					'backgroundColor'       => 'rgba(159, 162, 165, 0.15)', // #9fa2a5
					'borderColor'           => 'rgba(159, 162, 165, 1)', // #9fa2a5
					'pointBorderColor'      => 'rgba(159, 162, 165, 1)', // #9fa2a5
					'pointHoverBorderColor' => 'rgba(159, 162, 165, 1)' // #9fa2a5
				);

				// get shop color and overwirte, if exists
				$shop_color = get_field( 'shop_price_trend_color', $k );
				if ( $shop_color ) {
					$shop_color_rgb = at_hex2rgb( $shop_color );
					if ( $shop_color_rgb ) {
						$colors = array(
							'backgroundColor'       => 'rgba(' . $shop_color_rgb . ', 0.15)',
							'borderColor'           => 'rgba(' . $shop_color_rgb . ', 1)',
							'pointBorderColor'      => 'rgba(' . $shop_color_rgb . ', 1)',
							'pointHoverBorderColor' => 'rgba(' . $shop_color_rgb . ', 1)'
						);
					}
				}
				?>
				{
					label           : "<?= get_the_title( $k ); ?>",
					fill            : false,
					lineTension     : 0,
					backgroundColor : "<?= $colors['backgroundColor']; ?>",
					borderColor     : "<?= $colors['borderColor']; ?>",
					borderCapStyle  : 'butt',
					borderDash      : [],
					borderDashOffset: 0.0,
					borderJoinStyle : 'miter',

					pointRadius         : 4,
					pointBorderColor    : "<?= $colors['pointBorderColor']; ?>",
					pointBackgroundColor: "#fff",
					pointBorderWidth    : 2,

					pointHoverRadius         : 5,
					pointHoverBorderColor    : "<?= $colors['pointHoverBorderColor']; ?>",
					pointHoverBackgroundColor: "#fff",
					pointHoverBorderWidth    : 2,

					pointHitRadius: 10,
					data          : [<?= implode( ',', $data ); ?>],
					spanGaps      : false
				}
				<?php
				$i++;
				}
				?>
			]
			<?php
			}
			?>
		};
		var ProductPriceTrend = document.getElementById("canvas").getContext("2d");
		var Chart             = new Chart(ProductPriceTrend, {type: 'line', data: data, options: options});
	</script>
	<?php
} ?>