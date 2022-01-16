<div>
    <div id="map" class="w-full h-96 mt-10">

    </div>
</div>


<script>
    let map;
    let markers = [];
    let myLatLng;
    //array of markers

    let initialLat =  document.getElementById('latitude').value;
    let initLong =  document.getElementById('longitude').value;
    let showMap = 'true'
    if(document.getElementById('showMap'))
    {
        showMap =  document.getElementById('showMap').value;
    }


    function initMap() {


        //listen for click on map
        if(initLong && initialLat)
        {
             myLatLng = { lat: parseFloat(initialLat), lng: parseFloat(initLong) };
        } else
        {
             myLatLng = { lat: 42.737633, lng: 25.399320 };
        }

        if(showMap === 'false')
        {
            document.getElementById('map').remove();
            return;
        }else
        {
            map = new google.maps.Map(document.getElementById("map"), {
                center: myLatLng,
                zoom: 7,
            });
        }


        if(initLong && initialLat)
        {
            addMarker({coords:myLatLng});
        }
        document.getElementById("delete-markers").addEventListener("click", deleteMarkers);

        google.maps.event.addListener(map,'click',function (event){

            addMarker({
                coords:event.latLng
            })

            document.getElementById('longitude').value = event.latLng.lng();
            document.getElementById('latitude').value = event.latLng.lat();
        })
    }

    function addMarker(props)
    {
        deleteMarkers();
        const  marker = new google.maps.Marker({
            position:props.coords,
            map:map,
            animation: google.maps.Animation.DROP,
            draggable:true
        })

        markers.push(marker);
        //Check for custom icon
        if(props.iconImage){
            //Set icon image
            marker.setIcon(props.iconImage)
        }

        if(props.content){
            var infoWindow = new google.maps.InfoWindow({
                content:props.content
            });
            //Set icon image
            marker.setIcon(props.iconImage)
        }
        marker.addListener("click", toggleBounce);


        google.maps.event.addListener(marker, 'dragend', function (evt) {
            document.getElementById('longitude').value = evt.latLng.lng().toFixed(6);
            document.getElementById('latitude').value = evt.latLng.lat().toFixed(6);

            map.panTo(evt.latLng);
        });

        function toggleBounce() {
            if (marker.getAnimation() !== null) {
                marker.setAnimation(null);
            } else {
                marker.setAnimation(google.maps.Animation.BOUNCE);
            }
        }
    }

    function setMapOnAll(map) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }
    function hideMarkers() {
        setMapOnAll(null);
    }
    function deleteMarkers() {
        hideMarkers();
        markers = [];
        document.getElementById('longitude').value = '';
        document.getElementById('latitude').value = '';
    }

</script>
<script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBahmPo0I8hvCEKOXIdlubnjMRdBuyqQSc&callback=initMap">
</script>
