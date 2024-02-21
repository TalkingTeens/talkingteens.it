<div x-data="map" class="flex h-[calc(100vh-var(--nav-height)-var(--banner-height)-var(--subheader-height))]">
    {{--    <aside class="w-1/5"></aside>--}}
    <div wire:ignore x-ref="map" x-init="setup" class="flex-1 isolate"></div>
</div>

@script
<script>
    Alpine.data('map', () => ({
        map: {},

        monuments: {},

        markers: {},

        setup() {
            $wire.$on('reload-map', (event) => {
                this.monuments = event.monuments;
                this.initMap();
            });

            $wire.reloadMap();
        },

        initMap() {
            this.map = new google.maps.Map(this.$refs.map, {
                zoom: 15,
                minZoom: 3,
                restriction: {
                    latLngBounds: {north: 85, south: -85, west: -180, east: 180}
                },
                mapTypeId: 'roadmap'
            });

            this.drawMarkers();
            this.setCenter();
        },

        drawMarkers() {
            const map = this.map;
            this.monuments.forEach((monument) => {
                const marker = new google.maps.Marker({
                    position: {
                        lat: +monument.latitude,
                        lng: +monument.longitude
                    },
                    map,
                    icon: {
                        url: `/storage/${monument.pin_image}`,
                        scaledSize: new google.maps.Size(60, 71.8)
                    },
                    title: monument.slug, // to fix
                });
                this.markers[monument.id] = marker;
            });
        },

        setCenter() {
            let bounds = new google.maps.LatLngBounds();

            this.monuments.forEach((monument) => {
                bounds.extend(new google.maps.LatLng(monument.latitude, monument.longitude));
            });

            this.map.setCenter(bounds.getCenter());

            google.maps.event.addListenerOnce(this.map, 'bounds_changed', () => {
                if (this.map.getZoom() > 15) this.map.setZoom(15);
            });

            this.map.fitBounds(bounds);
        },
    }));
</script>
@endscript

