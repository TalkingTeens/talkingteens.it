<div x-data class="flex h-[calc(100vh-var(--nav-height)-var(--banner-height)-var(--subheader-height))]">
{{--    <aside class="w-1/5">

    </aside>--}}
    <div wire:ignore x-init="$dispatch('loadMap')" id="map" class="flex-1 isolate"></div>
</div>

    <script>

        let map;
        let monuments = @json($monuments); // to clear

        window.addEventListener('loadMap', () => {
            initMap();
            drawMarkers();
        });

        function initMap() {
            let bounds = new google.maps.LatLngBounds();

            monuments.forEach((monument) => {
                bounds.extend(new google.maps.LatLng(monument.latitude, monument.longitude));
            });

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: bounds.getCenter(),
                minZoom: 3,
                restriction: {
                    latLngBounds: { north: 85, south: -85, west: -180, east: 180 }
                },
                mapTypeId: 'roadmap'
            });

            google.maps.event.addListenerOnce(map, 'bounds_changed', () => {
                if(map.getZoom() > 15)
                    map.setZoom(15);
            });

            map.fitBounds(bounds);
        }

        function drawMarkers() {
            monuments.forEach((monument) => {
                new google.maps.Marker({
                    position: {
                        lat: +monument.latitude,
                        lng: +monument.longitude
                    },
                    map,
                    icon: {
                        url: "/storage/" + monument.pin_image,
                        scaledSize: new google.maps.Size(60, 71.8)
                    },
                    title: monument.name, // to fix
                });
            });
        }

    </script>
