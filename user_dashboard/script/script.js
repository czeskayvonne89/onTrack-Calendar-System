const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

function generateCalendar(month, year) {
    document.getElementById('month-name').textContent = `${monthNames[month]} ${year}`;
    const daysContainer = document.getElementById('days');
    daysContainer.innerHTML = '';

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
        daysContainer.innerHTML += '<div></div>';
    }

    for (let i = 1; i <= daysInMonth; i++) {
        daysContainer.innerHTML += `<div>${i}</div>`;
    }
}

function prevMonth() {
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    currentYear = (currentMonth === 11) ? currentYear - 1 : currentYear;
    generateCalendar(currentMonth, currentYear);
}

function nextMonth() {
    currentMonth = (currentMonth === 11) ? 0 : currentMonth + 1;
    currentYear = (currentMonth === 0) ? currentYear + 1 : currentYear;
    generateCalendar(currentMonth, currentYear);
}

document.addEventListener('DOMContentLoaded', () => {
    generateCalendar(currentMonth, currentYear);
});
