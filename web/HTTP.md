#### Методы HTTP-запросов
| Метод  | Передача данных | Изменение данных | Описание                                    |
| ------ | --------------- | ---------------- | ------------------------------------------- |
| **GET**    | Нет             | Да               | Получает  информацию о ресурсе              |
| **POST**   | Да              | Нет              | Создает ресурс                              |
| **PUT**    | Да              | Да               | Заменяет ресурс целиком                     |
| **PATCH**  | Да              | Да               | Редактирует ресурс                          |
| **DELETE** | Нет             | Да               | Удаляет ресурс                              |
| **HEAD**   | Нет             | Да               | Получает и отправляет только заголовки HTTP |

#### Статус-коды ответа
- 100 - 199 Информационные
- 200 - 299 Успешные
- 300 - 399 Редиректы
- 400 - 499 Клиентские ошибки
- 500 - 599 Серверные ошибки

#### Заголовки HTTP

##### Заголовки запроса
- **Host** - Домен, по которому мы переходим
- **Cookie** - Куки, отдаваемые бразуером серверу
- **User-Agent** - Браузер, который делает запрос
- **Accept-Languange/Accept-Encoding** - Принимаемы браузером язык/кодировка
- **Referer** - Предыдущая страница
- **Authorization** - Резквизсы для авторизации

##### Заголовки ответа
- **Cache-Control** - Сервер говорит браузеру как кэшировать данные
- **Content-Type:** - Тип и подтип содержимого, а также кодировка и приложение для открытия содержимого. Примеры%
	-  **Content-Type:** text/html; charset=UTF-8
	-  **Content-Type:** image/gif
	-  **Content-Type:** application/pdf
- **Content-Disposition** - Скачитвать или открывать документ
- **Location** - Заголовок для редиректа
- **Set-Cockie** - Сервер передает браузеру куки
- **WWW-Authenticate** - Выводи окно с базовой аунтификацией
- **Content-Encoding** - Сервер говорит браузеру сжата ли страница и в каком виде
- **Server и X-Powered-By** - Технологии на которых работает сайт

### GET
#### Формат:
GET сценарий?параметры HTTP/1.0
> URL - полный путь к некоторой странице
> URI - часть, расположенная после имени хоста и номера порта
### POST
#### Формат:
POST сценарий?параметры HTTP/1.0

### Материалы:
- **[httpbin](https://httpbin.org/#/Cookies)** - Можно отправлять запросы и получать ответ сервера**