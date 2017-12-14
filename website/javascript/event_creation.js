function newVenue() {
    if (document.getElementById('venue').value == "new_venue") {
        document.getElementById('new_venue').style.display = 'block';
    } else {
        document.getElementById('new_venue').style.display = 'none';
    }

}

function checkTimes() {
    tStart = new Date(document.getElementById('ticket_start').valueAsDate);
    tEnd = new Date(document.getElementById('ticket_end').valueAsDate);
    eStart = new Date(document.getElementById('event_start').valueAsDate);
    eEnd = new Date(document.getElementById('event_end').valueAsDate);
    now = new Date();


    if (tStart >= tEnd) {
        alert("You cannot start your event after it ends!");
        return false;
    } else if (eStart >= eEnd) {
        alert("You cannot start selling tickets after you stop selling tickets!");
        return false;
    } else if (tStart >= eStart) {
        alert("You cannot start selling tickets after the event starts!");
        return false;
    } else if (tEnd >= eEnd) {
        alert("You cannot stop selling tickets after yiur event ends!");
        return false;
    } else if (eEnd >= now) {
        alert("You cannot make events in the past!");
        return false;
    } else if (tEnd >= now) {
        alert("You can't finish selling tickets in the past!");
        return false;
    } else {
        return true;
    }


}
