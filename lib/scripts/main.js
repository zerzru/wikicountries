document.querySelector('.bold').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[b]жирный тест[/b]'
};

document.querySelector('.italic').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[i]курсивный текст[/i]'
};

document.querySelector('.underline').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[u]подчёркнутый текст[/u]'
};

document.querySelector('.link').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[ссылка|отображаемый текст]'
};

document.querySelector('.image_b').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '(iадрес картинкиi)'
};

document.querySelector('.up').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[up]'
};

document.querySelector('.down').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[down]'
};

document.querySelector('.upper').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + 'текст[upper]степень[/upper]'
};

document.querySelector('.green_t').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[green]зелёный текст[/green]'
};

document.querySelector('.red_t').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[red]красный текст[/red]'
};

document.querySelector('.br').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + '[br]'
};

document.querySelector('.table_b').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value + 
    '[table]\
    \n[строка]\
    \n[столбец][/столбец]\
    \n[/строка]\
    \n[строка][контент][/контент][/строка]\
    \n[/table]'
};

document.querySelector('.country_card').onclick = function () {
    document.querySelector('textarea').value = document.querySelector('textarea').value +
    '{{Страна}\
    \n(fссылка на флагf)\
    \n(eссылка на гербe)\
    \n| Самоназвание = \
    \n| Основание = \
    \n| Официальный язык = \
    \n| Столица = \
    \n| Крупнейшие города = \
    \n| Форма правления = \
    \n| Президент = \
    \n| Премьер министр = \
    \n| Госрелигия = \
    \n| Территория = \
    \n| Население = \
    \n| ВВП = \
    \n| ИЧР = \
    \n| Названия жителей = \
    \n| Валюта = \
    \n| Домены = \
    \n| Код ISO = \
    \n| Код МОК = \
    \n| Телефонный код = \
    \n| Часовые пояса = \
    \n| Автомобильное движение = Справа\
    \n}}'
};

function load_info(page) {
    $(function() {    
        $.get(page, function(data) {
            var content = $("#main", data).html();
            if(content == undefined) {
                $("#result").html("Нет информации для загрузки :(");
            } else {
                $("#result").html(content);
            }
        });
    });
};

/*
function sh_password(doing) {
    if(doing === 's') {
    document.getElementById('change').innerHTML = "<input name='current_passw' id='showed_password' type='text' class='password' value='{$row['password']}'><button onlick='javascript:sh_password(`s`)'>Скрыть</button>";
    } else if(doing === 'h') {
    document.getElementById('change').innerHTML = "<input name='current_passw' id='hidden_password' type='password' class='password' value='{$row['password']}'><button onlick='javascript:sh_password(`h`)'>Показать</button>";
    } else {
    console.log('Отсутсвует значение переменной doing - функция не знает, что делать - скрыть или показать пароль');
    }
};
*/