import { state } from './state.js';

const elements = [document.querySelector('.process-table'), document.querySelector('.article-table'), document.querySelector('.process-detail-buttons')];

const addDataToTable = (data) => {
    Object.keys(data).forEach(e => {
        try {
            const element = document.querySelector(`.process-detail .${e}`)
            switch(e) {
                case 'status':
                    element.textContent = state[data[e]]
                    break;
                case 'soubor':
                    break;
                default:
                    element.textContent = data[e]
            }
        } catch {}
    })
}

const renderProcess = async () => {
    try {
        const response = await fetch(`./php/request_process?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
        const processData = await response.json();
        if(processData.length === 0) throw new Exception('No data found');
        const data = processData[0];
        addDataToTable(data)
    } catch(e) {
        elements.forEach(e => e.remove())
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

renderProcess()
