<!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>

 <script src="assets/js/leaflet-panel-layers-master/src/leaflet-panel-layers.js"></script>
 <script src="assets/js/leaflet.ajax.js"></script>

  <script type="text/javascript">

   	var map = L.map('mapid').setView([10.8068724, 106.7490189], 12);

	var myStyle2 = {
	    "color": "#ffff00",
	    "weight": 1,
	    "opacity": 0.9
	};

	function popUp(f,l){
	    var out = [];
	    if (f.properties){
	        // for(key in f.properties){
	        // 	console.log(key);

	        // }
			// out.push("Loại đất: "+f.properties['PROVINSI']);
			out.push("Mã đất: "+f.properties['MaDat']);
			// out.push("Diện tích phủ: "+f.properties['KECAMATAN']);
	        l.bindPopup(out.join("<br />"));
	    }
	}

	// legend

	function iconByName(name) {
		return '<i class="icon" style="background-color:'+name+';border-radius:50%"></i>';
	}

	function featureToMarker(feature, latlng) {
		return L.marker(latlng, {
			icon: L.divIcon({
				className: 'marker-'+feature.properties.amenity,
				html: iconByName(feature.properties.amenity),
				iconUrl: '../images/markers/'+feature.properties.amenity+'.png',
				iconSize: [25, 41],
				iconAnchor: [12, 41],
				popupAnchor: [1, -34],
				shadowSize: [41, 41]
			})
		});
	}

	var googleSatellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        zIndex: 100,
    });
	var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        zIndex: 100,
    });
	map.addLayer(googleStreets);
	var baseLayers = [
		{
			name: "Google Satellite",
			layer: googleSatellite
		},
		{	
			name: "Google Map",
			layer: googleStreets
		}
	];

	<?php
		// $getKecamatan=$db->ObjectBuilder()->where('year', 2019, '=')->get('m_kecamatan');
		$getKecamatan=$db->ObjectBuilder()->get('m_kecamatan');
		// print_r($getKecamatan);
		// die();
		foreach ($getKecamatan as $row) {
	?>
			
			var myStyle<?=$row->id_polygon?> = {
					"fillColor": "<?=$row->color?>",
			    "color": "black",
			    "weight": 0.5,
			    "opacity": 1,
			    "fillOpacity": 0.7,
			};

	<?php
			if($row->year == '2015'){
				$arrayKec[]='{
				name: "'.$row->MaDat.'",
				icon: iconByName("'.$row->color.'"),
				layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row->geojson_polygon.'"],{onEachFeature:popUp,style: myStyle'.$row->id_polygon.',pointToLayer: featureToMarker }).addTo(map)
				}';
			}
			if ($row->year == '2010') {
				$arrayKec1[]='{
				name: "'.$row->MaDat.'",
				icon: iconByName("'.$row->color.'"),
				layer: new L.GeoJSON.AJAX(["assets/unggah/geojson/'.$row->geojson_polygon.'"],{onEachFeature:popUp,style: myStyle'.$row->id_polygon.',pointToLayer: featureToMarker }).addTo(map)
				}';
			}
		}
	?>
	 // <input id='toggleAll' type='checkbox'>
	var overLayers = [
	{
		group: "Mã Đất 2015",
		layers: [
			<?=implode(',', $arrayKec);?>
		]
	},
	{
		group: "Mã Đất 2010",
		layers: [
			<?=implode(',', $arrayKec1);?>
		]
	}
	
	];

	var panelLayers = new L.Control.PanelLayers(baseLayers, overLayers,{
		collapsibleGroups: true
	});

	map.addControl(panelLayers);

	// // Lấy ra element DOM của PanelLayers
	// var panelLayersContainer = overLayers.getContainer();

	// // Thêm class mới cho element DOM của PanelLayers
	// panelLayersContainer.classList.add('my-custom-class');

	// // Lấy overlays (lớp chồng lên) từ PanelLayers
	// var overlays = panelLayers._layersLink.getElementsByClassName('leaflet-panel-layers-selector');

	// if (overlays.length > 0) {
	//     // Lấy ra tất cả các checkbox trong overlays
	//     var checkboxes = overlays[0].querySelectorAll('input[type="checkbox"]');
	    
	//     // Thêm class mới cho các checkbox
	//     checkboxes.forEach(function(checkbox) {
	//         checkbox.classList.add('my-checkbox-class');
	//     });
	// }

  </script>