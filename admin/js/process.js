import { state } from './state.js';

const my_processes = document.querySelector('.my-processes-table');
const unclaimed_processes = document.querySelector('.unclaimed-processes-table');

const elements = [document.querySelector('.process-table'), document.querySelector('.article-table'), document.querySelector('.process-detail-buttons')];

const renderProcess = async () => {
    try {
        const response = await fetch(`./php/request_process?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
        const processData = await response.json();
        if(processData.length === 0) throw new Exception('No data found'); 
        console.log(processData);
        //Object.values(document.querySelector('.process-detail').querySelectorAll('table').forEach(e => e.querySelectorAll('td').forEach(el => console.log(el))))
    } catch(e) {
        console.log(e);
        elements.forEach(e => e.remove())
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

renderProcess()
