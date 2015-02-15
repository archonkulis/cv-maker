var schoolCounter = 1;

function addSchool() {
    var education = document.getElementById("cv-top-wrapper");
    var newSchool = document.createElement('div');

    schoolCounter = schoolCounter + 1;

    newSchool.innerHTML = "" +
    "<div class='form-group' id='school-" + schoolCounter  + "'>" +
    "<hr>" +
    "<label class='col-md-4 control-label'></label>" +
    "<div class='col-md-4'>" +
    " <input name='education[" + schoolCounter + "][school_name]' type='text' placeholder='Iestādes nosaukums' class='form-control input-md' required>" +
    " <input name='education[" + schoolCounter + "][year_from]' type='text' placeholder='Gads no' class='form-control input-md' required>" +
    " <input name='education[" + schoolCounter + "][year_to]' type='text' placeholder='Gads līdz' class='form-control input-md' required>" +
    " <input name='education[" + schoolCounter + "][speciality]' type='text' placeholder='Specialitāte' class='form-control input-md' required>" +
    " <input type='button' class='btn btn-danger' onclick='removeSchool(" + schoolCounter + ");' value='Izdzēst iestādi' />" +
    " </div>" +
    " </div>";

    education.appendChild(newSchool);
}

function removeSchool(id) {
    var elementToDelete = 'school-' + id;
    document.getElementById(elementToDelete).remove();
}

var languageCounter = 3;

function addLanguage() {
    var languages = document.getElementById("cv-bottom-wrapper");
    var newLanguage = document.createElement('div');

    languageCounter = languageCounter + 1;

    newLanguage.innerHTML = "" +
    "<div class='form-group' id='language-" + languageCounter  + "'>" +
    "<hr>" +
    "<label class='col-md-4 control-label'></label>" +
    "<div class='col-md-4'>" +
    " <input name='languages[" + languageCounter + "][language]' type='text' placeholder='Valoda' class='form-control input-md' required>" +
    " <input name='languages[" + languageCounter + "][spoken]' type='text' placeholder='Runātprasme' class='form-control input-md' required>" +
    " <input name='languages[" + languageCounter + "][reading]' type='text' placeholder='Lasītprasme' class='form-control input-md' required>" +
    " <input name='languages[" + languageCounter + "][written]' type='text' placeholder='Rakstītprasme' class='form-control input-md' required>" +
    " <input type='button' class='btn btn-danger' onclick='removeLanguage(" + languageCounter + ");' value='Izdzēst valodu' />" +
    " </div>" +
    " </div>";

    languages.appendChild(newLanguage);
}

function removeLanguage(id) {
    var elementToDelete = 'language-' + id;
    document.getElementById(elementToDelete).remove();
}