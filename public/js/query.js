let rates = null;

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

function getbase() { //Добавление записей о курсах 
    let txt = 'RUB'
    if (document.getElementById('text').value != '') { txt = document.getElementById('text').value; }
    if (rates != null) {
        if (typeof(rates.data.rates[txt]) != "undefined") {
            let elem = document.getElementById('info')
            let div = document.createElement('div')
            div.setAttribute('id', txt)
            div.setAttribute('class', 'block_info')
            div.setAttribute('onclick', "Element_delete(this)")
            div.innerHTML = `<p class='info'> ${txt} : ${rates.data.rates[txt]} </p>`
            elem.appendChild(div)
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
};