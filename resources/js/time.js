document.querySelectorAll('[data-datetime]').forEach(el => {
    const utcDate = new Date(el.dataset.datetime);
    const format = el.dataset.format || 'default';

    const day = String(utcDate.getDate()).padStart(2, '0');
    const month = String(utcDate.getMonth() + 1).padStart(2, '0');
    const year = utcDate.getFullYear();

    const hours = String(utcDate.getHours()).padStart(2, '0');
    const minutes = String(utcDate.getMinutes()).padStart(2, '0');

    let formatted;

    switch (format) {
        case 'short':
            formatted = `${day}.${month}.${year}`;
            break;
        case 'time-only':
            formatted = `${hours}:${minutes}`;
            break;
        case 'long':
        default:
            formatted = `Дата: ${day}.${month}.${year} Время: ${hours}:${minutes}`;
            break;
    }

    el.textContent = formatted;
});

