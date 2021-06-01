register:

raw/body/select type JSON
http://localhost/Events_youcode/user/register



archive/delete:
check headers
key          | value         |
Autorization | Bearer "token"|

http://localhost/Events_youcode/user/archive/1



login:
http://localhost/Events_youcode/user/login



see all events:
http://localhost/Events_youcode/event/events

add event:
http://localhost/Events_youcode/event/add

{
    "title": "spotify",
    "event_where": "agora",
    "event_when": "2021-01-01",
    "max_places": "25",
    "classes": "all",
    "description": "description",
    "url_img": "src.jpg",
    "status": "highlighted"
}

get info of a specific event:              v=id
http://localhost/Events_youcode/event/info/2


what you want to do to the event      'menu': regular || highlighted || archived
http://localhost/Events_youcode/event/'menu'/1