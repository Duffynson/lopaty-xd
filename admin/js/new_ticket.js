document.querySelector('.new_ticket_form').addEventListener('submit', async (e) => {
    e.preventDefault()
    hideAlert('success')
    hideAlert('danger')
    try {
        const response = await fetch(`./php/submit_ticket.php`, {method: 'POST', body: new FormData(e.target)})
        const responseJSON = await response.json()
        const keys = Object.keys(responseJSON)
        showAlert(responseJSON[keys[0]], keys, 0)
        e.target.reset();
        setTimeout(() => location.href = `./ticket?id=${responseJSON[keys[1]]}`, 2000);
    } catch(e) {
        showAlert('Nastala chyba při vytváření ticketu', 'danger', 0)
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
