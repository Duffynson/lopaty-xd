/*
vyresetuje všechny chybové a úspěšné hlášky
dostane data ve formátu JSON, kde je klíčem třída prvku pro zobrazení chybového hlašení a hodnotou je text chybového hlašení
pokud bylo příhlašení úspěšné, dostane pouze jeden klíč 'success' s textem úspěšného hlašení, který se zobrazí a po 2s se přesměruje na index.php
pokud nebylo úspěšné, zobrazí chybové hlášení pod každým inputem s chybou
*/
document.querySelector('.login-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    let response;
    try {
        response = await fetch('./php/login.php', {method: 'POST', body: new FormData(e.target)});
        const responseJSON = await response.json();

        document.querySelectorAll('.login-form .error-message').forEach(e => e.innerHTML = '&nbsp;')

        Object.keys(responseJSON).forEach(e => {
            if(e === 'success') {
                document.querySelector(`.login-form .error`).textContent = responseJSON[e];
                document.querySelector(`.login-form .error`).classList.add("success");
                setTimeout(() => window.location.href = './', 1000)
            } else document.querySelector(`.login-form .${e}`).textContent = responseJSON[e]
        })
    } catch(e) {
        document.querySelector(`.login-form .error`).classList.remove("success");
        document.querySelector(`.login-form .error`).textContent = 'Nastala chyba, zkuste to prosím znovu!'
    }
})

