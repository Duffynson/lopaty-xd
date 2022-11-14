/*
Vypsání uživatelských dat do formuláře
*/

const getUserData = async (id_user) => {
    let response;
    try {
        response = await (await fetch(`./php/request_user.php?id=${id_user}`, {method: 'GET'})).json();
        Object.keys(response).forEach(e => document.querySelector(`.user-detail #${e}`).value = response[e])
        const el = document.querySelector('.user-detail #role');
        el.querySelector(`option[value="${response.role}"]`).selected = true;
        document.querySelector('.user-detail').classList.remove('d-none');
        document.querySelector('.change-password').classList.remove('d-none');
    } catch (error) {
        document.querySelector('.user-detail').remove()
        document.querySelector('.change-password').remove()
        showAlert('Nastala chyba při načítání dat', 'danger', 0);
    }
}

getUserData(new URLSearchParams(window.location.search).get('id'))

/*
Odeslání formuláře pro změnu uživatelských dat
*/
document.querySelector('.user-detail').addEventListener('submit', async (e) => {
    e.preventDefault();
    hideAlert('success');
    hideAlert('danger');
    try {
        const response = await fetch('./php/edit_user.php', {method: 'POST', body: new FormData(e.target)});
        const responseJSON = await response.json();
        document.querySelectorAll('.user-detail .error-message').forEach(e => e.innerHTML = '&nbsp;')
        
        Object.keys(responseJSON).forEach(e => {
            if(e === 'success' || e === 'error') 
                showAlert(responseJSON[e], e === 'success' ? 'success' : 'danger', 0);
            else document.querySelector(`.user-detail .${e}`).textContent = responseJSON[e]
        })
    } catch(e) {
        showAlert('Nastala chyba při ukládání dat', 'danger', 0);
    }
    
})

/*
Změna hesla, převzato z registrace
*/

document.querySelector('.change-password #password').addEventListener('input', e => {
    const pass_again = document.querySelector('.change-password #password_again')
    const element = document.querySelector('.change-password .password-error')
    if(e.target.value.length < 8) {
        element.classList.remove("success")
        element.innerHTML = "Heslo musí mít alespoň 8 znaků"
        return;
    } else {
       element.innerHTML = "Heslo je v pořádku"
       element.classList.add("success");
    }
    pass_again.dispatchEvent(new Event('input'))
}) 

document.querySelector('.change-password #password_again').addEventListener('input', e => {
    const pass_element = document.querySelector('.change-password #password')
    const pass_again_error = document.querySelector('.change-password .password_again-error')
    const button = document.querySelector('.change-password .change-password-button')
    if(e.target.value.length === 0) {
        button.disabled = true;
        pass_again_error.innerHTML = "&nbsp";
        return;
    }
    if(e.target.value != pass_element.value) {
        pass_again_error.innerHTML = "Hesla se neshodují"
        button.disabled = true;
    } else if(e.target.value.length < 8 && e.target.value === pass_element.value) {
        pass_again_error.innerHTML = "&nbsp";
        button.disabled = true;
        pass_element.dispatchEvent(new Event('input'))
    } else {
        pass_again_error.innerHTML = "&nbsp";
        button.disabled = false;
    }
})

document.querySelector('.change-password').addEventListener('submit', async (e) => {
    e.preventDefault();
    hideAlert('success');
    hideAlert('danger');
    try {
        const response = await fetch('./php/change_password.php', {method: 'POST', body: new FormData(e.target)});
        const responseJSON = await response.json();
        document.querySelectorAll('.change-password .error-message').forEach(e => e.innerHTML = '&nbsp;')
            
        Object.keys(responseJSON).forEach(e => {
            if(e === 'success' || e === 'error') {
                showAlert(responseJSON[e], e === 'success' ? 'success' : 'danger', 0);
                document.querySelector('.change-password').reset();
            }
            else document.querySelector(`.user-detail .${e}`).textContent = responseJSON[e]
        })
    } catch(e) {
        showAlert('Nastala chyba při ukládání dat', 'danger', 0);
    }
})

const showAlert = (message, type, disposeTime) => {
    const alert = document.querySelector(`.alert-${type}`);
    alert.textContent = message;
    alert.classList.remove('d-none');
    alert.classList.add('d-block');
    if(disposeTime > 0) setTimeout(() => document.querySelector(`.alert-${type}`).style.display = 'none', disposeTime)
    window.scrollTo({ top: 0, behavior: 'smooth' });
} 

const hideAlert = (type) => {
    document.querySelector(`.alert-${type}`).classList.add('d-none');
    document.querySelector(`.alert-${type}`).classList.remove('d-block');
}