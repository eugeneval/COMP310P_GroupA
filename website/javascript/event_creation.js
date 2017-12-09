function newVenue() {
    if (document.getElementById('venue').value == "new_venue") {
        document.getElementById('new_venue').style.display = 'block';
    } else {
        document.getElementById('new_venue').style.display = 'none';
    }

}
