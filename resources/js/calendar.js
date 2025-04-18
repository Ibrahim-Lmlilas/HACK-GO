import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    if (calendarEl) {
        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin],
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            height: 'auto',
            dayMaxEvents: true,
            initialDate: new Date(), // اليوم
            events: [
                {
                    title: "Today",
                    start: new Date().toISOString().slice(0, 10), // تاريخ اليوم بصيغة yyyy-mm-dd
                    display: 'background',
                    backgroundColor: '#8a2be2',
                }
            ]
        });

        calendar.render();
    }
});
