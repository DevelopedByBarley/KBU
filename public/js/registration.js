document.addEventListener('DOMContentLoaded', () => {
    const mainTeamsSelect = document.getElementById('main-team');

    mainTeamsSelect.onchange = async (e) => {
        const mainTeamId = Number(e.target.value);

        if (mainTeamId) {
            const teamSports = await getTeamSportsByMainTeamId(mainTeamId);
            const duelSports = await getDuelSportsByMainTeamId(mainTeamId);
            const mainTeamsContainer = document.getElementById('main-team-container');
            const duelTeamsContainer = document.getElementById('duel-team-container');
            mainTeamsContainer.classList.remove('d-none')
            duelTeamsContainer.classList.remove('d-none')

            const mainTeamSelect = mainTeamsContainer.querySelector('select');
            mainTeamSelect.innerHTML = renderSelectsByTeamSports(teamSports);
            
            const duelTeamSelect = duelTeamsContainer.querySelector('select');
            duelTeamSelect.innerHTML = renderSelectsByDuelSports(duelSports);
            
            mainTeamSelect.addEventListener('change', (e) => {
                console.log(e.target.value);
            })


        }
    }
});

async function getTeamSportsByMainTeamId(mainTeamId) {
    try {
        const res = await axios.get(`/team-sports/${mainTeamId}`);
        const mainTeams = res.data;
        return mainTeams;
    } catch (err) {
        alert(err);
    }
}

async function getDuelSportsByMainTeamId(mainTeamId) {
    try {
        const res = await axios.get(`/duel-sports/${mainTeamId}`);
        const duelTeams = res.data;
        console.log(duelTeams);
        return duelTeams;
    } catch (err) {
        alert(err);
    }
}
function renderSelectsByTeamSports(teamSports) {
    let temp = `
        <option value="" selected>Válassza ki a csapat sportot</option>
    `;

    teamSports.forEach(sport => {
        const freeSpots = sport.max;
        const teamName = sport.name;
        const teamId = sport.id;
        const color = sport.color;

        temp += `
            <option value="${teamId}" ${freeSpots > 0 ? '' : 'disabled'}>
                ${teamName} - ${color} (${freeSpots} szabad hely)
            </option>
        `;
    });

    return temp;
}
function renderSelectsByDuelSports(teamSports) {
    let temp = `
        <option value="" selected>Válassza ki a csapat sportot</option>
    `;

    teamSports.forEach(sport => {
        const freeSpots = sport.max;
        const teamName = sport.name;
        const teamId = sport.id;
        const color = sport.color;

        temp += `
            <option value="${teamId}" ${freeSpots > 0 ? '' : 'disabled'}>
                ${teamName} - ${color} (${freeSpots} szabad hely)
            </option>
        `;
    });

    return temp;
}

