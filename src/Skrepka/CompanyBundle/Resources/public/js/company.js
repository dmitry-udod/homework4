$(function(){
    $("#company_category").children("optgroup[label=not_show]").remove();
    $("#company_category").children("optgroup[label=not_show]").children().remove();
    $("#company_category").select2();
    $("#company_city").select2();
    $('.tip').tooltip();

    $('#company_address').blur(function() {
        setPointer();
    });

})

function setPointer() {
    GMaps.geocode({
        address: 'Черкассы ' + $('#company_address').val().trim(),
        callback: function(results, status){
            if(status=='OK'){
                var latlng = results[0].geometry.location;
                map.setCenter(latlng.lat(), latlng.lng());
                map.removeMarkers();
                map.addMarker({
                    lat: latlng.lat(),
                    lng: latlng.lng()
                });
                $('#company_lat').val(latlng.lat());
                $('#company_long').val(latlng.lng());
            }
        }
    });
}

function initMap(lat, long)
{
    map = new GMaps({
        div: '#map',
        lat: 49.4444330,
        lng: 32.0597671
    });

    if (lat && long) {
        map.setCenter(lat, long);
        map.addMarker({
            lat: lat,
            lng: long
        });
        $('#company_lat').val(lat);
        $('#company_long').val(long);
    }
}
