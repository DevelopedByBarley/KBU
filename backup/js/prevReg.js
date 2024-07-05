document.addEventListener('DOMContentLoaded', () => {
   
    mainTeamsSelect.onchange = async (e) => {
        const mainTeamId = Number(e.target.value);

        // SELECT MAIN TEAM AND RENDER TEAM SPORTS AND DUEL SPORTS
        if (mainTeamId) {
            duelTeamSelect.addEventListener('change', (e) => {
                if (duelTeam === 1) {

                    pairStatusSelectCon.classList.remove('d-none');
                    
                    pairStatusSelectCon.addEventListener('change', (e) => {
                        const pairStatus = Number(e.target.value);
                        console.log(pairStatus);;
                        if (pairStatus === 2) {
                            pairEligibilityCon.classList.remove('d-none');

                            pairEligibilityCon.addEventListener('change', (e) => {
                                const pairEligibility = Number(e.target.value);

                                if (pairEligibility === 2) {
                                    pairingPwCon.classList.remove('d-none')
                                    console.log(pwGeneratorBtn);
                                    pwGeneratorBtn.addEventListener('click', (e) => {
                                        e.preventDefault();
                                        let pwInput = e.target.previousElementSibling;
                                        pwInput.value = generatePassword();
                                    })
                                } else {
                                    alert('Bárki megjelölhet!');
                                }
                            })


                        } else {
                            alert('Van párom mutasd a listát!')
                        }
                    })

                }




            })



        }
    }
});



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

