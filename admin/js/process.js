const my_processes = document.querySelector('.my-processes-table');
const unclaimed_processes = document.querySelector('.unclaimed-processes-table');

const state = {
    'WAITING_FOR_EDITOR': 'Čeká na přiřazení redaktora',
    'WAITING_FOR_REVIEWERS': 'Čeká na přiřazení recenzentů',
    'WAITING_FOR_REVIEWS': 'Čeká na recenze',
    'REVIEWS_SUBMITTED': 'Recenze přidány, čeká na redaktora',
    'AUTHOR_REQUIRED': 'Čeká na akci autora',
    'EDITOR_REQUIRED': 'Čeká na akci redaktora',
    'ACCEPTED': 'Článek byl přijat',
    'REJECTED': 'Článek byl zamítnut'
}

const elements = [document.querySelector('.process-table'), document.querySelector('.article-table'), document.querySelector('.process-detail-buttons')];

const renderProcess = async () => {
    try {
        const response = await fetch(`./php/request_process?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
        const processData = await response.json();
        if(processData.length === 0) throw new Exception('No data found'); 
        console.log(processData);
        //Object.values(document.querySelector('.article-table').firstElementChild.children).forEach(e => console.log(e))
    } catch(e) {
        console.log(e);
        elements.forEach(e => e.remove())
        document.querySelector('.alert-danger').classList.remove('d-none');
        document.querySelector('.alert-danger').textContent = 'Nastala chyba při načítání dat'
    }
}

renderProcess()
