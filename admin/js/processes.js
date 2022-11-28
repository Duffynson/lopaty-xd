import { state } from './state.js';

const my_processes = document.querySelector('.my-processes-table');
const unclaimed_processes = document.querySelector('.unclaimed-processes-table');

const renderMyProcesses = async () => {
    try {
        const response = await fetch('./php/request_my_processes.php', {method: 'GET'});
        const processData = await response.json();
        if(processData.length === 0) return;
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
        document.querySelector('.my_processes_header').classList.remove('d-none');
        my_processes.firstElementChild.classList.remove('d-none');
        my_processes.appendChild(tbody);
    } catch(e) {
        document.querySelector('.my-processes-table').remove()
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

const renderUnclaimedProcesses = async () => {
    try {
        const response = await fetch('./php/request_unclaimed_processes.php', {method: 'GET'});
        const processData = await response.json();
        //TODO: No data returned
        if(processData.length === 0) return; 
        const tbody = document.createElement('tbody');
        processData.forEach(process => {
            const el = document.createElement('tr');
            el.innerHTML = `
                <td scope="col" class="px-3 text-start">${process.ID_rizeni}</td>
                <td scope="col" class="">${process.title}</td>
                <td scope="col" class="">${state[process.status]}</td>
                <td scope="col" class="">${process.datum_vytvoreni}</td>
                <td scope="col" class=""><a href="./php/claim_process?id=${process.ID_rizeni}" class="btn btn-success ">Převzít řízení</a> </td>
            `; 
            tbody.appendChild(el);
        })
        document.querySelector('.unclaimed_processes_header').classList.remove('d-none');
        unclaimed_processes.firstElementChild.classList.remove('d-none');
        unclaimed_processes.appendChild(tbody);
    } catch(e) {
        document.querySelector('.unclaimed-processes-table').remove()
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

renderMyProcesses()
renderUnclaimedProcesses()
