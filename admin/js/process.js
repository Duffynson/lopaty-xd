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
        if(other_data['status'] == 'ACCEPTED' || other_data['status'] == 'REJECTED') return;
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

const removeSelection = () => {
    try {
        document.querySelector('.form_rizeni2').remove();
        document.querySelector('.form_rizeni1').remove();
    } catch {}
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
                    if(data[e] === null) {
                        if(document.querySelector('.role_hidden').textContent == 4 || document.querySelector('.id_user_hidden').textContent == data['ID_redaktor'])
                            createReviewerSelect(e)
                        else 
                            removeSelection();
                    }
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
                case 'rizeni1_lastname':
                case 'rizeni2_lastname':
                    if(e.includes('1'))
                        if(data['recenze1_status'] == 'APPROVED') element.innerHTML = `${data[e]} <span class="text-success fw-bold"> SCHVÁLENO</span>`;
                        else if(data['recenze1_status'] == 'REJECTED') element.innerHTML = `${data[e]} <span class="text-danger fw-bold"> ZAMÍTNUTO</span>`;
                        else element.textContent = data[e] == null ? "" : data[e];
                    else 
                        if(data['recenze2_status'] == 'APPROVED') element.innerHTML = `${data[e]} <span class="text-success fw-bold"> SCHVÁLENO</span>`;
                        else if(data['recenze2_status'] == 'REJECTED') element.innerHTML = `${data[e]} <span class="text-danger fw-bold"> ZAMÍTNUTO</span>`;
                        else element.textContent = data[e] == null ? "" : data[e];
                    break;
                default:
                    element.textContent = data[e]
                    if(e === 'soubor' || e === 'soubor2') {
                        element.setAttribute('href', `../clanky/${data[e]}`)
                        if(data[e].includes('.pdf')) element.setAttribute('target', '_blank') 
                    }
            }
        } catch {}
    })
    if(data['status'] == 'ACCEPTED' || data['status'] == 'REJECTED') return;

    if(data['recenze1_status'] == 'CREATED' && data['recenze1_recenzent'] == document.querySelector('.id_user_hidden').textContent && data['status'] == 'REVIEWERS_REQUIRED') {
        document.querySelector('.process-detail-buttons').classList.remove('d-none');
    } else if (data['recenze2_status'] == 'CREATED' && data['recenze2_recenzent'] == document.querySelector('.id_user_hidden').textContent && data['status'] == 'REVIEWERS_REQUIRED') {
        document.querySelector('.process-detail-buttons').classList.remove('d-none');
    } else if((document.querySelector('.id_user_hidden').textContent == data['ID_redaktor'] || document.querySelector('.role_hidden') == 4) && (data['status'] != 'REJECTED' && data['status'] != 'ACCEPTED')) {
        document.querySelector('.process-detail-buttons').classList.remove('d-none');
    }
}

const renderProcess = async () => {
    try {
        const response = await fetch(`./php/request_process?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
        const processData = await response.json();
        if(processData.length === 0) throw new Error('No data found');
        if(processData.hasOwnProperty('auth_error')) {
            location.href = './auth-error';
            return;
        }
        const data = processData[0];
        document.querySelector('.form_rizeni2').classList.remove('d-none');
        document.querySelector('.form_rizeni1').classList.remove('d-none');
        addDataToTable(data)
        if(data['status'] == 'REVIEWS_SUBMITTED' && document.querySelector('.id_user_hidden').textContent == data['ID_redaktor']) {
            document.querySelector('.allow_upload_button').classList.remove('d-none');
            document.querySelector('.allow_upload_button').addEventListener('submit', async e => {
                e.preventDefault();
                try {
                    const response = await fetch(`./php/allow_upload.php`, {method: 'POST', body: JSON.stringify({"id": `${new URLSearchParams(window.location.search).get('id')}`})});
                    location.href = location.href;
                } catch{}
            })
        } else if(data['status'] == 'AUTHOR_REQUIRED' && document.querySelector('.id_user_hidden').textContent != data['ID_autor']) {
            const form = document.querySelector('.allow_upload_button');
            const btn = document.querySelector('.allow_upload_button .btn');
            form.classList.remove('d-none');
            btn.classList.remove('btn-primary')

            btn.classList.add('btn-success');
            btn.textContent = 'Předáno autorovi';
            btn.disabled = true;    
        } else if(data['status'] == 'AUTHOR_REQUIRED' && document.querySelector('.id_user_hidden').textContent == data['ID_autor']) {
            const form = document.querySelector('.allow_upload_button');
            const btn = document.querySelector('.allow_upload_button .btn');
            form.classList.remove('d-none');
            btn.textContent = 'Nahrát soubor';
            document.querySelector('.allow_upload_button').addEventListener('submit', async e => {
                e.preventDefault();
                try {
                    location.href = `./edit_article?id=${data['ID_article']}`;
                } catch{}
            })
        }
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

document.querySelector('.approve-process').addEventListener('submit', async e => {
    e.preventDefault();
    const response = await fetch(`./php/request_process?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
    let processData = await response.json();
    processData = processData[0];
    const userID = document.querySelector('.id_user_hidden').textContent;
    if(userID == processData['recenze1_recenzent']) {
        await fetch(`./php/update_review?ID_rizeni=${processData['ID_rizeni']}&status=APPROVED&id=${processData['recenze1_id']}`, {method: 'GET'});
    } else if(userID == processData['recenze2_recenzent']) {
        await fetch(`./php/update_review?ID_rizeni=${processData['ID_rizeni']}&status=APPROVED&id=${processData['recenze2_id']}`, {method: 'GET'});
    } else if(userID == processData['ID_redaktor']) {
        await fetch(`./php/update_process?ID_rizeni=${processData['ID_rizeni']}&status=ACCEPTED`, {method: 'GET'});
    }
    location.reload();
})

document.querySelector('.reject-process').addEventListener('submit', async e => {
    e.preventDefault();
    const response = await fetch(`./php/request_process?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
    let processData = await response.json();
    processData = processData[0];
    const userID = document.querySelector('.id_user_hidden').textContent;
    if(userID == processData['recenze1_recenzent']) {
        const response = await fetch(`./php/update_review?ID_rizeni=${processData['ID_rizeni']}&status=REJECTED&id=${processData['recenze1_id']}`, {method: 'GET'});
    } else if(userID == processData['recenze2_recenzent']) {
        const response = await fetch(`./php/update_review?ID_rizeni=${processData['ID_rizeni']}&status=REJECTED&id=${processData['recenze2_id']}`, {method: 'GET'});
    } else if(userID == processData['ID_redaktor']) {
        await fetch(`./php/update_process?ID_rizeni=${processData['ID_rizeni']}&status=REJECTED`, {method: 'GET'});
    }
    location.reload();
})

renderProcess()
