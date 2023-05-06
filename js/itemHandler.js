let ajax = new XMLHttpRequest();
ajax.onreadystatechange = receiveJson;

function startAjaxFilter(form) {
    "use strict";
    let param = '../php/showItems.php?title=' + form.bookFilterName.value
    ajax.open('GET', param, true);
    ajax.send();
}

function startAjaxSort(form) {
    "use strict";
    let param = 'showItems.php?sort=' + form.sort.value;
    ajax.open('GET', param, true);
    ajax.send();
}

function receiveJson() {
    "use strict";
    let input = document.getElementById('bookList')
    if (ajax.readyState === 4) {
        input.innerHTML += ajax.responseText;
        let resultDiv = document.getElementById('bookList');
        let res = JSON.parse(ajax.responseText);
        alert(resultDiv.innerHTML);
        input.innerHTML += ajax.statusText;
        input.innerHTML += ajax.status;

    } else {
        let resultDiv = document.getElementById('bookList');
    }
}