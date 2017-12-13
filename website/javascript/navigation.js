// Be sure to also include libraries/js.cookie.js !!!

function eventCookie(event_id) {
    Cookies.set('event', event_id, { expires: 0.0001 });
    return true;
}

function ticketCookie(ticket_ID) {
    Cookies.set('ticket', ticket_ID, { expires: 0.0001 });
    return true;
}
