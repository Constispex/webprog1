"use strict";
let ajax = new XMLHttpRequest();
ajax.onreadystatechange = receiveJson;

function startAjax(form, value) {

    let param = '../php/showItems.php?' +
        'name=' + form.bikeFilterName.value +
        '&maxPrice=' + form.bikeFilterPrice.value +
        '&size=' + form.bikeFilterSize.value +
        '&elektro=' + form.bikeFilterElektro.value +
        '&beleuchtung=' + form.bikeFilterBeleuchtung.value;


    if (value.length > 0) {
        param += '&sort=' + value;
    }
    ajax.open('GET', param, true);
    ajax.send();
}

function receiveJson() {
    "use strict";
    let input = document.getElementById('bikeList')
    if (ajax.readyState === 4) {
        input.innerHTML = "";
        let result = JSON.parse(ajax.responseText);

        for (let i = 0; i < result.length; i++) {
            input.innerHTML +=
                '<div class="item">' +
                    '<div class="header">' +
                       '<p id="title">' + result[i].bezeichnung + '</p>' +
                        '<p id="type">' + result[i].typ + '</p>' +
                        '<p id="price"><span class="price">' + result[i].preis + '€</span>' + '</p>' +
                    '</div>' +
                    '<img src="../img/' + result[i].bild + '" alt="Bild von ' + result[i].bild + '">' +
                    '<div class="eigenschaften">' +
                        '<ul>' +
                        '<ul>Rahmengröße: ' + result[i].groesse + '</ul>' +
                        '<ul>Farbe: ' + result[i].farbe + '</ul>' +
                        '<ul>Gänge: ' + result[i].gaenge + '</ul>' +
                        '<ul>Gewicht: ' + result[i].gewicht + '</ul>' +
                        '<ul>Elektro: ' + result[i].elektro + '</ul>' +
                        '<ul>Beleuchtung: ' + result[i].beleuchtung + '</ul>' +
                        '<ul>Rahmenhoehe: ' + result[i].rahmenhoehe + '</ul>' +
                    '</div>' +
                '</div>';
        }
    } else {
        input.innerHTML = "Lade...";
        input.innerHTML += ajax.responseText;
    }
}