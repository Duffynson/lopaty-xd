import { state } from './state.js';

const my_processes = document.querySelector('.my-processes-table');
const unclaimed_processes = document.querySelector('.unclaimed-processes-table');

const renderMyProcesses = async () => {
    let processData;
    try {
        const response = await fetch('./php/request_my_processes.php', {method: 'GET'});
        processData = await response.json();
        const tbody = document.createElement('tbody');
        processData.forEach(process => {
            const el = document.createElement('tr');
            el.innerHTML = `
                <td scope="col" class="px-3 text-start">${process.ID_rizeni}</td>
                <td scope="col" class="">${process.title}</td>
                <td scope="col" class="">${state[process.status]}</td>
                <td scope="col" class="">${process.datum_vytvoreni}</td>
                <td scope="col" class=""><a href="./process?id=${process.ID_rizeni}" class="btn-primary btn">Detail řízení</a> </td>
            `; 
            tbody.appendChild(el);
        })
        if(document.querySelector('.role_hidden').textContent < 3) document.querySelector('.my_processes_header').classList.remove('d-none');
        my_processes.firstElementChild.classList.remove('d-none');
        my_processes.appendChild(tbody);
    } catch(e) {
        document.querySelector('.my_processes_header').remove();
        if(processData == null) return;
        document.querySelector('.table-responsive').remove();
        document.querySelector('.unclaimed_processes_header').remove()
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat.'
        throw new Error('Error loading data!')
    }
}

const renderUnclaimedProcesses = async () => {
    if(document.querySelector('.role_hidden').textContent != 2) return;
    try {
        const response = await fetch('./php/request_unclaimed_processes.php', {method: 'GET'});
        const processData = await response.json();
        const tbody = document.createElement('tbody');
        processData.forEach(process => {
            const el = document.createElement('tr');
            el.innerHTML = `
                <td scope="col" class="px-3 text-start">${process.ID_rizeni}</td>
                <td scope="col" class="">${process.title}</td>
                <td scope="col" class="">${state[process.status]}</td>
                <td scope="col" class="">${process.datum_vytvoreni}</td>
                <td scope="col" class="claim_process_link"><a href="./php/claim_process?id=${process.ID_rizeni}" class="btn btn-success ">Převzít řízení</a> </td>
            `;
            tbody.appendChild(el);
        })
        if(document.querySelector('.role_hidden') != 2) document.querySelectorAll('.claim_process_link').forEach(e => e.remove())
        document.querySelector('.unclaimed_processes_header').classList.remove('d-none');
        unclaimed_processes.firstElementChild.classList.remove('d-none');
        unclaimed_processes.appendChild(tbody);
    } catch(e) {
        resolveError();
        document.querySelector('.my_processes_header').remove();
        document.querySelector('.table-responsive').remove();
        document.querySelector('.unclaimed_processes_header').remove()
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

await renderMyProcesses()
await renderUnclaimedProcesses()
