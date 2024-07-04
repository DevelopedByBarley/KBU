
document.addEventListener('DOMContentLoaded', async () => {
    const mainTeamsSelect = document.getElementById('main-teams-container');
    const teamSportContainer = document.getElementById('team-sport-container');


    const password = document.getElementById('password');
    const pwGenerator = document.getElementById('pw-generator');

    /**
     * Main team section
     *  -----@example Render main Teams
    */

    const mainTeams = await getMainTeams();
    const mainTeamsTemp = renderMainTeams(mainTeams);
    mainTeamsSelect.innerHTML = mainTeamsTemp;

    /**
     shows  teamSportContainer if mainTeamsContainer value exist
 */

     mainTeamsSelect.addEventListener('change', (e) => {
        if (e.target.value !== '') {
            const currentMainTeam = e.target.value
            teamSportContainer.classList.remove('d-none')
            
            // GET TEAM SPORTS BY CURRENT MAIN TEAM

            axios.get(`/team-sports/${currentMainTeam}`).then(res => console.log(res.data));

        } else {
            teamSportContainer.classList.add('d-none')
        }
    });

/*     const teamSportSelect = teamSportContainer.querySelector('#team-sport');
    teamSportSelect.addEventListener('change', (e) => {
        if (!teamSportContainer.classList.contains('d-none')) {
            const teamSport = e.target.value;

            if (teamSport && teamSport !== '') {
               axios.get('/team-sport/1').then(res => console.log(res.data));
            }
        }
    }) */












    /**
     *  -----@example Generate password section
     */

    pwGenerator.addEventListener('click', (e) => {
        e.preventDefault();
        const newPw = generatePassword();

        if (newPw && newPw !== '') {
            password.value = newPw;
        }

    })
});















async function getMainTeams() {
    const res = await axios.get('/main-teams');
    return res.data;
}



function renderMainTeams(mainTeams) {
    let mainTeamsTemplate = '<option value="">Válassz egy csapatot</option >';

    mainTeams.map(team => {
        mainTeamsTemplate += `
            ${team.max !== 0 ? `<option style="background-color: ${team.color}; color: white;" value="${team.id}">${team.name} csapat (${team.leader}) szabad helyek száma: ${team.max}</option>` : ''}
        `;
    });

    return mainTeamsTemplate;
}















function generatePassword(length = 12) {
    const charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%";
    let password = "";
    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * charset.length);
        password += charset[randomIndex];
    }
    return password;
}







