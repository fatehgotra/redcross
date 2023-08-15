@extends('layouts.admin')
@section('title', 'Interactive Mapping')
@section('head')
<link href="{{ asset('assets/css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/vendor/mapping.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Interactive Map</li>
                    </ol>
                </div>
                <h4 class="page-title">Interactive Map</h4>
            </div>
        </div>
    </div>
    @include('admin.includes.flash-message')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cname"></h2>
                </div>
                <!-- <div class="col-md-6"><h2 class="total">Total users: 12</h2></div> -->
            </div>
            <br>
            <br>
            <div id="mapa">
                <div id="lista">
                    <ul class="ulc">

                    </ul>
                </div>
                <div>
                    <input id="pac-input" class="controls form-control st" type="text" placeholder="Search Location" />
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Datatables js -->
<script src="{{ asset('assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBjzrBuBZeqiQaUzI7EJxZwtQEYFfkBnhs&li&callback=initAutocomplete&libraries=places&v=weekly" async defer></script>

<script>
    function initAutocomplete() {

        const map = new google.maps.Map(document.getElementById("map"), {
            center: {
                lat: -18.143370,
                lng: 178.437164
            },
            zoom: 11,


        });

        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);


        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        let markers = [];
        let cmaker = [{}];

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }

            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];

            const bounds = new google.maps.LatLngBounds();

            places.forEach((place) => {
                if (!place.geometry || !place.geometry.location) {
                    console.log("Returned place contains no geometry");
                    return;
                }

                const icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };

                const svgMarker = {
                    path: "M-1.547 12l6.563-6.609-1.406-1.406-5.156 5.203-2.063-2.109-1.406 1.406zM0 0q2.906 0 4.945 2.039t2.039 4.945q0 1.453-0.727 3.328t-1.758 3.516-2.039 3.070-1.711 2.273l-0.75 0.797q-0.281-0.328-0.75-0.867t-1.688-2.156-2.133-3.141-1.664-3.445-0.75-3.375q0-2.906 2.039-4.945t4.945-2.039z",
                    fillColor: "blue",
                    fillOpacity: 1,
                    strokeWeight: 0,
                    rotation: 0,
                    scale: 2,
                    anchor: new google.maps.Point(0, 20),
                };

                //$('.cname').html('Search city : ' + place.name);



                if (place.name != '') {
                    $.ajax({
                        url: '{{ route("admin.local-user") }}',
                        type: 'POST',
                        dataType: 'JSON',
                        data: {
                            _token: '{{ csrf_token() }}',
                            city: place.name
                        },
                        success: function(res) {

                            if (res.users.length > 0) {
                                let usr = res.users;
                                for (let u in usr) {

                                    let address = (usr[u].contact_information.resedential_address);

                                    var geocoder1 = new google.maps.Geocoder();

                                    geocoder1.geocode({
                                        'address': address
                                    }, function(results, status) {

                                        if (status == google.maps.GeocoderStatus.OK) {
                                            //  var latitude = results[0].geometry.location.lat();
                                            // var longitude = results[0].geometry.location.lng();


                                            markers.push(
                                                new google.maps.Marker({
                                                    map,
                                                    title: usr[u].firstname + " " + usr[u].lastname,
                                                    position: results[0].geometry.location,
                                                    label: (usr[u].role == 'volunteer') ? 'V' : ((usr[u].role == 'member') ? 'M' : 'B')
                                                })
                                            );



                                        }
                                    });

                                }

                            }
                            $m = (res.users.length > 0) ? "s." : '.';
                            $('.cname').html('Search city : ' + place.name + " | Found : " + res.users.length + " record" + $m);
                            showUsers(res);
                        }
                    });
                }

                markers.push(
                    new google.maps.Marker({
                        map,
                        icon,
                        title: place.name,
                        position: place.geometry.location,
                    }),
                );

                if (place.geometry.viewport) {

                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            map.fitBounds(bounds);
        });

        function placeMarker(users, location) {

            markers.forEach((marker) => {
                marker.setMap(null);
            });
            markers = [];

            var geocoder1 = new google.maps.Geocoder();

            if (users.length > 0) {
                let usr = users;
                for (let u in usr) {

                    let address = (usr[u].contact_information.resedential_address);



                    geocoder1.geocode({
                        'address': address
                    }, function(results, status) {

                        if (status == google.maps.GeocoderStatus.OK) {
                            //  var latitude = results[0].geometry.location.lat();
                            // var longitude = results[0].geometry.location.lng();


                            markers.push(
                                new google.maps.Marker({
                                    map,
                                    title: usr[u].firstname + " " + usr[u].lastname,
                                    position: results[0].geometry.location,
                                    label: (usr[u].role == 'volunteer') ? 'V' : ((usr[u].role == 'member') ? 'M' : 'B')
                                })
                            );




                        }
                    });

                }

            }

        }

        //click Map Start
        var geocoder = new google.maps.Geocoder();
        map.addListener('click', (event) => {

            geocoder.geocode({
                location: event.latLng,
            }, (results, status) => {
                if (status === 'OK') {
                    if (results && results.length) {
                        var filtered_array = results.filter(result => result.types.includes("locality"));
                        var addressResult = filtered_array.length ? filtered_array[0] : results[0];

                        if (addressResult.address_components) {
                            addressResult.address_components.forEach((component) => {
                                if (component.types.includes('locality')) {


                                    if (component.long_name != '') {
                                        $.ajax({
                                            url: '{{ route("admin.local-user") }}',
                                            type: 'POST',
                                            dataType: 'JSON',
                                            data: {
                                                _token: '{{ csrf_token() }}',
                                                city: component.long_name
                                            },
                                            success: function(res) {
                                                placeMarker(res.users, event.latLng);
                                                $m = (res.users.length > 0) ? "s." : '.';
                                                $('.cname').html('Search city : ' + component.long_name + " | Found : " + res.users.length + " record" + $m);
                                                showUsers(res);
                                            }
                                        });
                                    }
                                }
                            });
                        }
                    }
                }
            });
        });
        //Click map end
    }

    window.initAutocomplete = initAutocomplete;

    function showUsers(res) {
        let html = '';
        if (res.users.length > 0) {
            let usr = res.users;

            for (let u in usr) {
                let adr = (usr[u].contact_information) ? usr[u].contact_information.resedential_address : 'NA';
                let cls = (usr[u].status == 'approve') ? 'text-success' : ((usr[u].status == 'pending') ? 'text-warning' : 'text-danger');
                html += '<li class="lic">';
                html += '<a href="/admin/volunteer/lodge-information/' + usr[u].id + '" target="_blank"><b><i class="mdi mdi-account-hard-hat"></i>' + usr[u].firstname + " " + usr[u].lastname + '<span class="float-end ' + cls + '"> Approved </span></b></a>';
                html += '<br><span><i class="mdi mdi-magnify"></i>Role : ' + usr[u].role + '</span>';
                html += '<br><span><i class="mdi mdi-mail"></i>Email : ' + usr[u].email + '</span>';
                html += '<br><span><i class="mdi mdi-phone"></i>Contact : ' + usr[u].phone + '</span>';
                html += '<br><span><i class="mdi mdi-map-marker"></i>Address : ' + adr + '</span>';
                html += '</li>';
            }
            $('.ulc').empty().append(html);
        } else {

            html = '<li class="lic"><a href="javascript:void(0)"><b>No Record Found!</b></a></li>';
            $('.ulc').empty().append(html);
        }
    }
</script>

<!-- Datatable Init js -->
<script>
    $(function() {
        $("#basic-datatable").DataTable({
            "paging": true,
            "pageLength": 20,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "order": [
                [0, 'desc']
            ]
        });
    });
</script>

@endpush