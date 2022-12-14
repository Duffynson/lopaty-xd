document.querySelector('.add-article').addEventListener('submit', async (e) => {
    e.preventDefault()
    hideAlert('success')
    hideAlert('danger')
    try {
        const response = await fetch(`./php/submit_article.php`, {method: 'POST', body: new FormData(e.target)})
        const responseJSON = await response.json()
        const keys = Object.keys(responseJSON)
        showAlert(responseJSON[keys[0]], keys, 0)
        if(keys != 'error') {
            setTimeout(() => location.href = './processes', 2000);
            e.target.reset();
        }
    } catch(e) {
        showAlert('Nastala chyba při ukládání článku.', 'danger', 0)
    }
})


const load = () => {
    if(document.querySelector('.role_hidden').textContent != 0 && document.querySelector('.role_hidden').textContent != 4) location.href = './auth-error'
}

load();

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
