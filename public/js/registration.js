document.addEventListener('DOMContentLoaded', async() => {
    const mainTeamsSelect = document.getElementById('main-team');

    mainTeamsSelect.onchange = (e) => {
        console.log(e.target);
    }
})