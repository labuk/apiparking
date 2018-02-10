curl 'localhost/elparking/controllers/read_plato.php'
curl 'localhost/elparking/controllers/create_plato.php' -X POST -d '{"nombre_plato": "Arroz"}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/read_ingrediente.php'
curl 'localhost/elparking/controllers/create_ingrediente.php ' -X POST -d '{"nombre_ingrediente": "Arroz"}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/read_alergeno.php'
curl 'localhost/elparking/controllers/create_alergeno.php  ' -X POST -d '{"nombre_alergeno": "Proteina cereales"}' -H 'Content-Type: application/json'

curl 'localhost/elparking/controllers/create_plato.php ' -X POST -d '{"nombre_plato":"Arroz con yogurt","ingredientes":{"1":"1","2":"3"}}' -H 'Content-Type: application/json'
curl 'localhost/elparking/controllers/readOne_plato.php?id_plato=1'
