document.addEventListener('DOMContentLoaded', () => {
	const mainTeamSelect = document.getElementById('main-team');

	const duelTeamsCon = document.getElementById('duel-sports-container'); // d-none
	const duelTeamsSelect = duelTeamsCon.querySelector('select');

	const teamSportsCon = document.getElementById('team-sports-container'); // d-none
	const teamSportsSelect = teamSportsCon.querySelector('select');


	const pairStatusSelectCon = document.getElementById('select-pair-status-container');
	const pairStatusSelect = pairStatusSelectCon.querySelector('select')

	const pairEligibilityCon = document.getElementById('select-pair-eligibility-container');
	const pairEligibilityselect = pairEligibilityCon.querySelector('select')

	const pairingPwCon = document.getElementById('pairing-password-container');
	const pairingPwInput = pairingPwCon.querySelector('#pairing_password');
	const pwGeneratorBtn = document.getElementById('pw-generator-btn');


	mainTeamSelect.onchange = async (e) => {
		const mainTeamId = Number(e.target.value);
		if (mainTeamId === 0) {
			disableElements([
				duelTeamsSelect,
				teamSportsSelect,
				pairStatusSelect,
				pairEligibilityselect,
				pairingPwInput
			]);
			hideElements([ // CLOSE ALL INPUT WHEN MAINTEAM ID DOESNT EXIST
				duelTeamsCon,
				teamSportsCon,
				pairStatusSelectCon,
				pairEligibilityCon,
				pairingPwCon
			])
			return;
		};

		enableElements([
			duelTeamsSelect, teamSportsSelect
		]);

		showAndRenderTeamSportsSelectOptions(mainTeamId, teamSportsCon, teamSportsSelect);
		showAndRenderDuelSportsSelectOpions(mainTeamId, duelTeamsCon, duelTeamsSelect)
	}




	duelTeamsSelect.onchange = async (e) => {
		const duelTeam = Number(e.target.value);
		console.log(duelTeam);
		if (duelTeam === 0) {
			disableElements([
				pairStatusSelect,
				pairEligibilityselect,
				pairingPwInput
			]);
			return hideElements([
				pairStatusSelectCon,
				pairEligibilityCon,
				pairingPwCon
			])
		};

		if (duelTeam > 0) {
			enableElements([
				pairStatusSelect,
			])
			showPairStatusCon(pairStatusSelectCon, pairEligibilityCon, pairEligibilityselect, pairingPwCon, pairingPwInput);
		}


	}

	pwGeneratorBtn.addEventListener('click', (e) => {
		e.preventDefault();
		let pwInput = e.target.previousElementSibling;
		pwInput.value = generatePassword();
	})

});

function showPairStatusCon(pairStatusSelectCon, pairEligibilityCon, pairEligibilityselect, pairingPwCon, pairingPwInput) {
	pairStatusSelectCon.classList.remove('d-none');

	pairStatusSelectCon.onchange = async (e) => {
		const pairStatus = Number(e.target.value);


		if (pairStatus === 0) {
			disableElements([pairEligibilityselect, pairingPwInput]);
			return hideElements([pairEligibilityCon, pairingPwCon])
		};

		enableElements([pairEligibilityselect])

		if (pairStatus === 1) {
			hideElements([pairEligibilityCon, pairingPwCon])
			disableElements([pairEligibilityselect, pairingPwInput])
			console.log('VAN PÁROM JÖHET A LISTA		')
		} else {
			showPairEligibilityCon(pairEligibilityCon, pairingPwCon, pairingPwInput);
		}
	}
}


function showPairEligibilityCon(pairEligibilityCon, pairingPwCon, pairingPwInput) {
	pairEligibilityCon.classList.remove('d-none');

	pairEligibilityCon.onchange = async (e) => {
		const pairEligibility = Number(e.target.value);
		if (pairEligibility === 0) {
			disableElements([pairingPwInput]);
			return hideElements([pairingPwCon]);
		}

		if (pairEligibility === 1) {
			disableElements([pairingPwInput]);
			hideElements([pairingPwCon]);
			console.log('Bárki megjelölhet!')
		} else {
			showPairingPwCon(pairingPwCon);
			enableElements([pairingPwInput])
		}

	}


}

function showPairingPwCon(pairingPwCon) {
	pairingPwCon.classList.remove('d-none')
}





function enableElements(elements) {
	elements.forEach(element => {
		// Ellenőrizzük, hogy az elem még nem disabled
		if (element.disabled) {
			// Kapcsoljuk ki az elemet
			element.disabled = false;
		}
	});
}

function disableElements(elements) {
	elements.forEach(element => {
		// Ellenőrizzük, hogy az elem még nem disabled
		if (!element.disabled) {
			// Kapcsoljuk ki az elemet
			element.value = '';
			element.disabled = true;
		}
	});
}



function hideElements(elements) {
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


