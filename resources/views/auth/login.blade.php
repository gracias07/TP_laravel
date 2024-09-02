<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <!-- Lien vers le CSS de Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden; /* Empêche le défilement */
        }

        .image-container {
            background: linear-gradient(to bottom right, #4a90e2, #9013fe); /* Dégradé de couleurs */
            height: 100vh;
            width: 40%;
            position: relative;
            display: flex;
            flex-direction: column; /* Dispose les éléments verticalement */
            justify-content: center; /* Centre le contenu verticalement */
            align-items: center;
            padding: 2rem;
            color: #ffffff; /* Couleur du texte */
        }

        .image-container img {
            width: 500px;
            height: auto;
            animation: zoomRotate 10s infinite; /* Animation infinie */
        }

        @keyframes zoomRotate {
            0% {
                transform: scale(1) rotate(0deg);
            }
            50% {
                transform: scale(1.2) rotate(15deg);
            }
            100% {
                transform: scale(1) rotate(0deg);
            }
        }

        .form-container {
            max-width: 500px;
            background-color: #ffffff;
            margin: auto;
            padding: 1.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); /* Ombre autour du conteneur */
            position: relative;
            z-index: 1;
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: -10px;
            left: -10px;
            width: calc(100% + 20px);
            height: calc(100% + 20px);
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            z-index: -1;
            filter: blur(15px); /* Effet de flou pour l'ombre */
        }
    </style>
</head>
<body>
    <div class="container-fluid g-0">
        <div class="row g-0">
            <div class="col-md-5 image-container">
                <img src="{{ asset('storage/image/ao.png') }}" alt="Image" />
            </div> <!-- 40% de l'écran -->
            <div class="col-md-7 d-flex align-items-center justify-content-center"> <!-- 60% de l'écran -->
                <div class="form-container">
                    <h2 class="text-center mb-4">Connexion</h2>
                    <form method="POST" action="{{route('handleLogin')}}">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            @if (Session::get('error_msg'))
                                <b>{{ Session::get('error_msg') }}</b>
                            @endif
                            <label for="exampleInputEmail1" class="form-label">Adresse email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">Nous ne partagerons jamais votre email avec quelqu'un d'autre.</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Lien vers le JS de Bootstrap 5.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
