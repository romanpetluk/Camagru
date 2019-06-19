// 2. Создание переменной request
var request = new XMLHttpRequest();
// 3. Настройка запроса
request.open('POST','processing.php',true);
// 4. Подписка на событие onreadystatechange и обработка его с помощью анонимной функции
request.addEventListener('readystatechange', function() {
    // если состояния запроса 4 и статус запроса 200 (OK)
    if ((request.readyState==4) && (request.status==200)) {
        // например, выведем объект XHR в консоль браузера
        console.log(request);
        // и ответ (текст), пришедший с сервера в окне alert
        console.log(request.responseText);
        // получить элемент c id = welcome
        var welcome = document.getElementById('welcome');
        // заменить содержимое элемента ответом, пришедшим с сервера
        welcome.innerHTML = request.responseText;
    }
});
// 5. Отправка запроса на сервер
request.send();