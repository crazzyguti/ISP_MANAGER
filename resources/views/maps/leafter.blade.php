@extends('layouts.client')

@section('title', 'leafter')

@section('css')
<script src="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v1.9.1/mapbox-gl.css" rel="stylesheet" />

<style>
    #mapid {
        height: 180px;
        position: relative;
        top: 0;
        bottom: 0;
        width: 100%;
    }

    .coordinates {
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        position: absolute;
        bottom: 40px;
        left: 10px;
        padding: 5px 10px;
        margin: 0;
        font-size: 11px;
        line-height: 18px;
        border-radius: 3px;
        opacity: 0.5;
        display: none;
    }

    .marker {
        display: block;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        padding: 0;
    }
</style>
@endsection

@section('sidebar')
@parent
@endsection
@section('content')
<div id="map" style="width: 600px; height: 400px;"></div>
<pre id="coordinates" class="coordinates"></pre>

<div class="form-group">
    <label for="mapStyles">Map Styles</label>
    <select class="custom-select" name="mapStyles" id="mapStyles">
        <option selected>Select one</option>
        <option value="streets-v11">streets-v11</option>
        <option value="outdoors-v11">outdoors-v11</option>
        <option value="light-v10">light-v10</option>
        <option value="satellite-v9">satellite-v9</option>
        <option value="satellite-streets-v11">satellite-streets-v11</option>
        <option value="navigation-preview-day-v4">navigation-preview-day-v4</option>
        <option value="navigation-preview-night-v4">navigation-preview-night-v4</option>
        <option value="navigation-guidance-day-v4">navigation-guidance-day-v4</option>
        <option value="navigation-guidance-day-v4">navigation-preview-night-v4</option>
    </select>

</div>


@section('script')


<script>
    mapboxgl.accessToken = `{{env('mapboxApiKey')}}`;


    let center = [27.52760553742891, 42.696428];
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/satellite-streets-v11',
        center,
        zoom: 15
    });

    var size = 200;

    // implementation of CustomLayerInterface to draw a pulsing dot icon on the map
    // see https://docs.mapbox.com/mapbox-gl-js/api/#customlayerinterface for more info
    var pulsingDot = {
        width: size,
        height: size,
        data: new Uint8Array(size * size * 4),

        // get rendering context for the map canvas when layer is added to the map
        onAdd: function () {
            var canvas = document.createElement('canvas');
            canvas.width = this.width;
            canvas.height = this.height;
            this.context = canvas.getContext('2d');
        },

        // called once before every frame where the icon will be used
        render: function () {
            var duration = 1000;
            var t = (performance.now() % duration) / duration;

            var radius = (size / 2) * 0.3;
            var outerRadius = (size / 2) * 0.7 * t + radius;
            var context = this.context;

            // draw outer circle
            context.clearRect(0, 0, this.width, this.height);
            context.beginPath();
            context.arc(
                this.width / 2,
                this.height / 2,
                outerRadius,
                0,
                Math.PI * 2
            );
            context.fillStyle = 'rgba(255, 200, 200,' + (1 - t) + ')';
            context.fill();

            // draw inner circle
            context.beginPath();
            context.arc(
                this.width / 2,
                this.height / 2,
                radius,
                0,
                Math.PI * 2
            );
            context.fillStyle = 'rgba(255, 100, 100, 1)';
            context.strokeStyle = 'white';
            context.lineWidth = 2 + 4 * (1 - t);
            context.fill();
            context.stroke();

            // update this image's data with data from the canvas
            this.data = context.getImageData(
                0,
                0,
                this.width,
                this.height
            ).data;

            // continuously repaint the map, resulting in the smooth animation of the dot
            map.triggerRepaint();

            // return `true` to let the map know that the image was updated
            return true;
        }
    };

    map.on('load', function () {


        map.addImage('pulsing-dot', pulsingDot, {
            pixelRatio: 2
        });



        map.addSource('signal', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': [{
                    'type': 'Feature',
                    'geometry': {
                        'type': 'Point',
                        'coordinates': center
                    }
                }]
            }
        });
        map.addLayer({
            'id': 'signal',
            'type': 'symbol',
            'source': 'signal',
            'layout': {
                'icon-image': 'pulsing-dot'
            }
        });

        map.loadImage(
            `{{asset('images/user_online.png')}}`,
            function (error, image) {
                if (error) throw error;
                map.addImage('cat', image);
                map.addSource('point', {
                    'type': 'geojson',
                    'data': {
                        'type': 'FeatureCollection',
                        'features': [{
                            'type': 'Feature',
                            'geometry': {
                                'type': 'Point',
                                'coordinates': [27.53095196628101, 42.697456216702506]
                            }
                        }]
                    }
                });
                map.addLayer({
                    'id': 'points',
                    'type': 'symbol',
                    'source': 'point',
                    'layout': {
                        'icon-image': 'cat',
                        'icon-size': 0.1
                    }
                });
            }
        );



        var geojson = {
            'type': 'FeatureCollection',
            'features': [{

                'type': 'Feature',
                'properties': {
                    'message': 'Foo',
                    'iconSize': [60, 60]
                },
                'description': '',
                'geometry': {
                    'type': 'Point',
                    'coordinates': [27.53095196628101, 42.697456216702506]
                }
            }]
        };

        let bgImage = `{{asset('images/user_online.png')}}`;

        // add markers to map
        geojson.features.forEach(function (marker) {
            // create a DOM element for the marker
            var el = document.createElement('div');
            el.className = 'marker';
            el.style.backgroundImage = `url('${bgImage}')`;


            el.style.width = marker.properties.iconSize[0] + 'px';
            el.style.height = marker.properties.iconSize[1] + 'px';

            el.addEventListener('click', function () {
                // window.alert(marker.properties.message);
            });

            // create the popup
            var popup = new mapboxgl.Popup({
                offset: 25
            }).setHTML(
                ` <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <b class="card-title">Username</b>
                    <p class="card-text">${marker.description}</p>
                </div>
            </div>
        </div>`
            );
            // add marker to map
            new mapboxgl.Marker(el)
                .setLngLat(marker.geometry.coordinates)
                .setPopup(popup)
                .addTo(map);
        });

    });

    // create DOM element for the marker
    var el = document.createElement('div');
    el.id = 'marker';

    // create the popup
    var popup = new mapboxgl.Popup({
        offset: 25
    }).setHTML(
        ` <div class="card-deck">
            <div class="card">
                <img class="card-img-top" src="holder.js/100x180/" alt="">
                <div class="card-body">
                    <h4 class="card-title">Username</h4>
                    <p class="card-text">Text</p>
                </div>
            </div>
        </div>`
    );


    var marker = new mapboxgl.Marker({
        draggable: true
    }).setLngLat(center).setPopup(popup).addTo(map);

    function onDragEnd() {
        var lngLat = marker.getLngLat();
        coordinates.style.display = 'block';
        coordinates.innerHTML = 'Longitude: ' + lngLat.lng + '<br />Latitude: ' + lngLat.lat;
    }

    marker.on('dragend', onDragEnd);

    mapStyles.addEventListener("input", (e) => {
        map.setStyle('mapbox://styles/mapbox/' + e.target.value);
    });



    const copyToClipboard = str => {
        const el = document.createElement('textarea');
        el.value = str;
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };

    coordinates.addEventListener("click", e => {
        let lngLat = marker.getLngLat();
        let clip = `[${lngLat.lng} , ${lngLat.lat}]`;
        copyToClipboard(clip);
        e.target.style = "background-color:Chartreuse;color:black"
    })
</script>
@endsection
@endsection
