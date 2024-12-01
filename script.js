let map;

function initMap() {
    navigator.geolocation.getCurrentPosition(
        (position) => {
            const userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map = new google.maps.Map(document.getElementById("map"), {
                center: userLocation,
                zoom: 15,
            });

            new google.maps.Marker({
                position: userLocation,
                map: map,
            });
        },
        () => alert("Geolocalizzazione non consentita!")
    );
}

document.getElementById("submitReport").addEventListener("click", () => {
    const description = document.getElementById("description").value;
    const photo = document.getElementById("photo").files[0];

    if (description && photo) {
        alert("Segnalazione inviata con successo!");
    } else {
        alert("Completa tutti i campi prima di inviare.");
    }
});
