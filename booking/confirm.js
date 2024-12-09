window.addEventListener('load', () => {
    const movieName = sessionStorage.getItem('MOVIE');
    const dateSelected = sessionStorage.getItem('DATE');
    const timeSelected = sessionStorage.getItem('TIME');
    const locationSelected = sessionStorage.getItem('LOCATION');
    const selectedSeatsCount = sessionStorage.getItem('NO-SEATS');
    const seatIndex = sessionStorage.getItem('SEAT-NUMBERS');
    const totalCost = sessionStorage.getItem('TOTAL');

    document.getElementById('movie_name').setAttribute('value', movieName);
    document.getElementById('date').setAttribute('value', dateSelected);
    document.getElementById('time').setAttribute('value', timeSelected);
    document.getElementById('location').setAttribute('value', locationSelected);
    document.getElementById('no_seats').setAttribute('value', selectedSeatsCount);
    document.getElementById('seat_numbers').setAttribute('value', seatIndex);
    document.getElementById('total').setAttribute('value', totalCost);
});


