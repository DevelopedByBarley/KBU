document.addEventListener('DOMContentLoaded', () => {
    const mainTeamsSelect = document.getElementById('main-team');

    mainTeamsSelect.onchange = async (e) => {
        const mainTeamId = Number(e.target.value);

        if (mainTeamId) {
            const teamSports = await getTeamSportsByMainTeamId(mainTeamId);
            const mainTeamsContainer = document.getElementById('main-team-container');
            mainTeamsContainer.classList.remove('d-none')

            const mainTeamSelect = mainTeamsContainer.querySelector('select');
            mainTeamSelect.innerHTML = renderSelectsByTeamSports(teamSports);

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


function renderSelectsByTeamSports(teamSports) {
    let temp = '';

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


