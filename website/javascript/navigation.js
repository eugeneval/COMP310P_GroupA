function eventCookie(event_id) {
    Cookies.set('event', event_id, { expires: 0.0001 });
    return true;
}
