

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
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div id="map-canvas" class="container-fluid">
                    
                </div>
            </div>
            <div class="col-md-8">
                <div id="map-canvas2-wrapper">

                    <div id="map-canvas2"></div>
                </div>
            </div>
        </div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxJt45HSxnhUn26cibrRrQin578_9T-Yg"></script>

<script>
$(function() {
    var c = '';

    function initialize() {
        var myLatlng;    
        var mapOptions;
        myLatlng = new google.maps.LatLng(7.884472, 80.850632);
        mapOptions = {
            zoom: 8,
            streetViewControl: false,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
        google.maps.event.addListenerOnce(map, 'idle', function() {
            drawRectangle(map);
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

        var southEastLat = [
            "6.096726388006320",
            "5.870709388006320",
            "5.870709388006320",
            "5.870709388006320",
            "6.096726388006320",
            "6.322743388006320",
            "9.351371188006320"
        ];

        var southEastLng = [
            "79.679878386577600",
            "80.044504886577600",
            "80.409131386577600",
            "80.773757886577600",
            "81.138384386577600",
            "81.503010886577600",
            "79.388177186577600" 
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
                    drawLengthyRectangle(map);
                }

                else {

                    var latCurrent = parseFloat(southEastLat[x]);
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

    function drawLengthyRectangle(map) {

        var southWestLat = 6.77477738800632;
        var southWestLng = 81.5030108865776;
        var northEastLat = 7.00079438800632;
        var northEastLng = 81.8849571453276;

        var numberOfParts = 1;

        var tileWidth = (northEastLng - southWestLng) / numberOfParts;
        var tileHeight = (northEastLat - southWestLat) / numberOfParts;

        for (var x = 0; x < 1; x++) {
            for (var y = 0; y < 3; y++ ) {
                var areaBounds = {
                    north: southWestLat + (tileHeight * (y+1)),
                    south: southWestLat + (tileHeight * y),
                    east: southWestLng + (tileWidth * (x+1)),
                    west: southWestLng + (tileWidth * x)
                };

                var area = new google.maps.Rectangle({
                    strokeColor: '#000000',
                    //strokeOpacity: 0.8,
                    strokeWeight: 0.5,
                    //fillColor: '#FF0000',
                    fillOpacity: 0.05,
                    // fillOpacity: 0.35,
                    map: map,
                    bounds: areaBounds
                });

                var centerMark = new google.maps.Marker({
                    position: area.getBounds().getCenter(),
                    map: map,
                    area: areaBounds,
                });

                google.maps.event.addListener(centerMark, 'click', function(evt) {

                    initMap(this.position.lat(), this.position.lng(), this.area);
                });
            }
        }
    }    
    // }
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
        google.maps.event.addListenerOnce(map, 'idle', function() {
            // drawRectangle(map, false);
        });

        rectangle = new google.maps.Rectangle({
            bounds: inbounds,
              strokeWeight: 1,
              draggable: true
          });
        rectangle.setMap(map);
        rectangle.addListener('dragend', function() {
            if (strictBounds.contains(rectangle.getBounds().getNorthEast())) {
                showSelectedAreaWithGrid();
            }   else {
                rectangle.setBounds(inbounds);
                map.setCenter(new google.maps.LatLng(centerLat, centerLng));
                map.setZoom(10)
            }
        });
    }


    function showSelectedAreaWithGrid(event) {
        
        $("#overlayLoading").show();
        var nEast = rectangle.getBounds().getNorthEast();
        var sWest = rectangle.getBounds().getSouthWest();

        var bounds = new google.maps.LatLngBounds(sWest,nEast);

        map2 = new google.maps.Map(document.getElementById('map-canvas2'), {
            scrollwheel: false,
            draggable: false,
            disableDoubleClickZoom: true,
            disableDefaultUI: false,
            streetViewControl : false,
        });

        map2.fitBounds(bounds);
        map2.setZoom(14);

        //northwest corner
        var latnWest = 9.93901538800632;
        var lngnWest = 79.6798783865776;
        //southwest corner
        var latsWest = 5.87070938800632;
        var lngsWest = 79.6798783865776;
        //northeast corner
        var latnEast = 9.93901538800632;
        var lngnEast = 81.5030108865776;

        var topLat = 6.32274338800632;
        var bottomLat = 6.09672638800632;
        var rightLong = 80.0445048865776;
        var leftLong = 79.6798783865776;

        var verticalGap = (topLat - bottomLat) / 25;
        var horizontalGap = (rightLong - leftLong) / 40;
        var halfVerticalGap =verticalGap / 2;
        var halfHorizontalGap =horizontalGap / 2;

        var latnWestForGridNumbers = latnWest - (halfHorizontalGap * 5);
        var lngnWestForGridNumbers = lngnWest - (halfHorizontalGap * 5);

        var linecordinates = [];
        var linecordinates2 = [];
        var numberCordinationsForVerticalGrid = [];
        var numberCordinationsForHorizontalGrid = [];

        for (var i = 0; i <= 600; i++) {

            linecordinates[i] = [
            {lat : (latnWest), lng: (lngnWest + (verticalGap * i))},
            {lat : (latsWest), lng: (lngsWest + (verticalGap * i))}
            ];

            linecordinates2[i] = [
            {lat : (latnWest - (horizontalGap * i)), lng: lngnWest},
            {lat : (latnEast - (horizontalGap * i)), lng: lngnEast}
            ];

            var str = 1;

            if(i%5 == 0) {
              str = 2;
            }

            var gridline = new google.maps.Polyline({
                path: linecordinates[i],
                geodesic: true,
                strokeColor: '#000000',
                strokeOpacity: 1.0,
                strokeWeight: str
            });

            gridline.setMap(map2);

            var gridline2 = new google.maps.Polyline({
                path: linecordinates2[i],
                geodesic: true,
                strokeColor: '#000000',
                strokeOpacity: 1.0,
                strokeWeight: str
            });

            gridline2.setMap(map2);

            // ----->
            numberCordinationsForVerticalGrid[i] = [
                {lat : (latnWest - (horizontalGap * i)), lng: (lngnWestForGridNumbers + (verticalGap * i))}
            ];

            numberCordinationsForHorizontalGrid[i] = [
                {lat : (latnWestForGridNumbers - (horizontalGap * i)), lng: (lngnWest + (verticalGap * i))}
            ];
        }

        var numberCountHorizontal = 75;
        var numberCountVertical = 25;
        var numberCountHorizontalPrint;
        var numberCountVerticalPrint;

        for (var j = 0; j <600; j++) {

            if (j%5 == 0) {

                for (var x = 0; x < 600; x++) {
                    
                    if (x%5 == 0) {

                        numberCountHorizontal = numberCountHorizontal + 5;

                        if (numberCountHorizontal == 100) {
                            numberCountHorizontal = 0;
                        }

                        if (numberCountHorizontal == 0 || numberCountHorizontal == 5) {
                            numberCountHorizontalPrint = "0" + numberCountHorizontal;
                        }

                        else {
                            numberCountHorizontalPrint = numberCountHorizontal;
                        }

                        numberCountVertical = numberCountVertical - 5;

                        if (numberCountVertical == 0 || numberCountVertical == 5) {
                            numberCountVerticalPrint = "0" + numberCountVertical;                        
                        }

                        else {
                            numberCountVerticalPrint = numberCountVertical;
                        }

                        if (numberCountVertical == 0) {
                            numberCountVertical = 100;                        
                        }

                        // var iconUrlVertical = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=" + numberCountVerticalPrint + "|FE6256|000000";
                        // var iconUrlHorizontal = "http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=" + numberCountHorizontalPrint + "|FFFF00|000000";

                        var markerVertical = new google.maps.Marker({  
                            position: new google.maps.LatLng(numberCordinationsForVerticalGrid[x][0].lat,numberCordinationsForVerticalGrid[j][0].lng),   
                            map: map2,
                            icon: "<?php echo  base_url("assets/icons/"); ?>"+numberCountVerticalPrint+".png"
                        });

                        var markerHorizontal = new google.maps.Marker({  
                            position: new google.maps.LatLng(numberCordinationsForHorizontalGrid[j][0].lat,numberCordinationsForHorizontalGrid[x][0].lng),   
                            map: map2,
                            icon: "<?php echo  base_url("assets/icons/"); ?>"+numberCountHorizontalPrint+".png"
                        });
                    }
                }

            }
          
        }

        google.maps.event.addListenerOnce(map2, 'idle', function(){
            google.maps.event.addListenerOnce(map2, 'tilesloaded', function(){
                
                $("#map-canvas2-wrapper").attr("style","overflow: visible;");
                html2canvas($("#map-canvas2"), {
                        useCORS: true,

                onrendered: function(canvas) {
                    c = canvas;
                            $("#download").show(); 
                            $("#map-canvas2-wrapper").attr("style","overflow: scroll;");
                            $("#overlayLoading").hide();

                        }
                    });
            });
        });
               
    }


        // $("#convert").click(function() {

        // }

        $("#download").click(function() {
            download(c.toDataURL("image/png"), "CustomMap.png", "image/png");
        });
        google.maps.event.addDomListener(window, "load", initialize);
    }); 

</script>

</body>
</html>