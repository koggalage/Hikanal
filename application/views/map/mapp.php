

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
    var c = '';

    function initialize() {
        var myLatlng;    
        var mapOptions;
        myLatlng = new google.maps.LatLng(7.884472, 80.850632);
        mapOptions = {
            zoom: 8,
            streetViewControl: false,
            mapTypeControl: false,
            zoomControl: false,
            fullscreenControl: false,
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
                    // drawLengthyRectangle(map, y);
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
        lengthymaps[0] = "57-58";
        lengthymaps[1] = "64-65";
        lengthymaps[2] = "71-72";

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
                label: "21",
                title: "21",
                map: map,
                bounds: areaBounds
            });

        console.log(lengthymaps[y]);
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

        rectangle = new google.maps.Rectangle({
            bounds: inbounds,
              strokeWeight: 1,
              draggable: true
          });
        rectangle.setMap(map);
        rectangle.addListener('dragend', function() {
            $("#map-canvas-wrapper").removeClass('col-md-offset-4');
            $("#map-canvas2-wrapper").show();
            if (strictBounds.contains(rectangle.getBounds().getNorthEast())) {
                showSelectedAreaWithGridNew();
            }   else {
                rectangle.setBounds(inbounds);
                map.setCenter(new google.maps.LatLng(centerLat, centerLng));
                map.setZoom(10)
            }
        });
    }


    function showSelectedAreaWithGridNew(event) {
        var southWestLat = 7.45282838800632;
        var southWestLng = 80.7737578865776;
        var northEastLat = 8.13087938800633;
        var northEastLng = 81.8676373865776;

        var kiloMeterWidth = (northEastLng - southWestLng) / 120;
        // var kiloMeterWidth = 0.009236;
        // var kiloMeterWidth = 0.0095056625;
        var kiloMeterHeight = (northEastLat - southWestLat) / 75;
        // var kiloMeterHeight = 0.009045780000000129;
        console.log(kiloMeterWidth);

        //top most

        var topMostMap_southWestLat = 9.71299838800632;
        var topMostMap_southWestLng = 79.6798783865776;
        var topMostMap_northEastLat = 9.577388188006330;
        var topMostMap_northEastLng = 80.044504886577600;

        var topMostMap_kiloMeterWidth = (topMostMap_northEastLng - topMostMap_southWestLng) / 40;
        // var topMostMap_kiloMeterHeight = (topMostMap_northEastLat - topMostMap_southWestLat) / 25;
        console.log(topMostMap_kiloMeterWidth);

        //bottom most

        var bottomMostMap_southWestLat = 5.87070938800632;
        var bottomMostMap_southWestLng = 80.0445048865776;
        var bottomMostMap_northEastLat = 6.09672638800632;
        var bottomMostMap_northEastLng = 80.4091313865776;

        var bottomMostMap_kiloMeterWidth = (bottomMostMap_northEastLng - bottomMostMap_southWestLng) / 40;
        // var bottomMostMap_kiloMeterHeight = (bottomMostMap_northEastLat - bottomMostMap_southWestLat) / 25;

        console.log(bottomMostMap_kiloMeterWidth);


        var northMostLat = 9.939015388006320;
        var southMostLat = 5.870709388006320;
        var westMostLng = 79.679878386577600;
        var eastMostLng = 81.884957145327600;
        
        // $("#overlayLoading").show();
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
            // scrollwheel: false,
            // mapTypeControl: false,
            // draggable: false,
            // zoomControl: false,
            // fullscreenControl: false,
            // disableDoubleClickZoom: true,
            disableDefaultUI: false,
            // streetViewControl : false,
            // mapTypeId: type_id
        });

        map2.fitBounds(bounds);
        map2.setZoom(14);

        for (var i = 0; i <= 600; i++) {

            var linecordinates = [
                {lat : (northMostLat), lng: (westMostLng + (kiloMeterWidth * i))},
                {lat : (southMostLat), lng: (westMostLng + (kiloMeterWidth * i))}
            ];

            var linecordinates2 = [
                {lat : (northMostLat - (kiloMeterHeight * i)), lng: westMostLng},
                {lat : (northMostLat - (kiloMeterHeight * i)), lng: eastMostLng}
            ];

            var str = 1;

            if(i%5 == 0) {
              str = 2;
            }
        var symbolOne = {
          path: 'M -2,0 0,-2 2,0 0,2 z',
          strokeColor: '#F00',
          fillColor: '#F00',
          fillOpacity: 1
        };

        var symbolTwo = {
          path: 'M -1,0 A 1,1 0 0 0 -3,0 1,1 0 0 0 -1,0M 1,0 A 1,1 0 0 0 3,0 1,1 0 0 0 1,0M -3,3 Q 0,5 3,3',
          strokeColor: '#00F',
          rotation: 45
        };

        var symbolThree = {
          path: 'M -2,-2 2,2 M 2,-2 -2,2',
          strokeColor: '#292',
          strokeWeight: 4
        };
            var gridline = new google.maps.Polyline({
                path: linecordinates,
                geodesic: true,
                strokeColor: linecolor,
                strokeOpacity: 1.0,
                strokeWeight: str,
                icons: [
                        {
                          icon: "<?php echo  base_url("assets/icons/"); ?>00.png",
                          offset: '0%'
                        }, {
                          icon: symbolTwo,
                          offset: '50%'
                        }, {
                          icon: symbolThree,
                          offset: '100%'
                        }
                      ],
            });

            gridline.setMap(map2);

            var gridline2 = new google.maps.Polyline({
                path: linecordinates2,
                geodesic: true,
                strokeColor: linecolor,
                strokeOpacity: 1.0,
                strokeWeight: str
            });

            gridline2.setMap(map2);

            // ----->
            // numberCordinationsForVerticalGrid[i] = [
            //     {lat : (latnWest - (horizontalGap * i)), lng: (lngnWestForGridNumbers + (verticalGap * i))}
            // ];

            // numberCordinationsForHorizontalGrid[i] = [
            //     {lat : (latnWestForGridNumbers - (horizontalGap * i)), lng: (lngnWest + (verticalGap * i))}
            // ];
        }

    }


