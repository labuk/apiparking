curl 'localhost/elparking/controllers/read_plato.php'
curl 'localhost/elparking/controllers/create_plato.php' -X POST -d '{"nombre_plato": "Arroz"}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/read_ingrediente.php'
curl 'localhost/elparking/controllers/create_ingrediente.php ' -X POST -d '{"nombre_ingrediente": "Arroz"}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/read_alergeno.php'
curl 'localhost/elparking/controllers/create_alergeno.php  ' -X POST -d '{"nombre_alergeno": "Proteina cereales"}' -H 'Content-Type: application/json'

curl 'localhost/elparking/controllers/create_plato.php ' -X POST -d '{"nombre_plato":"Arroz con yogurt","ingredientes":{"1":"1","2":"3"}}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/readOne_plato.php?id_plato=1'

curl 'localhost/elparking/controllers/create_ingrediente.php  ' -X POST -d '{"nombre_ingrediente": "Arroz","alergenos":{"1":"4"}}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/readOne_ingrediente.php?id_ingrediente=1'

curl 'localhost/elparking/controllers/readOne_alergeno.php?id_alergeno=1'

curl 'localhost/elparking/controllers/change_plato.php ' -X POST -d '{"id_plato":"7", "add":{"1":"2","2":"4"},"delete":{"1":"7"}}' -H 'Content-Type: application/json'
