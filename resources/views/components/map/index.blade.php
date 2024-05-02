<div x-data="map"
     class="flex h-[calc(100vh-var(--nav-height)-var(--subheader-height))] sm:h-[calc(100vh-var(--nav-height)-var(--banner-height)-var(--subheader-height))]">
    {{--    <aside class="w-1/5"></aside>--}}
    <div wire:ignore x-ref="map" x-init="setup" class="flex-1 isolate"></div>
</div>

@assets
<script>
    (g => {
        var h, a, k, p = "The Google Maps JavaScript API", c = "google", l = "importLibrary", q = "__ib__",
            m = document, b = window;
        b = b[c] || (b[c] = {});
        var d = b.maps || (b.maps = {}), r = new Set, e = new URLSearchParams,
            u = () => h || (h = new Promise(async (f, n) => {
                await (a = m.createElement("script"));
                e.set("libraries", [...r] + "");
                for (k in g) e.set(k.replace(/[A-Z]/g, t => "_" + t[0].toLowerCase()), g[k]);
                e.set("callback", c + ".maps." + q);
                a.src = `https://maps.${c}apis.com/maps/api/js?` + e;
                d[q] = f;
                a.onerror = () => h = n(Error(p + " could not load."));
                a.nonce = m.querySelector("script[nonce]")?.nonce || "";
                m.head.append(a)
            }));
        d[l] ? console.warn(p + " only loads once. Ignoring:", g) : d[l] = (f, ...n) => r.add(f) && u().then(() => d[l](f, ...n))
    })({
        key: "AIzaSyBTr1D4oqR_NQYcN50-xynP9_-rOnWSa9w",
        v: "beta",
    });
</script>
@endassets

@script
<script>
    Alpine.data('map', () => ({
        map: {},

        monuments: [],

        city: null,

        markers: {},

        setup() {
            $wire.$on('reload-map', async (event) => {
                this.monuments = event.monuments;
                this.city = event.city;
                await this.initMap();
            });

            $wire.reloadMap();
        },

        async initMap() {
            const {Map} = await google.maps.importLibrary("maps");

            this.map = new Map(this.$refs.map, {
                zoom: 15,
                minZoom: 3,
                restriction: {
                    latLngBounds: {north: 85, south: -85, west: -180, east: 180}
                },
                mapTypeId: 'roadmap',
                mapId: "9074f1de391fa472", // "DEMO_MAP_ID"
            });

            await this.drawMarkers();
            this.setCenter();
        },

        async drawMarkers() {
            const {AdvancedMarkerElement} = await google.maps.importLibrary("marker");

            const map = this.map;
            const locale = document.documentElement.lang;

            this.monuments.forEach((monument) => {
                const pin = document.createElement("div");
                const img = document.createElement("img");

                // img.src = `/storage/${monument.background_image}`;
                pin.className = "marker";
                pin.appendChild(img);

                const marker = new google.maps.Marker({
                    position: {
                        lat: +monument.latitude,
                        lng: +monument.longitude
                    },
                    map,
                    title: monument.name[locale],
                });

                // const marker = new AdvancedMarkerElement({
                //     map,
                //     position: {
                //         lat: +monument.latitude,
                //         lng: +monument.longitude
                //     },
                //     content: pin,
                //     title: monument.name[locale],
                // });

                marker.addListener('gmp-click', () => {
                    window.location.href = `/${locale}/statue/${monument.slug}`;
                });
                this.markers[monument.id] = marker;
            });
        },

        setCenter() {
            if (!this.monuments.length) {
                const lat = +(this.city?.latitude ?? 44.801485);
                const lng = +(this.city?.longitude ?? 10.327904);
                this.map.setCenter({lat, lng});
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
