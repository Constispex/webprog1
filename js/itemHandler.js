"use strict";
let ajax = new XMLHttpRequest();
ajax.onreadystatechange = receiveJson;

let checkboxElektro = false;
let checkboxBeleuchtung = false;
let selectedSize = '';

createComboBox();
startAjax('', '');

function createComboBox() {
    "use strict";

    fetch('../php/createComboBox.php')
        .then(response => response.json())
        .then(result => {
            let combobox = "Größe: ";
            combobox += "<select name='bikeFilterSize'>"
            result.forEach(size => {
                combobox += `<option value="${size}">${size}</option>`;
            });
            combobox += "</select>";

            document.getElementById('sizeComboBox').innerHTML = combobox;
        })
        .catch(error => console.error('Error fetching data:', error));
}
function onValueChange(checkbox) {
    if (checkbox.name === "bikeFilterElektro") {
        checkboxElektro = checkbox.checked;
    } else if (checkbox.name === "bikeFilterBeleuchtung") {
        checkboxBeleuchtung = checkbox.checked;
    }
}


function startAjax(form, value) {
    "use strict";
    if (form === '') {

        ajax.open('GET', '../php/showItems.php', true);
        ajax.send();
        return;
    }
    let $maxPrice = parseInt(form.bikeFilterPrice.value);

    if ($maxPrice === 0) {
        $maxPrice = 999999;
    }

    let param = '../php/showItems.php?' +
        'name=' + form.bikeFilterName.value +
        '&maxPrice=' + $maxPrice +
        '&size=' + form.bikeFilterSize.value +
        '&elektro=' + checkboxElektro +
        '&beleuchtung=' + checkboxBeleuchtung;

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
        if (input !== null) {
            input.innerHTML += ajax.responseText;
        }
    }
}