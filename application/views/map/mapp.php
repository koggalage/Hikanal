<style>

body {
    margin :0;
    overflow: hidden;
}

#overlayLoading {
    opacity: 0.7;
    position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
    top: 0;
    z-index: 3000;
    background: #000000;
}

.actions {
    position: absolute;
    right: 20px;
    bottom: 20px;
    z-index: 2000;
    background: #552244;
    padding: 10px;
}

#map-canvas {
    height: 100vh;
    width: 100%;
    margin: 0px;
    padding: 0px;
}

#map-canvas2 {
    height: 2750px;
    width: 4400px;
    position: relative;
}

#map-canvas2-wrapper {
    height: 100%;
    width: 100%;
    overflow: scroll;
}
#ballsWaveG{
    position:relative;
    width:224px;
    height:53px;
    margin:auto;
    top: 50%;
}

.ballsWaveG{
    position:absolute;
    top:0;
    background-color:rgb(0,0,0);
    width:28px;
    height:28px;
    animation-name:ballsWaveG;
        -o-animation-name:ballsWaveG;
        -ms-animation-name:ballsWaveG;
        -webkit-animation-name:ballsWaveG;
        -moz-animation-name:ballsWaveG;
    animation-duration:1.5s;
        -o-animation-duration:1.5s;
        -ms-animation-duration:1.5s;
        -webkit-animation-duration:1.5s;
        -moz-animation-duration:1.5s;
    animation-iteration-count:infinite;
        -o-animation-iteration-count:infinite;
        -ms-animation-iteration-count:infinite;
        -webkit-animation-iteration-count:infinite;
        -moz-animation-iteration-count:infinite;
    animation-direction:normal;
        -o-animation-direction:normal;
        -ms-animation-direction:normal;
        -webkit-animation-direction:normal;
        -moz-animation-direction:normal;
    border-radius:14px;
        -o-border-radius:14px;
        -ms-border-radius:14px;
        -webkit-border-radius:14px;
        -moz-border-radius:14px;
}

#ballsWaveG_1{
    left:0;
    animation-delay:0.6s;
        -o-animation-delay:0.6s;
        -ms-animation-delay:0.6s;
        -webkit-animation-delay:0.6s;
        -moz-animation-delay:0.6s;
}

#ballsWaveG_2{
    left:28px;
    animation-delay:0.75s;
        -o-animation-delay:0.75s;
        -ms-animation-delay:0.75s;
        -webkit-animation-delay:0.75s;
        -moz-animation-delay:0.75s;
}

#ballsWaveG_3{
    left:56px;
    animation-delay:0.9s;
        -o-animation-delay:0.9s;
        -ms-animation-delay:0.9s;
        -webkit-animation-delay:0.9s;
        -moz-animation-delay:0.9s;
}

#ballsWaveG_4{
    left:84px;
    animation-delay:1.05s;
        -o-animation-delay:1.05s;
        -ms-animation-delay:1.05s;
        -webkit-animation-delay:1.05s;
        -moz-animation-delay:1.05s;
}

#ballsWaveG_5{
    left:112px;
    animation-delay:1.2s;
        -o-animation-delay:1.2s;
        -ms-animation-delay:1.2s;
        -webkit-animation-delay:1.2s;
        -moz-animation-delay:1.2s;
}

#ballsWaveG_6{
    left:140px;
    animation-delay:1.35s;
        -o-animation-delay:1.35s;
        -ms-animation-delay:1.35s;
        -webkit-animation-delay:1.35s;
        -moz-animation-delay:1.35s;
}

#ballsWaveG_7{
    left:168px;
    animation-delay:1.5s;
        -o-animation-delay:1.5s;
        -ms-animation-delay:1.5s;
        -webkit-animation-delay:1.5s;
        -moz-animation-delay:1.5s;
}

#ballsWaveG_8{
    left:196px;
    animation-delay:1.64s;
        -o-animation-delay:1.64s;
        -ms-animation-delay:1.64s;
        -webkit-animation-delay:1.64s;
        -moz-animation-delay:1.64s;
}



@keyframes ballsWaveG{
    0%{
        background-color:rgb(0,0,0);
    }

    100%{
        background-color:rgb(255,255,255);
    }
}

@-o-keyframes ballsWaveG{
    0%{
        background-color:rgb(0,0,0);
    }

    100%{
        background-color:rgb(255,255,255);
    }
}

@-ms-keyframes ballsWaveG{
    0%{
        background-color:rgb(0,0,0);
    }

    100%{
        background-color:rgb(255,255,255);
    }
}

@-webkit-keyframes ballsWaveG{
    0%{
        background-color:rgb(0,0,0);
    }

    100%{
        background-color:rgb(255,255,255);
    }
}

@-moz-keyframes ballsWaveG{
    0%{
        background-color:rgb(0,0,0);
    }

    100%{
        background-color:rgb(255,255,255);
    }
}