/*
    function showSelectedAreaWithGrid(event) {
        
        $("#overlayLoading").show();
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

        //northwest corner
        // var latnWest = 9.93901538800632;
        // var lngnWest = 79.6798783865776;

        var latnWest =  9.92475538800632;;
        var lngnWest = 79.3400085115776;
        //southwest corner
        var latsWest = 5.87070938800632;
        // var lngsWest = 79.6798783865776;

        var lngsWest = 79.4064085115776
        //northeast corner
        // var latnEast = 9.93901538800632;
        // var lngnEast = 82.5030108865776;

        var latnEast = 9.93901538800632;
        var lngnEast = 82.8849571453276

        var topLat = 6.32274338800632;
        var bottomLat = 6.09672638800632;
        var rightLong = 80.0445048865776;
        var leftLong = 79.6798783865776;

        // var verticalGap = (topLat - bottomLat) / 25;
        // var horizontalGap = (rightLong - leftLong) / 40;
        var verticalGap = 0.009040680000000023;
        var horizontalGap = 0.009115662400000001;
        // console.log('verticalGap' + verticalGap);
        // console.log('horizontalGap' + horizontalGap);
        var halfVerticalGap =verticalGap / 2;
        var halfHorizontalGap =horizontalGap / 2;

        var latnWestForGridNumbers = latnWest - (halfHorizontalGap * 5);
        var lngnWestForGridNumbers = lngnWest - (halfHorizontalGap * 5);

        var numberCordinationsForVerticalGrid = [];
        var numberCordinationsForHorizontalGrid = [];

        for (var i = 0; i <= 600; i++) {

            var linecordinates = [
                {lat : (latnWest), lng: (lngnWest + (verticalGap * i))},
                {lat : (latsWest), lng: (lngsWest + (verticalGap * i))}
            ];

            var linecordinates2 = [
                {lat : (latnWest - (horizontalGap * i)), lng: lngnWest},
                {lat : (latnEast - (horizontalGap * i)), lng: lngnEast}
            ];

            var str = 1;

            if(i%5 == 0) {
              str = 2;
            }

            var gridline = new google.maps.Polyline({
                path: linecordinates,
                geodesic: true,
                strokeColor: linecolor,
                strokeOpacity: 1.0,
                strokeWeight: str
            });

            gridline.setMap(map2);

            var gridline2 = new google.maps.Polyline({
                path: linecordinates2,
                geodesic: true,
                strokeColor: linecolor,
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

        google.maps.event.addListener(map2, 'idle', function(){
            // console.log("hi");
            google.maps.event.addListener(map2, 'tilesloaded', function(){
                // console.log("hi2");
                
                $("#map-canvas2-wrapper").attr("style","overflow: visible;");
                html2canvas($("#map-canvas2"), {
                        useCORS: true,

                onrendered: function(canvas) {
                    c = canvas;
                            $("#download").show(); 
                            // $("#tog").show(); 
                            $("#map-canvas2-wrapper").attr("style","overflow: scroll;");
                            $("#overlayLoading").hide();

                        }
                    });
            });
        });
    }
        $("#map-canvas2").draggable({ scroll: false });

        $("#download").click(function() {
            download(c.toDataURL("image/png"), "CustomMap.png", "image/png");
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

*/


        google.maps.event.addDomListener(window, "load", initialize);
    }); 

</script>

</body>
</html>