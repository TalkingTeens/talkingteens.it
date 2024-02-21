<div x-data="map" class="flex h-[calc(100vh-var(--nav-height)-var(--subheader-height))] sm:h-[calc(100vh-var(--nav-height)-var(--banner-height)-var(--subheader-height))]">
    {{--    <aside class="w-1/5"></aside>--}}
    <div wire:ignore x-ref="map" x-init="setup" class="flex-1 isolate"></div>
</div>

@script
<script>
    Alpine.data('map', () => ({
        map: {},

        monuments: [],

        city: null,

        markers: {},

        setup() {
            $wire.$on('reload-map', (event) => {
                this.monuments = event.monuments;
                this.city = event.city;
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
            const locale = document.documentElement.lang;
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
                    title: monument.name[locale],
                });
                google.maps.event.addListener(marker, 'click', () => {
                    window.location.href = `/${locale}/statue/${monument.slug}`;
                });
                this.markers[monument.id] = marker;
            });
        },

        setCenter() {
            if(!this.monuments.length) {
                const lat = +(this.city?.latitude ?? 44.801485);
                const lng = +(this.city?.longitude ?? 10.327904);
                this.map.setCenter({ lat, lng });
                return;
            }

            const bounds = new google.maps.LatLngBounds();

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

