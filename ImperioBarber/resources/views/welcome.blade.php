@extends('layouts.app')

@section('title', 'Imperio Barber')

@section('content')

<div style="background:#f4f4f5;min-height:100vh;padding:40px 20px;">

    <div style="max-width:1200px;margin:auto;">

        <div style="text-align:center;margin-bottom:60px;">

            <h1 style="
                font-size:70px;
                font-weight:900;
                color:#d97706;
                margin-bottom:20px;
            ">
                💈 IMPERIO BARBER
            </h1>

            <p style="
                font-size:26px;
                color:#333;
                margin-bottom:20px;
            ">
                Donde el estilo, la elegancia y la confianza se encuentran
            </p>

            <p style="
                max-width:900px;
                margin:auto;
                color:#666;
                font-size:18px;
                line-height:1.8;
            ">
                En ImperioBarber nos dedicamos a ofrecer servicios de barbería de alta calidad,
                brindando experiencias únicas y profesionales para cada cliente.
            </p>

        </div>

        <div style="
            display:flex;
            justify-content:center;
            gap:20px;
            flex-wrap:wrap;
            margin-bottom:50px;
        ">

            <a href="{{ route('login') }}"
                style="
                background:#f59e0b;
                color:black;
                padding:15px 35px;
                border-radius:12px;
                font-weight:bold;
                text-decoration:none;
                box-shadow:0 8px 20px rgba(0,0,0,.20);
                ">
                Iniciar Sesión
            </a>

            <a href="{{ route('register') }}"
                style="
                background:#18181b;
                color:white;
                padding:15px 35px;
                border-radius:12px;
                font-weight:bold;
                text-decoration:none;
                box-shadow:0 8px 20px rgba(0,0,0,.20);
                ">
                Registrarse
            </a>

        </div>

        <div style="text-align:center;margin-bottom:60px;">



            <form action="{{ route('servicios.index') }}"
                method="GET"
                style="
                display:flex;
                justify-content:center;
                gap:10px;
                flex-wrap:wrap;
            ">

                <input
                    type="text"
                    name="buscar"
                    placeholder="Buscar servicios..."
                    style="
                    width:350px;
                    padding:15px;
                    border:none;
                    border-radius:12px;
                    box-shadow:0 4px 20px rgba(0,0,0,.1);
                    ">

                <button
                    type="submit"
                    style="
                    background:#f59e0b;
                    color:black;
                    padding:15px 25px;
                    border:none;
                    border-radius:12px;
                    font-weight:bold;
                    cursor:pointer;
                    ">
                    Buscar
                </button>

            </form>

        </div>

        <h2 style="
            text-align:center;
            font-size:55px;
            font-weight:bold;
            margin-bottom:40px;
        ">
            Nuestros Servicios
        </h2>

        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(300px,1fr));
            gap:30px;
        ">

            <div style="
                background:white;
                border-radius:20px;
                overflow:hidden;
                box-shadow:0 10px 25px rgba(0,0,0,.15);
            ">

                <img
                    src="{{ asset('images/corte.jpg.webp') }}"
                    style="
                    width:100%;
                    height:250px;
                    object-fit:cover;
                    ">

                <div style="padding:25px;">

                    <h3 style="
                        font-size:32px;
                        font-weight:bold;
                        margin-bottom:15px;
                    ">
                        Corte Clásico
                    </h3>

                    <p style="color:#666;">
                        Cortes modernos y tradicionales para todos los estilos.
                    </p>

                </div>

            </div>

            <div style="
                background:white;
                border-radius:20px;
                overflow:hidden;
                box-shadow:0 10px 25px rgba(0,0,0,.15);
            ">

                <img
                    src="{{ asset('images/barba.jpg') }}"
                    style="
                    width:100%;
                    height:250px;
                    object-fit:cover;
                    ">

                <div style="padding:25px;">

                    <h3 style="
                        font-size:32px;
                        font-weight:bold;
                        margin-bottom:15px;
                    ">
                        Barba Premium
                    </h3>

                    <p style="color:#666;">
                        Perfilado y cuidado profesional para una imagen impecable.
                    </p>

                </div>

            </div>

            <div style="
                background:white;
                border-radius:20px;
                overflow:hidden;
                box-shadow:0 10px 25px rgba(0,0,0,.15);
            ">

                <img
                    src="{{ asset('images/afeitado.jpg') }}"
                    style="
                    width:100%;
                    height:250px;
                    object-fit:cover;
                    ">

                <div style="padding:25px;">

                    <h3 style="
                        font-size:32px;
                        font-weight:bold;
                        margin-bottom:15px;
                    ">
                        Corte + Barba
                    </h3>

                    <p style="color:#666;">
                        La experiencia completa para renovar tu estilo.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection