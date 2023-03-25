<?php
$user = $_POST['user'];
$products = $_POST['products'];
$total = $_POST['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title class="text-center text-primary">Drive Electric</title>
</head>
<body>
    <div class="container text-center">
        <div class="row text-center">
            <div class="col-12 justify-content-center p-4 text-center">
                <div class="d-flex justify-content-center align-items-center mt-5">
                    <img src="{{$user['image']}}" width="35" height="35" class="rounded me-4">
                    <h1 class="title fw-b fs-1 text-secondary text-center my-2">Compra realizada</h1>
                </div>
                <table class="table table-light table-striped mt-5 mx-2">
                  <thead>
                    <tr class="fw-b fs-5">
                      <th scope="col" class="py-4">Imagen</th>
                      <th scope="col" class="py-4">Producto</th>
                      <th scope="col" class="py-4">Precio</th>
                    </tr>
                  </thead>
                  <tbody>
                @forelse ($products as $product)
                    <tr class="justify-content-center align-self-center">
                      <td><img src="{{$product['image']}}"        width="50" height="50"></td>
                      <td class="pt-4 text-truncate">{{$product['title']}}</td>
                      <td class="pt-4">{{$product['price']}}</td>
                    </tr >
                  </tbody>
                  @empty
                    <h2>No hay productos disponibles</h2>
                @endforelse
                </table>
                <div class="m-4 text-center justify-content-center">
                    <h5>Total: {{$total}} € </h5>
                    <h5>Gracias por su compra </h5>
                </div>
            </div>
            <div class="col-12 p-5">
          <h4 class="text-secondary">Sobre nosotros</h4>
          <p class="text-muted">Somos una empresa en expansión, con sede en Benidorm. Repartimos nuestros productos a toda España. Contacte con nosotros en driveelectric@hotmail.com o en el teléfono 664056573.</p>
          <p class="pt-4 text-muted">Copyright ©2022 Todos los derechos reservados | Está usted visitando la web oficial de
            <span> Drive-Electric</span>
          </p>
        </div>
        </div>
    </div>
</body>
</html>
