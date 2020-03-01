let map;
let markersArray = [];
let service;

let infowindow;
let labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
let labelIndex = 0;
const localelist = document.querySelector("#localelist");
const dropContainer = document.querySelector('#drop-container');


//gaberovo 42.697512, 27.530795
// Ruen 42.7985709,27.2829266,290
// center: sydney,
function initMap() {
    let m_app = document.querySelector("#m_app");
    let gaberovo = new google.maps.LatLng(42.7985709,27.2829266);
    let mapOption = {
        center: gaberovo,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.HYBRID,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        scaleControl: true,
        streetViewControl: false,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.LEFT_TOP
        },
        fullscreenControl: true
    }

    map = new google.maps.Map(m_app, mapOption);

    autocomplete = new google.maps.places.Autocomplete(SearchPlace);
    autocomplete.bindTo('bounds', map);

    getMarkers()

}

function findLocale(name = "Gaberovo") {

    let request = {
        query: name,
        fields: ['ALL'],
    };

    service = new google.maps.places.PlacesService(map);

    service.findPlaceFromQuery(request, (results, status) => {
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            results.forEach((item) => {
                //createMarker(item);
            });
            map.setCenter(results[0].geometry.location);
        }
    });

}


function createMarker(place) {
    url = "{{asset('images/markers/home.png')}}";
    let marker = new google.maps.Marker({
        map,
        position: place.geometry.location,
        icon: {
            url,
            scaledSize: new google.maps.Size(38, 38)
        },
        draggable: false
    });

    infowindow = new google.maps.InfoWindow();



    marker.addListener('click', function (e) {
        infowindow.setContent(place.name);
        infowindow.open(map, this);
        map.setZoom(18);
        map.setCenter(marker.getPosition());
    });


}

function addMarker(latLng) {
    url = "{{asset('images/users/Person.png')}}";

    let marker = new google.maps.Marker({
        map,
        position: latLng,
        title: 'Click to zoom',
        icon: {
            url,
            scaledSize: new google.maps.Size(38, 38)
        },
        animation: google.maps.Animation.DROP,
        draggable: true,
    });

    infowindow = new google.maps.InfoWindow();

    // let table = `<table>
    //     <thead>
    //         <tr>
    //             <th>id</th>
    //             <th>FullName</th>
    //             <th>qqq</th>
    //         </tr>
    //     </thead>
    //     <tbody>
    //         <tr>
    //             <td>we</td>
    //             <td>bb</td>
    //             <td>we</td>
    //         </tr>
    //     </tbody>
    // </table>`;

    let table = `<span class="context-menu-one btn btn-neutral">right click me</span>`;

    marker.addListener('click', function (e) {
        //console.log(e);
        //infowindow.setContent(table);
        //infowindow.open(map, this);
        map.setZoom(18);
        map.setCenter(marker.getPosition());

    });

}


function loadGeoJsonString(geoString) {
    let geojson = JSON.parse(geoString);
    map.data.addGeoJson(geojson);
    zoom(map);
}

/**
 * Update a map's viewport to fit each geometry in a dataset
 * @param {google.maps.Map} map The map to adjust
 */
function zoom(map) {
    let bounds = new google.maps.LatLngBounds();
    map.data.forEach(function (feature) {
        processPoints(feature.getGeometry(), bounds.extend, bounds);
    });
    map.fitBounds(bounds);
}

/**
 * Process each point in a Geometry, regardless of how deep the points may lie.
 * @param {google.maps.Data.Geometry} geometry The structure to process
 * @param {function(google.maps.LatLng)} callback A function to call on each
 *     LatLng point encountered (e.g. Array.push)
 * @param {Object} thisArg The value of 'this' as provided to 'callback' (e.g.
 *     myArray)
 */
function processPoints(geometry, callback, thisArg) {
    if (geometry instanceof google.maps.LatLng) {
        callback.call(thisArg, geometry);
    } else if (geometry instanceof google.maps.Data.Point) {
        callback.call(thisArg, geometry.get());
    } else {
        geometry.getArray().forEach(function (g) {
            processPoints(g, callback, thisArg);
        });
    }
}


function getMarkers() {
    downloadUrl('{{url("locates")}}', function (data) {
        var json = JSON.parse(data.response);
        infowindow = new google.maps.InfoWindow();
        json.data.forEach((item) => {
            let posMv = item.centerlatlng.split(",");
            let LatLng = new google.maps.LatLng(posMv[0], posMv[1]);
            marker = new google.maps.Marker({
                map,
                icon: {
                    //path: camera.icon[4],
                    url: "{{asset('images/markers/green.png')}}",
                    scale: 0.5,
                    strokeWeight: 0.2,
                    strokeColor: 'black',
                    strokeOpacity: 1,
                    fillColor: '#f8ae5f',
                    fillOpacity: 0.7,
                    scaledSize: new google.maps.Size(38, 38)
                },
                clickable: true,
                draggable: true,
                position: LatLng,
                title: item.name
            });

            let table = `
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>FullName</th>
                                    <th>qqq</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.name}</td>
                                </tr>
                            </tbody>
                        </table>`;


            marker.addListener('click', function (e) {
                infowindow.setContent(table);
                infowindow.open(map, this);
                map.setZoom(18);
                map.setCenter(marker.getPosition());

            });

            marker.addListener('dragend', function (e) {
                //console.log(e.latLng.lat());

            });

        });



    });
}

/* DOM (drag/drop) functions */

function initEvents() {
    // set up the drag & drop events
    let mapContainer = document.querySelector('#m_app');


    // map-specific events
    mapContainer.addEventListener('dragenter', showPanel, false);

    // overlay specific events (since it only appears once drag starts)
    dropContainer.addEventListener('dragover', showPanel, false);
    dropContainer.addEventListener('drop', handleDrop, false);
    dropContainer.addEventListener('dragleave', hidePanel, false);

    let list = Array.from(document.querySelectorAll("a[data-localName]"));
    list.forEach((item) => {
        item.addEventListener("click", (e) => {
            e.preventDefault();
            let localName = e.target.getAttribute("data-localName");
            findLocale(localName);
        })
    });


    map.addListener('click', function (e) {
        addMarker(e.latLng);
        markersArray.push(this);
    });



    map.addListener("rightclick", function (e) { });
}



    function showPanel(e) {
        e.stopPropagation();
        e.preventDefault();
        dropContainer.style.display = 'block';
        return false;
    }

    function hidePanel(e) {
        dropContainer.style.display = 'none';
    }

    function handleDrop(e) {
        e.preventDefault();
        e.stopPropagation();
        hidePanel(e);

        let files = e.dataTransfer.files;
        if (files.length) {
            // process file(s) being dropped
            // grab the file data from each file
            for (let i = 0, file; file = files[i]; i++) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    loadGeoJsonString(e.target.result);
                    //console.log(e.target.result);
                };
                reader.onerror = function (e) {
                    // console.error('reading failed');
                };
                reader.readAsText(file);
            }
        } else {
            // process non-file (e.g. text or html) content being dropped
            // grab the plain text version of the data
            let plainText = e.dataTransfer.getData('text/plain');
            if (plainText) {
                loadGeoJsonString(plainText);
            }
        }

        // prevent drag event from bubbling further
        return false;
    }


    function initialize() {
        initMap();
        initEvents();
    }


    $('body').on('click', '.list-group-item', function () {
        $('.list-group-item').removeClass('active');
        $(this).closest('.list-group-item').addClass('active');
    });





    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function () {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing;
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }

    function doNothing() {}
