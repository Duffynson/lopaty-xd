const roles = {
    0: 'Autor',
    1: 'Recenzent',
    2: 'Redaktor',
    3: 'Šéfredaktor',
    4: 'Administrátor'
}

document.querySelector('.add_response_form').addEventListener('submit', async (e) => {
    e.preventDefault()
    hideAlert('success')
    hideAlert('danger')

    try {
        const response = await fetch(`./php/submit_response.php`, {method: 'POST', body: new FormData(e.target)})
        const responseJSON = await response.json()
        e.target.reset();
        loadResponses();
    } catch(e) {
        console.log(e);
        showAlert('Nastala chyba při přidání odpovědi.', 'danger', 0)
    }
})

document.querySelector('.close_ticket').addEventListener('click', async (e) => {
    e.preventDefault();
    try {
        const response = await fetch(`./php/update_ticket?status=CLOSED&id=${document.querySelector('#ticket_id').value}`, {method: 'GET'});
        console.log(await response.json());
        //location.reload();
    } catch(e) {
        console.log(e);
    }
})

async function loadResponses() {
    while(document.querySelector('.ticket_responses').firstChild)
        document.querySelector('.ticket_responses').removeChild(document.querySelector('.ticket_responses').firstChild)
    try {
        const response = await fetch(`./php/request_responses?id=${document.querySelector('#ticket_id').value}`, {method: 'GET'})
        const responseJSON = await response.json();
        if(responseJSON.length == 0) return;
        if(responseJSON[0].creator != document.querySelector('.id_user_hidden').textContent && responseJSON[0].role != document.querySelector('.role_hidden').textContent && document.querySelector('.role_hidden').textContent != 4) location.href = './auth-error.php'; 
        if(responseJSON[0].status != 'CLOSED') {
            if(responseJSON[0].role == document.querySelector('.role_hidden').textContent || document.querySelector('.role_hidden').textContent == 4) document.querySelector('.close_ticket').classList.remove('d-none');
            document.querySelector('.add_response').classList.remove('d-none');
            document.querySelector('#ticket_text').disabled = false
        
        }
        responseJSON.forEach(response => {
            const wrap = document.createElement('div');
            wrap.style.boxShadow = "rgba(0, 0, 0, 0.1) 0px 1px 2px 0px";
            wrap.style.backgroundColor = "#F8F8F8";
            wrap.classList.add("mt-3", "p-3", "w-1OO");
            const text = document.createElement('div');
            text.classList.add('text');
            text.textContent = response.R_text;
            const info = document.createElement('div');
            info.classList.add("info", "d-flex", "flex-row", "justify-content-end", "align-items-end", "pt-5");
            info.innerHTML = `${response.R_date}&emsp; ${response.firstname} ${response.lastname} [${roles[response.role]}]`;
            wrap.appendChild(text);
            wrap.appendChild(info);
            document.querySelector('.ticket_responses').appendChild(wrap);
        })
    } catch (e) {
        console.log(e);
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

const disableElements = (element, data, e) => {
    if(data['datum_recenze'] != null && data['recenzent'] !== document.querySelector('.id_user_hidden')) {
        e.readOnly = true; 
        e.value == data[element] ? e.checked = true : e.disabled = true; 
    }
}

loadResponses();