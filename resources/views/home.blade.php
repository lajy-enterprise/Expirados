@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                <div class="card-header">
                    <h3 class="h3 text-center"> Chequear Enlaces</h1>
                </div>
                    
                <div class="card-body">

                    <!-- Chequeador -->
                    <div id="Chequeador" class="container mt-5">


                        <!-- Section: Enlaces -->
                        <section id="Home" class="container mb-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                <h3 class="h3 text-center">Ve a Procesados para ver los procesos de Chequeos</h1>
                                <a href="{{ url('/procesados') }}" class="btn btn-primary btn-block mb-4">Procesados<a>
                                <br>
                                <hr>
                                <br>
                                <h3 class="h3 text-center">Ve a Buscar para borrar y cancelar los procesos activos de Chequeos e iniciar uno nuevo</h1>
                                <a href="{{ url('/buscar') }}" class="btn btn-primary btn-block mb-4">Buscador<a>
                                </div>
                            </div>
                        </section>
                        <!--// Section: Enlaces -->

                    </div>
                    <!--// Chequeador -->
                
                    <!-- Cargando -->
                    <!-- <div id="Cargando" class="container d-none">
                        <div class="row">
                            <div  class="d-flex justify-content-center text center col-md-12">
                                <div class="spinner-grow text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-secondary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-warning" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-danger" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-info" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-dark" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                
                            </div>
                            <div class="text-warning text-center col-md-12" >
                                <h2>
                                    <span class="">Loading...</span>
                                </h2>
                            </div>
                        </div>
                    </div> -->
                    <!--// Cargando -->

                    <!-- Resultado -->
                    <!-- <div class="container">
                        <div id="resultados" class="row resultados d-flex justify-content-center">
                        
                        </div>
                    </div> -->
                    <!-- // Resultado -->

                    <!-- JavaScripts -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
