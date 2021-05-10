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
                    <h3 class="h3 text-center">Enlaces Procesados</h3>
                </div>

                <div class="card-body">
                                        
                    @isset( $Procesando )
                    
                    <div id="Cargando" class="container">
                        <div class="row">
                            <div  class="d-flex my-2 justify-content-center text center col-md-12">
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
                            <div class="text-center col-md-12" >
                                <h2>
                                    <span class="text-primary">En este Momento se encuentra procesando su solucitud...</span>
                                </h2>
                                <h2>
                                    <span class="text-success">{{ $Procesando }}</span>
                                </h2>
                                <h2>
                                    <span class="text-danger">Oprime el Boton para obtener mas resulados...</span>
                                </h2>
                                <a href="{{ url('/procesados') }}" class="btn btn-primary btn-block mb-4">Actualizar<a>
                                <br>
                                <hr class="my-2">
                                <br>
                            </div>
                        </div>
                    </div>

                    @endisset

                    <div id="resultados" class="container">
                        <div class="row resultados d-flex justify-content-center">
                            <div class="col-md-12">
                                <h2 class="h2 text-center text-success">Respuestas</h2>
                            </div>
                        
                            <div class="col-md-5">
                                <h2 class="h2 text-center text-danger">Respuestas Negativas</h2>
                                @forelse($NBDCs as $item)
                                <p class="text-center">{{$item->respNegat}}</p>
                                @empty
                                <p class="text-center">No hay respuestas negativas para mostrar</p>
                                @endforelse
                            </div>
                        
                                         
                            <div class="col-md-5">
                                <h2 class="h2 text-center text-primary">Respuestas Positivas</h2>
                                @forelse($PBDCs as $itemp)
                                <p class="text-center">{{$itemp->respPosit}}</p>
                                @empty
                                <p class="text-center">No hay respuestas positivas para mostrar</p>
                                @endforelse
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
