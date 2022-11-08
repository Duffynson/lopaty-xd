/*
vyresetuje všechny chybové a úspěšné hlášky
dostane data ve formátu JSON, kde je klíčem třída prvku pro zobrazení chybového hlašení a hodnotou je text chybového hlašení
pokud byla registrace úspěšná, dostane pouze jeden klíč 'success' s textem úspěšného hlašení, který se zobrazí a po 2s se přesměruje na index.php
pokud nebyla úspěšná, zobrazí chybové hlášení pod každým inputem s chybou
*/

document.querySelector('.register-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    try {
        const response = await fetch('./php/register.php', {method: 'POST', body: new FormData(e.target)});
        const responseJSON = await response.json();

        document.querySelectorAll('.register-form .error-message').forEach(e => e.innerHTML = '&nbsp;')
        document.querySelector(`.register-form .error`).classList.remove("success")
        
        Object.keys(responseJSON).forEach(e => {
            if(e === 'success') {
                document.querySelector('.register-form').reset()
                document.querySelector(`.register-form .error`).classList.add("success")
                document.querySelector(`.register-form .error`).innerHTML = responseJSON[e];
                setTimeout(() => window.location.href = './', 1000)
            }
            else document.querySelector(`.register-form .${e}`).textContent = responseJSON[e]
        })
    } catch(e) {
        document.querySelector(`.register-form .error`).classList.remove("success");
        document.querySelector(`.register-form .error`).textContent = 'Nastala chyba, zkuste to prosím znovu!'
    }
})


/* 
Kontrola, zda je správně zadané heslo

zadané heslo je kratší jak 8 znaků -> zobrazí se zpráva "Heslo musí mít alespoň 8 znaků"
zadané heslo má délku alespoň 8 znaků -> zobrazí se zpráva "Heslo je v pořádku"
při kazdém znaku se zavolá event input v opakovaném hesle, aby se případně povolilo/zakázalo tlačítko pro registraci
*/
document.querySelector('.register-form #password').addEventListener('input', e => {
    const pass_again = document.querySelector('.register-form #password_again')
    const element = document.querySelector('.register-form .password-error')
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

/* 
Kontrola, zda se hesla shodují 

není zadané žádné heslo -> nekontroluje se (nic se nezobrazí)
zadané heslo se nerovná původnímu heslu -> zobrazí se zpráva "Hesla se neshdodují"
zadané heslo se rovná původnímu heslu, ale původní heslo je kratší jak 8 znaků -> zavolá se kontrola u původního hesla
zadané heslo se rovná původnímu heslu a původní heslo má délku alespoň 8 znaků -> nic se nezobrazí, povolí se tlačítko pro registraci
*/
document.querySelector('.register-form #password_again').addEventListener('input', e => {
    const pass_element = document.querySelector('.register-form #password')
    const pass_again_error = document.querySelector('.register-form .password_again-error')
    const register_button = document.querySelector('.register-form .register-button')
    if(e.target.value.length === 0) {
        register_button.disabled = true;
        pass_again_error.innerHTML = "&nbsp";
        return;
    }
    if(e.target.value != pass_element.value) {
        pass_again_error.innerHTML = "Hesla se neshodují"
        register_button.disabled = true;
    } else if(e.target.value.length < 8 && e.target.value === pass_element.value) {
        pass_again_error.innerHTML = "&nbsp";
        register_button.disabled = true;
        pass_element.dispatchEvent(new Event('input'))
    } else {
        pass_again_error.innerHTML = "&nbsp";
        register_button.disabled = false;
    }
})
