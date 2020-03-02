let rates = null;
let savedata = [];

function getdata() { //Выполнение запроса к контролеру  для обновления записей
    $.ajax({
        type: 'GET',
        url: 'GetData',
        success: function(data) {
            $("#data").append(data);
            rates = data;
        }
    });
}

$(document).ajaxComplete(function() {
    getbase()

});

function checkBase(txt) {
    chb = document.getElementById(txt)
    if (chb == null) { return true } else { return false }
}

function getbase() { //Добавление записей о курсах 
    let txt = 'RUB'
    if (document.getElementById('text').value != '') { txt = document.getElementById('text').value; }
    if (rates != null) {
        if (typeof(rates.data.rates[txt]) != "undefined" && checkBase(txt)) {
            let elem = document.getElementById('info')
            let div = document.createElement('div')
            div.setAttribute('id', txt)
            div.setAttribute('class', 'block_info')
            div.setAttribute('onclick', "Element_delete(this)")
            div.innerHTML = `<p class='info'> ${txt} : ${rates.data.rates[txt]} </p>`
            elem.appendChild(div)
            setStorage(txt, rates.data.rates[txt]) //Добавление в хранилище
            txt = null;
        }
    } else {
        getdata()
        console.log(rates)
    }
}

function Element_delete(obj) { // Удаление записи
    elem = document.getElementById(obj.id)
    elem.remove();
    sessionStorage.removeItem(obj.id) //УДаление из хранилия
    for (i = 0; i < sessionStorage.length; i++) {
        console.log(sessionStorage.key(i))
        console.log(sessionStorage.getItem(sessionStorage.key(i)))
    }
};

function setStorage(txt, rates) { //Добавление в хранилище 
    sessionStorage.setItem(txt, rates)
    console.log('sdsd', txt, rates)
        //for (i = 0; i < sessionStorage.length; i++) {
        // console.log(sessionStorage.key(i))
        //console.log(sessionStorage.getItem(sessionStorage.key(i)))
        //}
}

window.onload = function() {
    for (i = 0; i < sessionStorage.length; i++) {

        let elem = document.getElementById('info')
        let div = document.createElement('div')
        div.setAttribute('id', sessionStorage.key(i))
        div.setAttribute('class', 'block_info')
        div.setAttribute('onclick', "Element_delete(this)")
        div.innerHTML = `<p class='info'> ${sessionStorage.key(i)} : ${sessionStorage.getItem(sessionStorage.key(i))} </p>`
        elem.appendChild(div)
    }

}