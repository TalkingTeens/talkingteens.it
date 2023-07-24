<div x-data>
    <div wire:ignore x-init="$dispatch('initMap')" id="map" class="h-screen isolate"></div>
</div>

<script>
    window.addEventListener('initMap', () => {

        const mapElem = document.getElementById("map");

        const geo = {
            lat: 44.801485,
            lng: 10.327904
        };

        const map = new google.maps.Map(mapElem, {
            zoom: 15,
            center: geo,
            minZoom: 3,
            restriction: {
                latLngBounds: { north: 85, south: -85, west: -180, east: 180 }
            },
            mapTypeId: 'roadmap'
        });
    });
</script>
