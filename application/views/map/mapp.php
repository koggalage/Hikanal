

    <div id="overlayLoading" style="display: none">
        <div class="spinner">
            <div class="rect1"></div>
            <div class="rect2"></div>
            <div class="rect3"></div>
            <div class="rect4"></div>
            <div class="rect5"></div>
        </div>
    </div>

    <div class="actions" >
        <a class="btn btn-primary btn-lg" id="download" target="_blank" style="display: none;"><i class="glyphicon glyphicon-download-alt"></i> Download as image</a>
        <a class="btn btn-danger btn-lg" id="tog" style=""><i class="glyphicon glyphicon glyphicon-cog"></i> Satalite View</a>
        <a class="btn btn-success btn-lg" id="change" style="display: none;"><i class="glyphicon glyphicon glyphicon-cog"></i> New Map</a>
        <input type="hidden" id="map-type" value="road">
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" id="map-canvas-wrapper">
                <div id="map-canvas" class="container-fluid">
                </div>
            </div>
            <div class="col-md-8">
                <div id="map-canvas2-wrapper" style="display: none">
                    <div id="map-canvas2"></div>
                </div>
            </div>
        </div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxJt45HSxnhUn26cibrRrQin578_9T-Yg"></script>

<script>
$(function() {
    var canv = '';

    function initialize() {
        var myLatlng;    
        var mapOptions;
        myLatlng = new google.maps.LatLng(7.884472, 80.850632);
        mapOptions = {
            zoom: 8,
            streetViewControl: false,
            mapTypeControl: false,
            zoomControl: false,
            // fullscreenControl: false,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        google.maps.event.addListenerOnce(map, 'idle', function() {
            drawRectangle(map);
            drawLengthyRectangle(map);
        });
    }

    function drawRectangle(map, drawMarker = true) {

        var southWestLat = 7.45282838800632;
        var southWestLng = 80.7737578865776;
        var northEastLat = 8.13087938800633;
        var northEastLng = 81.8676373865776;

        var numberOfParts = 3;

        var tileWidth = (northEastLng - southWestLng) / numberOfParts;
        var tileHeight = (northEastLat - southWestLat) / numberOfParts;

        var southWestLat = [
            6.096726388006320,
            5.870709388006320,
            5.870709388006320,
            5.870709388006320,
            6.096726388006320,
            6.322743388006320,
            9.351371188006320
        ];

        var southEastLng = [
            79.679878386577600,
            80.044504886577600,
            80.409131386577600,
            80.773757886577600,
            81.138384386577600,
            81.503010886577600,
            79.388177186577600 
        ];

        var mapNumbers = ["85", "79", "73", "66", "59", "52", "46", "40", "34", "29", "24", "19", "15", "11", "07", "03", "01", "90", "86", "80", "74", "67", "60", "53", "47", "41", "35", "30", "25", "20", "16", "12", "08", "04", "02", "91", "87", "81", "75", "68", "61", "54", "48", "42", "36", "31", "26", "21", "17", "13", "09", "05", "92", "88", "82", "76", "69", "62", "55", "49", "43", "37", "32", "27", "22", "18", "14", "10",  "89", "83", "77", "70", "63", "56", "50", "44", "38", "33", "28", "23", "84", "78", "51", "45", "39", "06"];

        var z;
        var t;
        var count = 0;

        for (var x = 0; x < 7; x++) {

            if(x == 0 || x == 2) {
                numberOfBoxes = 17;
            }
            else if(x == 1) {
                numberOfBoxes = 18;
            }

            else if(x == 3) {
                numberOfBoxes = 16;
            }

            else if(x == 4) {
                numberOfBoxes = 12;
            }

            else if(x == 5) {
                numberOfBoxes = 8;
            }

            else if(x == 6) {
                numberOfBoxes = 1;
            }

            for (var y = 0; y < numberOfBoxes; y++ ) {

                if (x == 5 && (y == 2 || y == 3 || y == 4)) {
                }

                else {

                    var latCurrent = parseFloat(southWestLat[x]);
                    if(x >0 && x != 6) {
                        z = x-x;
                    }
                    else {
                        z = x;
                    }
                    if(x == 6) {
                        t = x - x;
                    }
                    else {
                        t = x;
                    }
                    var lngCurrent = parseFloat(southEastLng[z]);
                    var areaBounds = {
                        north: latCurrent + (tileHeight * (y+1)),
                        south: latCurrent + (tileHeight * y),
                        east: lngCurrent + (tileWidth * (t+1)),
                        west: lngCurrent + (tileWidth * t)
                    };

                    var area = new google.maps.Rectangle({
                        strokeColor: '#000000',
                        fillColor: '#000000',
                        fillOpacity: 0.05,
                        strokeWeight: 0.5,
                        map: map,
                        bounds: areaBounds
                    });
                        
                        var centerMark = new google.maps.Marker({
                            position: area.getBounds().getCenter(),
                            map: map,
                            area: areaBounds,
                            label: mapNumbers[count],
                            title: "Map Number:" + mapNumbers[count]
                        });

                    if (drawMarker == true) {
                        google.maps.event.addListener(centerMark, 'click', function(evt) {
                            initMap(this.position.lat(), this.position.lng(), this.area);
                        });
                    }
                    count++;
                }
            }
        }
    }
    var lengthymaps  = [];
        lengthymaps[0] = "71-72";
        lengthymaps[1] = "64-65";
        lengthymaps[2] = "57-58";

    function drawLengthyRectangle(map) {

        var southWestLat = 6.77477738800632;
        var southWestLng = 81.5030108865776;
        var northEastLat = 7.00079438800632;
        var northEastLng = 81.8849571453276;

        var numberOfParts = 1;

        var tileWidth = (northEastLng - southWestLng) / numberOfParts;
        var tileHeight = (northEastLat - southWestLat) / numberOfParts;

        for (var y = 0; y < 3; y++ ) {
            var areaBounds = {
                north: southWestLat + (tileHeight * (y+1)),
                south: southWestLat + (tileHeight * y),
                east: southWestLng + (tileWidth),
                west: southWestLng
            };

            var area = new google.maps.Rectangle({
                strokeColor: '#000000',
                fillColor: '#000000',
                strokeWeight: 0.5,
                fillOpacity: 0.05,
                map: map,
                bounds: areaBounds
            });

            var centerMark = new google.maps.Marker({
                position: area.getBounds().getCenter(),
                map: map,
                area: areaBounds,
                label: lengthymaps[y],
                title: lengthymaps[y],
            });

            google.maps.event.addListener(centerMark, 'click', function(evt) {
                initMap(this.position.lat(), this.position.lng(), this.area);
            });
        }
        
    }

    var rectangle;
    var map;
    var strictBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(5.87, 79.67),
        new google.maps.LatLng(9.93, 82.50)
    );

    function initMap(centerLat, centerLng, inbounds) {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: {lat: centerLat, lng: centerLng},
            zoom: 10,
            streetViewControl : false,

        });

        rectangle = new google.maps.Rectangle({
            bounds: inbounds,
              strokeWeight: 1,
              draggable: true
          });
        rectangle.setMap(map);
        rectangle.addListener('dragend', function() {
            $("#map-canvas-wrapper").removeClass('col-md-offset-4');
            $("#map-canvas-wrapper").hide();
            $("#map-canvas2-wrapper").show();
            if (strictBounds.contains(rectangle.getBounds().getNorthEast())) {
                showSelectedAreaWithGrid();
            }   else {
                rectangle.setBounds(inbounds);
                map.setCenter(new google.maps.LatLng(centerLat, centerLng));
                map.setZoom(10)
            }
        });
    }

    function drawGrid(map) {
        $("#overlayLoading").show();

        var type_id = google.maps.MapTypeId.ROADMAP;
        var linecolor = '#000000';

        if ($("#map-type").val() == "sat") {
            type_id = google.maps.MapTypeId.SATELLITE;
            linecolor = '#FFFFFF';
        }
        var southWestLat = 7.45282838800632;
        var southWestLng = 80.7737578865776;
        var northEastLat = 8.13087938800633;
        var northEastLng = 81.8676373865776;

        var numberOfParts = 3;

        var tileWidth = (northEastLng - southWestLng) / numberOfParts;
        var tileHeight = (northEastLat - southWestLat) / numberOfParts;

        var kiloMeterWidth = 0.0092156625;

        var southWestLat = [
            6.096726388006320,
            5.870709388006320,
            5.870709388006320,
            5.870709388006320,
            6.096726388006320,
            6.322743388006320,
            9.351371188006320/* + (kiloMeterWidth * 2)*/
        ];

        var southEastLng = [
            79.679878386577600,
            80.044504886577600,
            80.409131386577600,
            80.773757886577600,
            81.138384386577600,
            81.503010886577600,
            79.388177186577600 + (kiloMeterWidth * 2)
        ];

        var z;
        var t;
        var count = 0;
        var numberOfBoxes;
        var easting;
        var northing;
        var blody;
        for (var x = 0; x < 7; x++) {

            if(x == 0) {
                numberOfBoxes = 17;
                easting = 80;
                blody = 0;
            }
            else if(x == 1) {
                numberOfBoxes = 18;
                blody = 1;
                easting = 20;
            }
            else if(x == 2) {
                numberOfBoxes = 17;
                easting = 60;
                blody = 1;
            }

            else if(x == 3) {
                numberOfBoxes = 16;
                easting = 00;
                blody = 1;
            }

            else if(x == 4) {
                numberOfBoxes = 12;
                easting = 40;
                blody = 0;
            }

            else if(x == 5) {
                numberOfBoxes = 8;
                easting = 80;
                blody = -1;
            }

            else if(x == 6) {
                numberOfBoxes = 1;
                easting = 50;
            }

            for (var y = 0; y < numberOfBoxes; y++ ) {

                if (!(x == 5 && (y == 2 || y == 3 || y == 4))) {
                    if (x == 6) {
                        northing = 85;
                    } else {
                        var yf = y - blody;
                        if (yf<0) {
                            yf = 3;
                        }
                        var switchVal = Math.abs((yf%4));
                        switch (switchVal)  {
                            case 0:
                                northing = 25;
                                break;

                            case 1:
                                northing = 50;
                                break;

                            case 2:
                                northing = 75;
                                break;

                            case 3:
                                northing = 00;
                                break;

                            case 4:
                                northing = 80;
                                break;
                        }
                    }


                    var latCurrent = parseFloat(southWestLat[x]);
                    if(x >0 && x != 6) {
                        z = x-x;
                    }
                    else {
                        z = x;
                    }
                    if(x == 6) {
                        t = x - x;
                    }
                    else {
                        t = x;
                    }
                    var lngCurrent = parseFloat(southEastLng[z]);
                    var areaBounds = {
                        north: latCurrent + (tileHeight * (y+1)),
                        south: latCurrent + (tileHeight * y),
                        east: lngCurrent + (tileWidth * (t+1)),
                        west: lngCurrent + (tileWidth * t)
                    };

                    var area = new google.maps.Rectangle({
                        strokeColor: '#000000',
                        fillColor: '#000000',
                        fillOpacity: 0.0,
                        strokeWeight: 0.5,
                        map: map,
                        bounds: areaBounds
                    });
                    var nEastOfCur = area.getBounds().getNorthEast();
                    var sWestOfCur = area.getBounds().getSouthWest();

                    var curNorth = area.getBounds().getNorthEast().lat();
                    var curSouth = area.getBounds().getSouthWest().lat();

                    var curWest = area.getBounds().getSouthWest().lng();
                    var curEast = area.getBounds().getNorthEast().lng();


                    for (var j = 0; j <= 40; j++) {

                        var linecordinates = [
                            {lat : (curNorth), lng: (curWest + ((tileWidth/40) * j))},
                            {lat : (curSouth), lng: (curWest + ((tileWidth/40) * j))}
                        ];

                        var linecordinates2 = [
                            {lat : (curNorth - ((tileHeight/25) * j)), lng: curWest},
                            {lat : (curNorth - ((tileHeight/25) * j)), lng: curEast}
                        ];

                        var str = 1;

                        if(j%5 == 0) {
                          str = 2;
                        }
                        if(1) {

                            var gridline = new google.maps.Polyline({
                                path: linecordinates,
                                geodesic: true,
                                strokeColor: linecolor,
                                strokeOpacity: 1.0,
                                strokeWeight: str
                            });

                            gridline.setMap(map);
                        }
                        if(1) {
                            if(j <= 25) {

                                var gridline2 = new google.maps.Polyline({
                                    path: linecordinates2,
                                    geodesic: true,
                                    strokeColor: linecolor,
                                    strokeOpacity: 1.0,
                                    strokeWeight: str
                                });

                                gridline2.setMap(map);

                                for (var k = 0; k < 8; k++) {
                                    var icnNm = (easting + (5*k));
                                    if (icnNm >= 100) {
                                        icnNm = icnNm - 100;
                                    }
                                    if (j%5 == 0) {
                                        var markerHorizontal = new google.maps.Marker({
                                            position: {lat : (curNorth - ((tileHeight/25) * j) - 0.03), lng: curWest + ((tileWidth/40) * 5*k)},   
                                            map: map,
                                            icon: "<?php echo  base_url("assets/icons/"); ?>"+icnNm+".png"
                                        });
                                    }
                                }
                            }
                            for (var m = 0; m < 5; m++) {
                                if (northing == 00) {
                                    northing = 100;
                                }
                                var icnNm = (northing - (5*m));
                                if (icnNm >= 100) {
                                    icnNm = icnNm - 100;
                                }
                                if (j%5 == 0) {

                                    var markerVertical = new google.maps.Marker({
                                        position: {lat : (curNorth - ((tileHeight/25) * 5*m)), lng: (curWest + ((tileWidth/40) * j) + 0.028)},   
                                        map: map,
                                        icon: "<?php echo  base_url("assets/icons/"); ?>"+icnNm+".png"
                                    });
                                }
                            }
                        }
                    }
                        // break;
                }
            }
        }
    }


    function drawLengthyRectangleGrid(map2) {

        var southWestLat = 6.77477738800632;
        var southWestLng = 81.5030108865776;
        var northEastLat = 7.00079438800632;
        var northEastLng = 81.8858971453276;

        var numberOfParts = 1;
        var easting = 80;

        var tileWidth = (northEastLng - southWestLng) / numberOfParts;
        var tileHeight = (northEastLat - southWestLat) / numberOfParts;

        var linecolor = '#000000';

        for (var y = 0; y < 3; y++ ) {
            switch (y) {

                case 0 :
                    northing = 00;
                    break;

                case 1 :
                    northing = 25;
                    break;

                case 2 :
                    northing = 50;
                    break;

            }
            var areaBounds = {
                north: southWestLat + (tileHeight * (y+1)),
                south: southWestLat + (tileHeight * y),
                east: southWestLng + (tileWidth),
                west: southWestLng
            };

            var area = new google.maps.Rectangle({
                strokeColor: '#000000',
                fillColor: '#000000',
                strokeWeight: 0.5,
                fillOpacity: 0.0,
                map: map,
                bounds: areaBounds
            });
                    var nEastOfCur = area.getBounds().getNorthEast();
                    var sWestOfCur = area.getBounds().getSouthWest();

                    var curNorth = area.getBounds().getNorthEast().lat();
                    var curSouth = area.getBounds().getSouthWest().lat();

                    var curWest = area.getBounds().getSouthWest().lng();
                    var curEast = area.getBounds().getNorthEast().lng();


                    for (var j = 0; j <= 42; j++) {

                        var linecordinates = [
                            {lat : (curNorth), lng: (curWest + ((tileWidth/42) * j))},
                            {lat : (curSouth), lng: (curWest + ((tileWidth/42) * j))}
                        ];

                        var linecordinates2 = [
                            {lat : (curNorth - ((tileHeight/25) * j)), lng: curWest},
                            {lat : (curNorth - ((tileHeight/25) * j)), lng: curEast}
                        ];

                        var str = 1;

                        if(j%5 == 0) {
                          str = 2;
                        }
                        if(1) {

                            var gridline = new google.maps.Polyline({
                                path: linecordinates,
                                geodesic: true,
                                strokeColor: linecolor,
                                strokeOpacity: 1.0,
                                strokeWeight: str
                            });

                            gridline.setMap(map2);
                        }
                        if(1) {
                            if(j <= 25) {

                                var gridline2 = new google.maps.Polyline({
                                    path: linecordinates2,
                                    geodesic: true,
                                    strokeColor: linecolor,
                                    strokeOpacity: 1.0,
                                    strokeWeight: str
                                });

                                gridline2.setMap(map2);

                                for (var k = 0; k < 8; k++) {
                                    var icnNm = (easting + (5*k));
                                    if (icnNm >= 100) {
                                        icnNm = icnNm - 100;
                                    }
                                    if (j%5 == 0) {

                                        var markerHorizontal = new google.maps.Marker({
                                            position: {lat : (curNorth - ((tileHeight/25) * j) - 0.03), lng: curWest + ((tileWidth/42) * 5*k)},   
                                            map: map2,
                                            icon: "<?php echo  base_url("assets/icons/"); ?>"+icnNm+".png"
                                        });
                                    }
                                }
                            }

                            for (var m = 0; m < 5; m++) {
                                if (northing == 00) {
                                    northing = 100;
                                }
                                var icnNm = (northing - (5*m));
                                if (icnNm >= 100) {
                                    icnNm = icnNm - 100;
                                }
                                if (j%5 == 0) {
                                    var markerVertical = new google.maps.Marker({
                                        position: {lat : (curNorth - ((tileHeight/25) * 5*m)), lng: (curWest + ((tileWidth/42) * j) + 0.028)},   
                                        map: map2,
                                        icon: "<?php echo  base_url("assets/icons/"); ?>"+icnNm+".png"
                                    });
                                }
                            }
                        }
                    }
        }
        
    }

    function showSelectedAreaWithGrid(event) {
        
        $("#overlayLoading").show();
        $("#map-canvas2-wrapper").attr("style","overflow: visible;");

        var nEast = rectangle.getBounds().getNorthEast();
        var sWest = rectangle.getBounds().getSouthWest();

        var bounds = new google.maps.LatLngBounds(sWest,nEast);

        var type_id = google.maps.MapTypeId.ROADMAP;
        var linecolor = '#000000';

        if ($("#map-type").val() == "sat") {
            type_id = google.maps.MapTypeId.SATELLITE;
            linecolor = '#FFFFFF';
        }

        map2 = new google.maps.Map(document.getElementById('map-canvas2'), {
            scrollwheel: false,
            mapTypeControl: false,
            draggable: false,
            zoomControl: false,
            fullscreenControl: false,
            disableDoubleClickZoom: true,
            disableDefaultUI: false,
            streetViewControl : false,
            mapTypeId: type_id
        });

        map2.fitBounds(bounds);
        map2.setZoom(14);

        drawGrid(map2);
        drawLengthyRectangleGrid(map2);

        google.maps.event.addListener(map2, 'idle', function(){
            google.maps.event.addListener(map2, 'tilesloaded', function(){
                
                // $("#map-canvas2-wrapper").attr("style","overflow: visible;");
                html2canvas($("#map-canvas2"), {
                        useCORS: true,

                    onrendered: function(canvas) {
                            canv = canvas;
                            $("#download").show(); 
                            $("#change").show(); 
                            // $("#map-canvas2-wrapper").attr("style","overflow: scroll;");
                            $("#overlayLoading").hide();

                        }
                    });
            });
        });
    }
        $("#map-canvas2").draggable({ scroll: false });

        $("#download").click(function() {
            download(canv.toDataURL("image/png"), "CustomMap.png", "image/png");

        });

        $("#change").click(function() {
            $("#download").hide(); 
            $("#map-canvas-wrapper").addClass('col-md-offset-4');
            $("#map-canvas2-wrapper").hide();
            $("#map-canvas-wrapper").show();
            $(this).hide();
            initialize(); 

        });

        $("#tog").click(function() {
            if ($("#map-type").val() == "road") {
                $("#map-type").val("sat");
                $("#tog").text("Road Map");
            } else {
                $("#map-type").val("road");
                $("#tog").text("Satalite View");
            }
            $("#map-canvas2-wrapper").hide();
            $("#map-canvas-wrapper").addClass('col-md-offset-4');
            initialize(); 
        });




        google.maps.event.addDomListener(window, "load", initialize);
    }); 

</script>

</body>
</html>