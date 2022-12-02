document.querySelector('.add-review').addEventListener('submit', async (e) => {
    e.preventDefault()
    hideAlert('success')
    hideAlert('danger')

    try {
        const response = await fetch(`./php/submit_review.php`, {method: 'POST', body: new FormData(e.target)})
        const responseJSON = await response.json()
        const keys = Object.keys(responseJSON)
        showAlert(responseJSON[keys[0]], keys, 0)
        e.target.reset();
        setTimeout(() => location.href = `./process?id=${document.querySelector('.ID_rizeni').value}`, 2000)
    } catch(e) {
        showAlert('Nastala chyba při ukládání recenze.', 'danger', 0)
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

const disableElements = (element, data, e) => {
    if(data['datum_recenze'] != null && data['recenzent'] !== document.querySelector('.id_user_hidden')) {
        e.readonly = true; 
        e.value == data[element] ? e.checked = true : e.checked = false; 
    }
}

const loadReview = async () => {
    try {
        const response = await fetch(`./php/request_review.php?id=${new URLSearchParams(window.location.search).get('id')}`, {method: 'GET'});
        const responseJSON = await response.json();
        const data = responseJSON[0];
        const role = document.querySelector('.role_hidden').textContent;
        const id = document.querySelector('.id_user_hidden').textContent;

        if(role < 3 && (id != data['recenzent'] && id != data['ID_autor'] && id != data['ID_redaktor'] && id != data['recenzent2'] && id != data['recenzent1'])) location.href = './auth-error'
        document.querySelectorAll('.aktualnost').forEach(e => disableElements('aktualnost', data, e))

        document.querySelectorAll('.originalita').forEach(e => disableElements('originalita', data, e))
        document.querySelectorAll('.odbornost').forEach(e => disableElements('odbornost', data, e))
        document.querySelectorAll('.jazyk').forEach(e => disableElements('jazyk', data, e))
        if(data['datum_recenze'] != null && data['recenzent'] !== document.querySelector('.id_user_hidden')) {
            document.querySelector('.comment').readonly = true;
            document.querySelector('.comment').value = data['comment']
            document.querySelector('.submit_review').remove();
        } else {
            document.querySelector('.submit_review').classList.remove('d-none');
        }
        document.querySelector('.ID_rizeni').value = data['ID_rizeni']
    } catch {}
}

loadReview();
