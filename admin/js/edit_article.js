const load = async () => {
    try {
        const response = await fetch(`./php/request_article?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'POST',})
        const responseJSON = await response.json()
        if(responseJSON[0]['ID_user'] == null) throw new Error('No data found');
        if(responseJSON[0]['ID_user'] != document.querySelector('.id_user_hidden').textContent) location.href = './auth-error'
        if(responseJSON[0]['soubor2'] != null) location.href = './';
    } catch(e) {
        document.querySelector('.container').remove();
        showAlert('Při načítání článku nastala chyba.', 'danger', 0);
    }
}

load();

document.querySelector('.edit-article').addEventListener('submit', async e => {
    e.preventDefault()
    hideAlert('success')
    hideAlert('danger')
    try {
        const response = await fetch('./php/edit_article', {method: 'POST', body: new FormData(e.target)})
        const responseJSON = await response.json()
        const keys = Object.keys(responseJSON)
        showAlert(responseJSON[keys[0]], keys, 0)
        e.target.reset();
        setTimeout(() => location.href = `./process?id=${responseJSON[keys[1]]}`, 2000)
    } catch(e) {
        showAlert('Nastala chyba při ukládání článku.', 'danger', 0)
    }
}) 

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