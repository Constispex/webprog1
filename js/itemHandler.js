let ajax = new XMLHttpRequest();
ajax.onreadystatechange = receiveJson;

function startAjax(form, value) {
    "use strict";
    let param = '../php/showItems.php?title=' + form.bookFilterName.value +
        '&author=' + form.bookFilterAuthor.value +
        '&publisher=' + form.bookFilterPublisher.value +
        '&subareas=' + form.bookFilterSubareas.value +
        '&rating=' + form.bookFilterRating.value;

    if (value.length > 0) {
        param += '&sort=' + value;
    }
    ajax.open('GET', param, true);
    ajax.send();
}

function receiveJson() {
    "use strict";
    let input = document.getElementById('bookList')
    if (ajax.readyState === 4) {
        let result = JSON.parse(ajax.responseText);
        let table = "<table class='table table-striped table-hover table-bordered'>";

        table += "<tr>";
        table += "<th>Titel</th>";
        table += "<th>Autor</th>";
        table += "<th>Verlag</th>";
        table += "<th>Unterbereich</th>";
        table += "<th>Bewertung</th>";
        for (let i = 0; i < result.length; i++) {
            table += "<tr> <td>" + result[i].title + "</td>";
            table += "<td>" + result[i].author + "</td>";
            table += "<td>" + result[i].publisher + "</td>";
            table += "<td>" + result[i].subareas + "</td>";
            table += "<td>" + result[i].rating + "</td> </tr>";
        }
        input.innerHTML += "<br>";
        input.innerHTML = table;
        input.innerHTML += result;

    } else {
        input.innerHTML = "Lade...";
    }
}