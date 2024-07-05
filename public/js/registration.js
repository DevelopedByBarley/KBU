document.addEventListener('DOMContentLoaded', () => {
    const mainTeamSelect = document.getElementById('main-team');

    const duelTeamsCon = document.getElementById('duel-sports-container'); // d-none
    const duelTeamsSelect = duelTeamsCon.querySelector('select');

    const teamSportsCon = document.getElementById('team-sports-container'); // d-none
    const teamSportsSelect = teamSportsCon.querySelector('select');

    /*  const pairStatusSelectCon = document.getElementById('select-pair-status-container');
     const pairEligibilityCon = document.getElementById('select-pair-eligibility-container');
     const pairingPwCon = document.getElementById('pairing-password-container');
     const pwGeneratorBtn = document.getElementById('pw-generator-btn'); */

    mainTeamSelect.onchange = async (e) => {
        const mainTeamId = Number(e.target.value);
        console.log(mainTeamId);
        if (mainTeamId === 0) return closeAllTeamInput([duelTeamsCon, teamSportsCon]);
        showAndRenderTeamSportsSelectOptions(mainTeamId, teamSportsCon, teamSportsSelect);
        showAndRenderDuelSportsSelectOpions(mainTeamId, duelTeamsCon, duelTeamsSelect)
    }


});

function closeAllTeamInput(elements) {
    elements.forEach(element => {
        if (!element.classList.contains('d-none')) element.classList.add('d-none');
    });
}

async function showAndRenderTeamSportsSelectOptions(mainTeamId, teamSportsCon, teamSportsSelect) {
    const teamSports = await getTeamSportsByMainTeamId(mainTeamId);
    teamSportsCon.classList.remove('d-none')
    teamSportsSelect.innerHTML = renderSelectsByTeamSports(teamSports);
}

async function showAndRenderDuelSportsSelectOpions(mainTeamId, duelTeamsCon, duelTeamsSelect) {
    const duelSports = await getDuelSportsByMainTeamId(mainTeamId);
    duelTeamsCon.classList.remove('d-none')
    duelTeamsSelect.innerHTML = renderSelectsByDuelSports(duelSports);

}








function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}


















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
        <option value="0">Nem jelentkezem</option>
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
        <option value="0">Nem jelentkezem</option>
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

