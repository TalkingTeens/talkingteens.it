<div id="map" {{ $attributes->class(['']) }}></div>

@push('scripts')
    <script>
        function initMap() {
            const mapElem = document.getElementById("map");

            const geo = {
                lat: {{ $monument->latitude }},
                lng: {{ $monument->longitude }}
            };

            const map = new google.maps.Map(mapElem, {
                zoom: 15.7,
                center: geo,
                minZoom: 3,
                restriction: {
                    latLngBounds: { north: 85, south: -85, west: -180, east: 180 }
                },
                mapTypeId: 'roadmap'
            });

            new google.maps.Marker({
                position: geo,
                map,
                icon: {
                    url: '{{ asset(Storage::url($monument->pin_image)) }}',
                    scaledSize: new google.maps.Size(60, 71.8)
                },
                title: '{{ $monument->name }}',
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBTr1D4oqR_NQYcN50-xynP9_-rOnWSa9w&callback=initMap"></script>
@endpush