</style>

    <div id="overlayLoading" style="display: none">
        <div id="ballsWaveG">
            <div id="ballsWaveG_1" class="ballsWaveG"></div>
            <div id="ballsWaveG_2" class="ballsWaveG"></div>
            <div id="ballsWaveG_3" class="ballsWaveG"></div>
            <div id="ballsWaveG_4" class="ballsWaveG"></div>
            <div id="ballsWaveG_5" class="ballsWaveG"></div>
            <div id="ballsWaveG_6" class="ballsWaveG"></div>
            <div id="ballsWaveG_7" class="ballsWaveG"></div>
            <div id="ballsWaveG_8" class="ballsWaveG"></div>
        </div>
    </div>
    <div class="navbar navbar-default navbar-fixed-top">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header"><a href="#" class="navbar-brand"><?php echo "Welcome ".$user->name; ?></a></div>
                <ul class="navbar-nav nav navbar-right">
                    <li><a href="#">1</a></li>
                    <li><a href="#">23</a></li>
                    <li><a href="#">345</a></li>
                    <li><a href="">ere</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="actions" >
        <a class="btn btn-default" id="download" target="_blank" style="display: none;">Download as image</a>
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
var c = '';
    $(function() {

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
                                title: "Map Number:" + mapNumbers[count]  + "\nLatlong:" + area.getBounds().getCenter().toUrlValue(6)
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
    var infoWindow;
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
              // editable: true,
              strokeWeight: 1,
              draggable: true
          });
        rectangle.setMap(map);
        rectangle.addListener('dragend', showSelectedAreaWithGrid);
        rectangle.addListener('dragstart', function() {
            $("#btnSave").hide();

        });
        infoWindow = new google.maps.InfoWindow();
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

        // var numberOfVerticalLines = 40;
        // var numberOfHorizontalLines = 25;
        var topLat = 6.32274338800632;
        var bottomLat = 6.09672638800632;
        var rightLong = 80.0445048865776;
        var leftLong = 79.6798783865776;


        var verticalGap = (topLat - bottomLat) / 25;
        var horizontalGap = (rightLong - leftLong) / 40;

        for (var i = 0; i <= 400; i++) {

            var linecordinates = [
            {lat : (latnWest), lng: (lngnWest + (verticalGap * i))},
            {lat : (latsWest), lng: (lngsWest + (verticalGap * i))}
            ];

            var linecordinates2 = [
            {lat : (latnWest - (horizontalGap * i)), lng: lngnWest},
            {lat : (latnEast - (horizontalGap * i)), lng: lngnEast}
            ];

            var str = 1;

            if(i%10 == 0) {
              str = 2;
            }

            var gridline = new google.maps.Polyline({
                path: linecordinates,
                geodesic: true,
                strokeColor: '#000000',
                strokeOpacity: 1.0,
                strokeWeight: str
            });

            gridline.setMap(map2);

            var gridline2 = new google.maps.Polyline({
                path: linecordinates2,
                geodesic: true,
                strokeColor: '#000000',
                strokeOpacity: 1.0,
                strokeWeight: str
            });

            gridline2.setMap(map2);
        }
        google.maps.event.addListenerOnce(map2, 'idle', function(){
            google.maps.event.addListenerOnce(map2, 'tilesloaded', function(){
                
                // do something only the first time the map is loaded
                // $("#btnSave").show();
                $("#map-canvas2-wrapper").attr("style","overflow: visible;");
                html2canvas($("#map-canvas2"), {
                        useCORS: true,

                onrendered: function(canvas) {
                    c = canvas;
                    //theCanvas = canvas;
                    // document.body.appendChild(canvas);

                            // Convert and download as image 
                            // Canvas2Image.saveAsPNG(canvas);
                            //Canvas2Image.saveAsJPEG(canvas);
                            /*var img = canvas.toDataURL("image/png");
                            // console.log(img);
                            $("#download").attr('href', img).attr('download', "kama.png"); */
                            $("#download").show(); 
                            // $("#map-canvas3").append(canvas);
                            // Clean up 
                            // document.body.removeChild(canvas);
                            $("#map-canvas2-wrapper").attr("style","overflow: auto;");
                             $("#overlayLoading").hide();


                        // $("#map-canvas2-wrapper").hide();
                        // $("#map-canvas2-wrapper").attr("style","overflow : scroll;");
                        }
                    });

                // console.log("idleeee");

            });
        });
               
    }

        $("#download").click(function() {
            //Canvas2Image.saveAsJPEG(c);
            download(c.toDataURL("image/png"), "ff.png", "image/png");
            //location.reload();
            //var ttt = $("#map-canvas3").find( "canvas" ).html;
            //console.log(ttt);
            // this.href = $("#map-canvas3").find( "canvas" ).toDataURL();
            // this.download = "image.png";
        });

        $("#btnSave").click(function(e) {
            e.preventDefault();
            $("#map-canvas2-wrapper").attr("style","overflow : visible;");
            html2canvas($("#map-canvas2"), {
                        useCORS: true,

                onrendered: function(canvas) {
                    theCanvas = canvas;
                    // document.body.appendChild(canvas);

                            // Convert and download as image 
                            // Canvas2Image.saveAsPNG(canvas); 
                            // $("#download").attr('href', Canvas2Image.saveAskama(canvas, "image/png")).attr('download', "kama.png"); 
                            // $("#map-canvas3").append(canvas);
                            // Clean up 
                            // document.body.removeChild(canvas);
                        $("#map-canvas2-wrapper").hide();
                        // $("#map-canvas2-wrapper").attr("style","overflow : scroll;");
                        }
                    });
        });
        // $("#map-canvas2-wrapper").style('overflow', "auto");
        google.maps.event.addDomListener(window, "load", initialize);
    }); 

</script>

</body>
</html>