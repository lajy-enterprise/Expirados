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

                            @isset( $Mensaje )
                            {{ $Mensaje }}
                            @endisset

                        <!-- Section: Enlaces -->
                        <section id="formulario" class="container mb-5">
                            <div class="row d-flex justify-content-center">
                                <div class="col-md-6">
                                    <form id="Enlaces" method="POST" action="{{ url('/buscar') }}">
                                        
                                        @csrf
                            
                                        <!-- Enlace 1 -->
                                        <div class="form-outline mb-4">
                                            <textarea 
                                                value=""
                                                placeholder=""
                                                rows="8"
                                                id="Enlace1"
                                                class="form-control form-control-md"
                                                name="Enlace1"
                                                >
                                            </textarea>
                                            <label class="form-label" for="Enlace1">
                                                Enlaces
                                            </label>
                                        </div>
                                        <!-- Submit button -->
                                        <button type="submit" id="chequear" class="btn btn-primary btn-block mb-4">
                                            Chequear
                                        </button>

                                    
                                    </form>
                                
                                </div>
                            </div>
                        </section>
                        <!--// Section: Enlaces -->

                    </div>
                    <!--// Chequeador -->
                
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
