const table = document.querySelector('.users-table');

const roles = {
    0: 'Autor',
    1: 'Recenzent',
    2: 'Redaktor',
    3: 'Šéfredaktor',
    4: 'Administrátor'
}

const state = {
    'CREATED': 'Vytvořeno',
    'REACTED': 'Čeká na vaši odpověď',
    'WAITING': 'Čeká na odpověď podpory',
    'CLOSED': 'Ticket byl uzavřen'
}

const my_tickets = document.querySelector('.my-tickets-table');
const assigned_tickets = document.querySelector('.assigned-tickets-table');

const renderMyTickets = async () => {
    let ticketsData;
    try {
        const response = await fetch('./php/request_my_tickets.php', {method: 'GET'});
        ticketsData = await response.json();
        if(ticketsData.length < 1) return;
        const tbody = document.createElement('tbody');
        ticketsData.forEach(ticket => {
            const el = document.createElement('tr');
            el.innerHTML = `
                <td scope="col" class="px-3 text-start align-middle">${ticket.title}</td>
                <td scope="col" class="align-middle">${ticket.firstname} ${ticket.lastname}</td>
                <td scope="col" class="align-middle">${roles[ticket.id_role]}</td>
                <td scope="col" class="align-middle">${ticket.date_created}</td>
                <td scope="col" class="align-middle">${state[ticket.status]}</td>
                <td scope="col" class="align-middle"><a href="./ticket?id=${ticket.ticket_id}" class="btn-primary btn rounded-0">Zobrazit</a> </td>
            `; 
            tbody.appendChild(el);
        })
        my_tickets.firstElementChild.classList.remove('d-none');
        document.querySelector('.my_tickets_header').classList.remove('d-none');
        my_tickets.appendChild(tbody);
    } catch(e) {
        document.querySelector('.table-responsive').remove();
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat.'
        throw new Error('Error loading data!')
    }
}

const renderAssignedTickets = async () => {
    let ticketsData;
    try {
        const response = await fetch('./php/request_assigned_tickets.php', {method: 'GET'});
        ticketsData = await response.json();
        if(ticketsData.length < 1) return;
        const tbody = document.createElement('tbody');
        ticketsData.forEach(ticket => {
            const el = document.createElement('tr');
            el.innerHTML = `
                <td scope="col" class="px-3 text-start align-middle">${ticket.title}</td>
                <td scope="col" class="align-middle">${ticket.firstname} ${ticket.lastname}</td>
                <td scope="col" class="align-middle">${roles[ticket.id_role]}</td>
                <td scope="col" class="align-middle">${ticket.date_created}</td>
                <td scope="col" class="align-middle">${state[ticket.status]}</td>
                <td scope="col" class="align-middle"><a href="./ticket?id=${ticket.ticket_id}" class="btn-primary btn rounded-0">Zobrazit</a> </td>
            `; 
            tbody.appendChild(el);
        })
        assigned_tickets.firstElementChild.classList.remove('d-none');
        document.querySelector('.assigned_tickets_header').classList.remove('d-none');
        assigned_tickets.appendChild(tbody);
    } catch(e) {
        document.querySelector('.table-responsive').remove();
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat.'
        throw new Error('Error loading data!')
    }
}

const showAlert = (message, type, disposeTime) => {
    const alert = document.querySelector(`.alert-${type}`);
    alert.innerHTML = message;
    alert.classList.remove('d-none');
    alert.classList.add('d-block');
    if(disposeTime > 0) setTimeout(() => document.querySelector(`.alert-${type}`).style.display = 'none', disposeTime)
    window.scrollTo({ top: 0, behavior: 'smooth' });
} 

const hideAlert = (type) => {
    document.querySelector(`.alert-${type}`).classList.add('d-none');
    document.querySelector(`.alert-${type}`).classList.remove('d-block');
}

await renderMyTickets();
await renderAssignedTickets();