document.addEventListener('DOMContentLoaded', function () {
    const seats = document.querySelectorAll('.seat');
    const count = document.getElementById('count');
    const total = document.getElementById('total');
    const proceedButton = document.querySelector('.proceed-btn button');

    let selectedSeatsCount = 0;
    let totalCost = 0;
    let lockedSeats = [];

    // console.log(seatNumbers);

    seatNumbers.forEach(function(seatId) {
        var seatElement = document.getElementById(seatId);
        if (seatElement) {
            seatElement.classList.add('reserved');
        }
    });

    // Function to update count and total
    function updateSelectedCount() {
        const selectedSeats = document.querySelectorAll('.seat.selected');
        selectedSeatsCount = selectedSeats.length;
        totalCost = selectedSeatsCount * ticketPrice; // You can adjust the price per seat

        count.innerText = selectedSeatsCount;
        total.innerText = totalCost;
    }

    // Function to handle seat selection
    function toggleSeatSelection(seat) {
        if (!seat.classList.contains('reserved')) {
            if (seat.classList.contains('selected')) {
                seat.classList.remove('selected');
                const seatIndex = lockedSeats.indexOf(seat.id);
                if (seatIndex !== -1) {
                    lockedSeats.splice(seatIndex, 1);
                }
            } else {
                seat.classList.add('selected');
                lockedSeats.push(seat.id);
                seatIndex = lockedSeats;
            }

            updateSelectedCount();

            sessionStorage.setItem("NO-SEATS", selectedSeatsCount);
            sessionStorage.setItem("TOTAL", totalCost);
        }
    }

    // Event listener for seat clicks
    seats.forEach(function (seat) {
        seat.addEventListener('click', function () {
            toggleSeatSelection(seat);
        });
    });

    // Event listener for the Proceed button
    proceedButton.addEventListener('click', function () {
        if (selectedSeatsCount > 0) {
            lockedSeats.forEach(function (seatId) {
                const seat = document.getElementById(seatId);
                seat.classList.remove('selected');
                seat.classList.add('reserved');
            });
            updateSelectedCount();

            const movieName = document.getElementById('movie_name').value;
            const dateSelected = document.getElementById('date').value;
            const timeSelected = document.getElementById('time').value;
            const locationSelected = document.getElementById('location').value;

            sessionStorage.setItem("MOVIE", movieName);
            sessionStorage.setItem("DATE", dateSelected);
            sessionStorage.setItem("TIME", timeSelected);
            sessionStorage.setItem("LOCATION", locationSelected);
            sessionStorage.setItem("SEAT-NUMBERS", seatIndex);
            localStorage.setItem("LOCKED-SEATS", lockedSeats);
            
            return;
        } else {
            alert('Please select at least one seat before proceeding.');
        }
    });
});
