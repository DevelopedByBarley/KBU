async function getMainTeams() {
    const res = await axios.get('/api/main-teams');
    return res.data;
}

document.addEventListener('DOMContentLoaded', async () => {
    const mainTeams = await getMainTeams();
    const mainTeamsContainer = document.getElementById('main-teams-container');
    const teamSportContainer = document.getElementById('team-sport-container');

    let mainTeamsTemplate = '<option value="">Válassz egy csapatot</option>';

    mainTeams.map(team => {
        mainTeamsTemplate += `
            <option style="background-color: ${team.color}; color: white;" value="${team.id}">${team.name} csapat (${team.leader})</option>
        `;
    });

    mainTeamsContainer.innerHTML = mainTeamsTemplate;

    mainTeamsContainer.addEventListener('change', (e) => {
        console.log(e.target.value)
        if(e.target.value !== '') {
            teamSportContainer.classList.remove('d-none')
        } else {
            teamSportContainer.classList.add('d-none')

        }
    });
});
