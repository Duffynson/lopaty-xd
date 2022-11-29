import { state } from './state.js';

const elements = [document.querySelector('.process-table'), document.querySelector('.article-table'), document.querySelector('.process-detail-buttons')];

const createReviewerSelect = async (element) => {
    try {
        const response = await fetch(`./php/request_reviewers?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
        const reviewerData = await response.json();
        const length = reviewerData.length;
        for(let i = 0; i < length; i++) {
            const data = reviewerData[i];
            let opt = document.createElement('OPTION')
            opt.value = data.ID_user;
            opt.textContent = `${data.firstname} ${data.lastname}`
            document.querySelector(`.${element} #${element}_select`).appendChild(opt)
        }
    } catch(e) {
        elements.forEach(e => e.remove())
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

const showButtons = (other_data, data, data2, data3, element) => {
    if(other_data[data] == null) {
        if(document.querySelector('.id_user_hidden').textContent == other_data[data2]) {
            element.classList.remove('d-none');
            element.setAttribute('href', `./review?id=${other_data[data3]}`);
            element.textContent = "Zadat recenzi"
        }
    } else {
        element.classList.remove('d-none');
        element.setAttribute('href', `./review?id=${other_data[data3]}`);
    }
}

const addDataToTable = (data) => {
    Object.keys(data).forEach(e => {
        try {
            const element = document.querySelector(`.process-detail .${e}`)
            switch(e) {
                case 'status':
                    element.textContent = state[data[e]]
                    break;
                case 'rizeni1_firstname':
                case 'rizeni2_firstname':
                    if(data[e] === null) createReviewerSelect(e)
                    else {
                        element.textContent = data[e]
                        if(e.includes('1')) {
                            showButtons(data, 'recenze1_datum_recenze', 'recenze1_recenzent', 'recenze1_id', document.querySelector('.show_rizeni1'));
                        }
                        else {
                            showButtons(data, 'recenze2_datum_recenze', 'recenze2_recenzent', 'recenze2_id', document.querySelector('.show_rizeni2'));
                        }
                    }
                    break;
                default:
                    element.textContent = data[e]
                    if(e === 'soubor' || e === 'soubor2') {
                        element.setAttribute('href', `../clanky/${data[e]}`)
                    }
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
        document.querySelector('.form_rizeni2').classList.remove('d-none');
        document.querySelector('.form_rizeni1').classList.remove('d-none');
        addDataToTable(data)
    } catch(e) {
        elements.forEach(e => e.remove())
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

document.querySelector('.form_rizeni1').addEventListener('submit', async e => {
    e.preventDefault();
        const response = await fetch(`./php/add_reviewer.php`, {method: 'POST', body: new FormData(e.target)})
        location.reload();
})

document.querySelector('.form_rizeni2').addEventListener('submit', async e => {
    e.preventDefault();
        const response = await fetch(`./php/add_reviewer.php`, {method: 'POST', body: new FormData(e.target)})
        location.href = location.href;
})
renderProcess()
