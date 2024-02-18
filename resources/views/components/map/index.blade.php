<div x-data class="flex h-[calc(100vh-var(--nav-height)-var(--banner-height)-var(--subheader-height))]">
    {{--    <aside class="w-1/5"></aside>--}}
    <div wire:ignore id="map" x-init="$dispatch('load-map')" class="flex-1 isolate"></div>
</div>

<script wire:ignore>

    let map;
    let markers = [];

    function initMap(monuments) {
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            minZoom: 3,
            restriction: {
                latLngBounds: { north: 85, south: -85, west: -180, east: 180 }
            },
            mapTypeId: 'roadmap'
        });

        setMapCenter(monuments);
        drawMarkers(monuments);
    }

    function setMapCenter(monuments) {
        let bounds = new google.maps.LatLngBounds();

        monuments.forEach((monument) => {
            bounds.extend(new google.maps.LatLng(monument.latitude, monument.longitude));
        });

        map.setCenter(bounds.getCenter());

        google.maps.event.addListenerOnce(map, 'bounds_changed', () => {
            if(map.getZoom() > 15) map.setZoom(15);
        });

        map.fitBounds(bounds);
    }

    function drawMarkers(monuments) {
        monuments.forEach((monument) => {
            const marker = new google.maps.Marker({
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
            markers.push(marker);
        });
    }

    function clearMarkers() {
        markers.forEach(marker => {
            marker.setMap(null);
        })
        markers = [];
    }

    document.addEventListener('load-map', () => {
        const monuments = @json($monuments);
        initMap(monuments);
    })

    document.addEventListener('livewire:load', () => {
        @this.on('reload-map', (event) => {
            const monuments = event.monuments;
            clearMarkers();
            drawMarkers(monuments);
            setMapCenter(monuments);
        });
    });
</script>
