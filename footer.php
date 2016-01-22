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
						<a href="<?php echo home_url(); ?>/privacy-policy">Privacy Policy</a>
					</nav>
				</div>

			</footer>

		</div>

		<script src="http://libs.cartocdn.com/cartodb.js/v3/3.15/cartodb.js"></script>
		<script type="text/javascript">
		// set current section if any
		var checkUrl = function() {
			if 		 (location.pathname.includes('/about')) document.getElementById('menu-option-about').classList.add("current");
			else if  (location.pathname.includes('/project')) document.getElementById('menu-option-projects').classList.add("current");
			else if  (location.pathname.includes('/news')) document.getElementById('menu-option-news').classList.add("current");
			else if  (location.pathname.includes('/resources')) document.getElementById('menu-option-resources').classList.add("current");
		}
		checkUrl();
		</script>
		<script type="infowindow/html" id="infowindow_template">
		  <div class="cartodb-popup v2">
		    <a href="#close" class="cartodb-popup-close-button close">x</a>
		     <div class="cartodb-popup-content-wrapper">
		       <div class="cartodb-popup-header">
		         <h1>{{content.data.name}}</h1>
		       </div>
		       <div class="cartodb-popup-content">
		         <!-- content.data contains the field info -->
		         <p>{{content.data.description}}</p>
		         <p class="meta">{{content.data.country_name}} | {{content.data.pillar}}</p>
		     	<span class="popup-link-project"><a href="<? echo home_url(); ?>/project/{{content.data.url}}">VIEW PROJECT</a></span>
		       </div>
		     </div>
		     <div class="cartodb-popup-tip-container">
		     </div>
		  </div>
		</script>
		<script>
			var createLabelIcon = function(labelClass,labelText){
			  return L.divIcon({ 
			    className: labelClass,
			    html: labelText
			  })
			}
  
			var map;
		    function init(){
				if ( !!LAT_VIS && !!LONG_VIS ) {
					map = new L.Map('map', {
						center : [LAT_VIS,LONG_VIS],
						zoom: 6,
						zoomControl: false
					})
				} else {
					map = new L.Map('map', { 
			        center: [20,0],
			        zoom: 2,
			        zoomControl: false
			      })
				}
				L.control.zoom({
				     position:'topright'
				}).addTo(map);
				var basemap = 'https://a.tiles.mapbox.com/v4/opendri.0ouhqxkv/{z}/{x}/{y}.png?access_token=pk.eyJ1Ijoib3BlbmRyaSIsImEiOiJjaWpvZjcwbTYwMHVldG9tNXlhajMwb2dyIn0.fWimK0QhrBpQVX5Zu2bWNg';
				if (window.matchMedia("(-webkit-device-pixel-ratio: 2)").matches) {
				  basemap = 'https://a.tiles.mapbox.com/v4/opendri.0ouhqxkv/{z}/{x}/{y}@2x.png?access_token=pk.eyJ1Ijoib3BlbmRyaSIsImEiOiJjaWpvZjcwbTYwMHVldG9tNXlhajMwb2dyIn0.fWimK0QhrBpQVX5Zu2bWNg';
				}
				L.tileLayer(basemap, {
				}).addTo(map);
				<? 
					$postsInall = get_term_by('slug','non-wb-countries','category');
					$postsInall = $postsInall->count;
				?>
				var postsInall = '<? echo $postsInall ?>';
				L.marker(new L.LatLng(0, 0), {icon:createLabelIcon("textLabelclass",postsInall)}).addTo(map);

				<? 
					$postsInAfrica = get_term_by('slug','africa','category');
					$postsInAfrica = $postsInAfrica->count;
				?>
				var postsInAfrica = '<? echo $postsInAfrica ?>';
				L.marker(new L.LatLng(21, 7), {icon:createLabelIcon("textLabelclass",postsInAfrica)}).addTo(map);

				<? 
					$postsIneastasia = get_term_by('slug','east-asia-pacific','category');
					$postsIneastasia = $postsIneastasia->count;
				?>
				var postsIneastasia = '<? echo $postsIneastasia ?>';
				L.marker(new L.LatLng(103, 35), {icon:createLabelIcon("textLabelclass",postsIneastasia)}).addTo(map);

				<? 
					$postsInEurope = get_term_by('slug','europe-and-central-asia','category');
					$postsInEurope = $postsInEurope->count;
				?>
				var postsInEurope = '<? echo $postsInEurope ?>';
				L.marker(new L.LatLng(25, 55), {icon:createLabelIcon("textLabelclass",postsInEurope)}).addTo(map);

				<? 
					$postsInlatam = get_term_by('slug','latin-america-and-caribbean','category');
					$postsInlatam = $postsInlatam->count;
				?>
				var postsInlatam = '<? echo $postsInlatam ?>';			
				L.marker(new L.LatLng(-59, 13), {icon:createLabelIcon("textLabelclass",postsInlatam)}).addTo(map);

				<? 
					$postsInmiddleeast = get_term_by('slug','middle-east-and-north-africa','category','category');
					$postsInmiddleeast = $postsInmiddleeast->count;
				?>
				var postsInmiddleeast = '<? echo $postsInmiddleeast ?>';
				L.marker(new L.LatLng(41, 29), {icon:createLabelIcon("textLabelclass",postsInmiddleeast)}).addTo(map);

				<? 
					$postsInsouthasia = get_term_by('slug','south-asia','category','category');
					$postsInsouthasia = $postsInsouthasia->count;
				?>
				var postsInsouthasia = '<? echo $postsInsouthasia ?>';			
				L.marker(new L.LatLng(72, 27), {icon:createLabelIcon("textLabelclass","<? echo $postsInsouthasia; ?>")}).addTo(map);
				var query 		  = "SELECT * FROM wp_projects",
					queryTemplate = query + " WHERE region = ";
					queryTPillar  = query + " WHERE pillar like "
					visible 	  = ' AND visible = true'
				var layerUrl = 'https://opendri.cartodb.com/api/v2/viz/0e130a1a-c068-11e5-a22c-0ecd1babdde5/viz.json';
				var sublayers = [];
				cartodb.createLayer(map, layerUrl)
				.addTo(map)
				.on('done', function(layer) {
				    // change the query for the first layer
				    var subLayerOptions = {
				      sql: "SELECT * FROM wp_projects where is_region = true",
				      cartocss: "#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 50;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}"
				    }

				    var sublayer = layer.getSubLayer(0);

				    sublayer.set(subLayerOptions);

				    sublayers.push(sublayer);
				    sublayer.infowindow.set('template', $('#infowindow_template').html());
				    sublayer.on('featureClick', function(e, latlng, pos, data, subLayerIndex) {
				    	changeIn_regions(data.cartodb_id);
				    });
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
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'africa'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				  eastasia: function(){
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'eastasia'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				  europe: function(){
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'europe'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				  latam: function(){
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'latam'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				  middleeast: function(){
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'middleeast'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },			
				  nonwp: function(){
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'nonwp'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },	
				  southasia: function(){
				    sublayers[0].setSQL( " SELECT * FROM wp_projects WHERE region = 'southasia'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				  open: function(){
				    sublayers[0].setSQL( "SELECT * FROM wp_projects WHERE pillar like '%open data platforms%'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				  community: function(){
				    sublayers[0].setSQL( "SELECT * FROM wp_projects WHERE pillar like '%community mapping%'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },		
				  risk: function(){
				    sublayers[0].setSQL( "SELECT * FROM wp_projects WHERE pillar like '%risk visualization%'" + visible);
				    sublayers[0].setCartoCSS("#wp_projects{  marker-fill-opacity: 0.9;  marker-line-color: #FFF;  marker-line-width: 2;  marker-line-opacity: 1;  marker-placement: point;  marker-type: ellipse;  marker-width: 10;  marker-fill: #FFFFFF;  marker-allow-overlap: true;}");
				    return true;
				  },
				}
				jsonValues = JSON.parse(jsonValues);
				$('#pick-region').on('click', '.pickable', function(option) {
					$(this).siblings().removeClass('selected');
					if (!! $(this).hasClass('selected')) {
						var option 	= 'all';
						var latlong = [40,-98];
						var text 	= 'filter by region';
						var classe  = 'title';
						var title 	= 'Projects';
					} else {
				    	$(this).addClass('selected');
				    	var option  = $(this).data('option');
				    	var latlong = [$(this).data('lat'), $(this).data('lng')];
				    	var text 	= $(this).text();
						var classe  = '';
						var prjsn	= (~~jsonValues[option] > 0)? ~~jsonValues[option] : 0;
						var title   = text + ': ' + prjsn.toString() + ' projects';
					}
					$(this).parent().fadeOut();
					$('#toggle-filter-region').removeClass('title').addClass(classe).text(text);
					$('.page-title').text(title).css('text-transform','capitalize');
				    LayerActions[option]();
				    map.panTo(latlong);
				});
				$('#blue-bar-pick-pillar').on('click', '.option-pillar', function(){
					LayerActions[$(this).data('option')]();
				});

				var changeIn_regions = function(id) {
					if (id < 31 || id > 37) return false;
					$('.cartodb-infowindow').hide();
					var $regions = $('#pick-region');
					if (id === 31) $regions.find('[data-option="africa"]').trigger('click');
					else if (id === 32) $regions.find('[data-option="eastasia"]').trigger('click');
					else if (id === 33) $regions.find('[data-option="europe"]').trigger('click');
					else if (id === 34) $regions.find('[data-option="latam"]').trigger('click');
					else if (id === 35) $regions.find('[data-option="middleeast"]').trigger('click');
					else if (id === 36) $regions.find('[data-option="all"]').trigger('click');
					else $regions.find('[data-option="southasia"]').trigger('click');
					return false;
				}
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
