 install php then composer


db/config for configuration

register:

raw/body/select type JSON
http://localhost/Events_youcode/user/register

 `{
    "email" : "walidmoultamis@gmail.com",
    "password" : "password"
}`

copy token;


archive/delete:
check headers
key          | value         |
Autorization | Bearer "token"|

http://localhost/Events_youcode/user/archive/1

login:
http://localhost/Events_youcode/user/login

{
    "email" : "walidmoultamis@gmail.com",
    "password" : "password"
}

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


what you want to do with the event      'menu': regular || highlighted || archived
http://localhost/Events_youcode/event/'menu'/'id'




get all speakers
http://localhost/Events_youcode/speacker/speackers


get the info of a speaker using id
http://localhost/Events_youcode/speacker/info/'id'


add a speaker:
http://localhost/Events_youcode/speacker/add

{
        "full_name": "jinane abounadi",
        "url_img": "image.jpg",
        "description": "description",
        "id_event": "4"
}

add reservation:
http://localhost/Events_youcode/reservation/add

{
   "id_member": "1",
    "id_event":"4"
}

add suggestion 
http://localhost/Events_youcode/suggestion/add

{
    "title_suggestion":"qsdqsxcxcxxcdqsdqsdq",
    "description":"description",
    "goal":"goal",
    "id_member":"1"
}



select all classes
http://localhost/Events_youcode/classes/classes

select class by id
http://localhost/Events_youcode/classes/info/1