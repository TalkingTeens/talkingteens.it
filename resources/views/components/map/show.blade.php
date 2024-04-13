<gmp-map class="h-96"
         center="{{ $monument->latitude }},{{ $monument->longitude }}"
         zoom="15.7"
         {{--         min-zoom="3"--}}
         map-id="DEMO_MAP_ID"> {{--TODO: replace map-id--}}
    <gmp-advanced-marker
        position="{{ $monument->latitude }},{{ $monument->longitude }}"
        title="{{ $monument->name }}"
    ></gmp-advanced-marker>
</gmp-map>

{{--                restriction: {--}}
{{--                    latLngBounds: {north: 85, south: -85, west: -180, east: 180}--}}
{{--                },--}}
{{--                mapTypeId: "roadmap",--}}

@pushonce('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTr1D4oqR_NQYcN50-xynP9_-rOnWSa9w&callback=initMap&libraries=marker&v=beta"
        defer
    ></script>
    <script>
        function initMap() {
            const advancedMarker = document.querySelector("gmp-advanced-marker");

            customElements.whenDefined(advancedMarker.localName).then(async () => {
                const pin = document.createElement("div");
                const img = document.createElement("img");

                img.src = '{{ asset(Storage::url($monument->background_image)) }}'
                pin.className = "marker";
                pin.appendChild(img)

                advancedMarker.content = pin;
            });
        }
    </script>
@endpushonce
