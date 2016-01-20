			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
				<div id="inner-footer" class="wrap cf">
					<div class="-ft-content">
						<div class="-ft-coorporate">
							<div class="-ft-logo">
								An initiative of <a href="https://www.gfdrr.org/" title="The Global Facility for Disaster Reduction and Recovery website"><img src="<?php echo get_template_directory_uri(); ?>/gfdrr-logo.png" alt="The Global Facility for Disaster Reduction and Recovery logo"></a>
							</div>
							<div class="-ft-newsletter">
								Sign up for our newsletter: <input type="email" placeholder="your.email@here">
							</div>
						</div>
						<nav>
							<a href="<?php echo home_url(); ?>/project" class="-i-link">projects</a>
							<a href="<?php echo home_url(); ?>/resources" class="-i-link">resources</a>
							<a href="<?php echo home_url(); ?>/about" class="-i-link">about</a>
							<a href="<?php echo home_url(); ?>/category/news" class="-i-link">news</a>
						</nav>
					</div>
					<p class="source-org copyright">
						<span class="hr"></span>
					</p>
					<nav class="-ft-legal">
						<span>&copy; <?php echo date('Y'); ?> Copyright Open DRI</span>
						<a href="#">Privacy Policy</a>
						<a href="#">Site</a>
					</nav>
				</div>

			</footer>

		</div>

		<script src="http://libs.cartocdn.com/cartodb.js/v3/3.15/cartodb.js"></script>
		<script>
			var map;
		    function init(){
				if ( !!LAT_VIS && !!LONG_VIS ) {
					map = new L.Map('map', {
						center : [LAT_VIS,LONG_VIS],
						zoom: 6
					})
				} else {
					map = new L.Map('map', { 
			        center: [40,-98],
			        zoom: 3
			      })
				}
				var basemap = 'https://cartocdn_{s}.global.ssl.fastly.net/base-flatblue/{z}/{x}/{y}.png';
				if (window.matchMedia("(-webkit-device-pixel-ratio: 2)").matches) {
				  basemap = 'https://cartocdn_{s}.global.ssl.fastly.net/base-flatblue/{z}/{x}/{y}@2x.png';
				}
				L.tileLayer(basemap, {
					attribution: '&copy; <a href="http://cartodb.com/attributions">CartoDB</a>'
				}).addTo(map);

				var query 		  = "SELECT * FROM wp_projects",
					queryTemplate = query + " WHERE region = ";
				var layerUrl = 'https://opendri.cartodb.com/api/v2/viz/2a76c010-badd-11e5-9ed5-0ecd1babdde5/viz.json';
				var sublayers = [];
				cartodb.createLayer(map, layerUrl)
				.addTo(map)
				.on('done', function(layer) {
				    // change the query for the first layer
				    var subLayerOptions = {
				      sql: "SELECT * FROM wp_projects",
				    }

				    var sublayer = layer.getSubLayer(0);

				    sublayer.set(subLayerOptions);

				    sublayers.push(sublayer);
				  }).on('error', function() {
				    console.error('Error while loading map. Please check footer file')
				  });
				// end map
				var LayerActions = {
				  all: function(){
				    sublayers[0].setSQL("SELECT * FROM wp_projects");
				    return true;
				  },
				  africa: function(){
				    sublayers[0].setSQL( queryTemplate += "'africa'");
				    return true;
				  },
				  eastasia: function(){
				    sublayers[0].setSQL( queryTemplate += "'eastasia'");
				    return true;
				  },
				  europe: function(){
				    sublayers[0].setSQL( queryTemplate += "'europe'");
				    return true;
				  },
				  middleeast: function(){
				    sublayers[0].setSQL( queryTemplate += "'middleeast'");
				    return true;
				  },			
				  nonwp: function(){
				    sublayers[0].setSQL( queryTemplate += "'nonwp'");
				    return true;
				  },	
				  southasia: function(){
				    sublayers[0].setSQL( queryTemplate += "'southasia'");
				    return true;
				  },				  			  	  				  
				}
				$('#pick-region').on('click', '.pickable', function() {
					$(this).siblings().removeClass('selected');
					if (!! $(this).hasClass('selected')) {
						var option = 'all';
					} else {
				    	$(this).addClass('selected');
				    	var option = $(this).data('option');
					}
				    //this gets the id of the different buttons and calls to LayerActions which responds according to the selected id
				    LayerActions[option]();
				  });
			}
			window.onload = function() {
			  init();
			};
			// Twitter
			!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			window.setTimeout(
			function(){
			  $(".twitter-timeline").contents().find('.stream').attr("style", "overflow-y: visible !important; height: 100%");
			},5000);
		</script>
		<?php wp_footer(); ?>
		<script type="text/javascript">
			var $input   = $('#searchODRI'),
				$s_input = $('.search-input');

			$s_input.on('click', function(e) {
			    e.preventDefault();
			    e.stopPropagation();
			    $input.addClass('visible').focus();
			    $(document).one('click', function closeMenu (e){
			        if($s_input.has(e.target).length === 0){
			             $input.removeClass('visible');
			        } else {
			            $(document).one('click', closeMenu);
			        }
			    });
			}).on('keyup', function(e){
				if(e.keyCode == 13)
			    	location = location.pathname + '?s=' + $input.val();
			});


			var $bar = $('#blue-bar');
			if ($bar.hasClass('about')) {			
				var top_principles = $("#principles").offset().top || null,
					top_contact	   = $('#contact').offset().top,
					top_more	   = $('#more-content').offset().top,
					top_partners   = $('#partners').offset().top,
					top_members	   = $('#members').offset().top;
			}
			$(document).scroll(function() {
				var scroll = $(this).scrollTop();
				if (scroll > 80) {
					$bar.addClass("fixed");
				} else {
					$bar.removeClass("fixed");
				}
				if (!! top_principles) {
					var tab_option = 5;
					scroll += 80;
					if (scroll > top_principles) tab_option = 0;
					if (scroll > top_contact) 	 tab_option = 1;
					if (scroll > top_more) 	 	 tab_option = 2;
					if (scroll > top_partners) 	 tab_option = 3;
					if (scroll > top_members) 	 tab_option = 4;

					if (tab_option < 5) {
						$bar.find('.current').removeClass('current');
						$bar.find('.wrapper span')[tab_option].classList.add("current");
					}
				}
			});
			$bar.on('click', 'span',function(e) {
				$bar.find('.current').removeClass('current');
				$(e.target).closest('span').addClass('current');
			});
			$('#toggle-filter-region').on('click', function(e){
				$bar.find('.region-filter').toggle();
			});
		</script>

	</body>

</html> <!-- end of site. what a ride! -->
