@extends('layouts.app')

@section('styles')


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
crossorigin=""/>

<link
rel="stylesheet"
href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
/>
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endsection

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Registrar Establecimiento</h1>    
        <div class="mt-5 row justify-content-center">
            <form class="col-md-9 col-xs-12 card card-body"action="">


            <fieldset class="border p-4"> {{-- Grupo de campos cada campo tiene que estar en su propio ddiv --}}
                <legend class="text-primary">Nombre , Categoria y Imagen principal</legend>

                <div class="form-group">
                    <label for="nombre">Nombre Establecimiento</label>
                <input 
                    id="nombre" 
                    type="text" 
                    class="form-control @error('name') is-invalid  @enderror" 
                    placeholder="Nombre Establecimiento" 
                    name="nombre" 
                    value="{{ old('nombre')}}"              
                    >

                    @error('nombre')
                        
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria">Categoria</label>

                    <select class="form-control  @error('categoria_id') is-invalid  @enderror" name="categoria_id"  id="categoria">
                        <option value="" selected disabled>--Seleccione --</option>

                        @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}"
                            {{old('categoria_id') == $categoria->id ? 'selected' : '' }}
                        >{{ $categoria->nombre}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="imagen_principal">Imagen Principal</label>
                <input 
                    id="imagen_principal" 
                    type="file" 
                    class="form-control @error('imagen_principal') is-invalid  @enderror" 
                    placeholder="Nombre Establecimiento" 
                    name="imagen_principal" 
                    value="{{ old('imagen_principal')}}"              
                    >

                    @error('imagen_principal')
                        
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>


               {{--  <fieldset class="border p-4"> {{-- Grupo de campos cada campo tiene que estar en su propio ddiv --}} 
                    <legend class="text-primary">Ubicacion</legend>
    
                    <div class="form-group">
                        <label for="formbuscador">Coloca la direccion de tu establecimiento</label>
                    <input 
                        id="formbuscador" 
                        type="text" 
                        class="form-control"
                        {{-- class="form-control @error('name') is-invalid  @enderror"  --}}
                        placeholder="Calle de Negocio o Establecimiento" 
                                     
                        >
                        <p class="text-secondary mt-5 mb-3 text-center">El asistente colocará una ubicacion estimada , Mueve el Pin hacia el lugar correcto </p>
    
                        
                    </div>

                    <div class="form-group">
                        <div id="mapa" style="height: 400px;"></div>
                    </div>
                    
                    <p class="informacion">Confirmar que los siguientes campos son correctos</p>
                {{-- </fieldset> --}}
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input 
                            type="text" 
                            id="direccion" 
                            class="form-control @error('direccion') is-invalid @enderror" 
                            placeholder="Dirección"   
                            value="{{ old('direccion')}}"      
                        >

                        @error('direccion')
                        
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>

                {{--     <div class="form-group">
                        <label for="colonia">Dirección</label>
                        <input 
                            type="text" 
                            id="colonia" 
                            class="form-control @error('colonia') is-invalid @enderror" 
                            placeholder="Colonia"   
                            value="{{ old('colonia')}}""      
                        >

                        @error('colonia')
                        
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div> --}}

                <input type="hidden" id="lat" name="lat" value="{{old('lat')}}">
                <input type="hidden" id="lng" name="lng" value="{{old('lng')}}">
              
                
            </fieldset>
            </form>

        </div>

       
        
    </div>



@endsection

@section('scripts')


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
crossorigin=""></script>
<script src="https://unpkg.com/esri-leaflet"></script>
<script src="https://unpkg.com/esri-leaflet-geocoder" defer></script>

{{-- con la utilizacion de webpacks y archivos separados la carga del mapa se crea en archivo distintos  --}}
{{--   <script>
/*    document.addEventListener('DOMContentLoaded', () => {

    const lat = -35.416508;
    const lng = -71.653391;

    const mapa = L.map('mapa').setView([lat, lng], 17);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mapa);

    let marker;

    // agregar el pin
    marker = new L.marker([lat, lng]).addTo(mapa);

}); */
  </script> --}}
@endsection