@extends('welcome')

@section('content')

    <form
      class="all"
      method="POST"
      action="{{ url('storePresentation') }}"
      enctype="multipart/form-data"
    >
      @csrf
    
      <div class="form-group column">
        <label for="name" class="col-md-6 col-form-label"
          >{{ __('Tittle') }}</label
        >
    
        <div class="col-md-6">
          <input
            id="tittle"
            type="text"
            class="form-control @error('tittle') is-invalid @enderror"
            name="tittle"
            value="{{ old('tittle') }}"
            required
            autocomplete="name"
            autofocus
          />
    
          @error('tittle')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      <div class="imageblah">
        <img id="blah" src="#" alt="your image" />
      </div>
      <div class="form-group row drag">
        <label
          for="custom"
          class="miniature col-md-4 col-form-label text-md-right"
          >{{ __('Miniature') }}</label
        >
    
        <input
          type="file"
          name="file"
          id="form-input_file"
          class="form-input_file hide"
        />
        <div id="drop-zone" class="drop-zone">
          <svg
            version="1.1"
            id="icono-upload"
            class="icono-upload"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            x="0px"
            y="0px"
            viewBox="0 0 357.576 357.576"
            style="enable-background: new 0 0 357.576 357.576;"
            xml:space="preserve"
          >
            <path
              d="M300.807,88.652l-94.111-77.447C198.805,4.712,185.562,0,175.206,0h-108.5C53.471,0,42.703,10.602,42.703,23.636
                c0.002,3.121,0.167,312.155,0.167,313.775c0,11.805,8.258,20.05,20.082,20.05c7.5,0,228.892,0.115,228.892,0.115
                c12.914,0,23.029-10.502,23.029-23.909V119.673C314.873,108.403,308.957,95.356,300.807,88.652z M175.206,1c0.003,0,0.007,0,0.01,0
                C175.212,1,175.209,1,175.206,1L175.206,1z M240.622,229.454c-1.19,2.289-3.653,3.546-6.587,3.546h-32.162v76.729
                c0,4.963-3.887,9.271-8.85,9.271h-27.622c-4.963,0-8.528-4.308-8.528-9.271V233h-32.477c-2.933,0-5.395-1.255-6.586-3.543
                c-1.19-2.288-0.897-5.033,0.785-7.435l54.232-77.378c1.551-2.213,3.88-3.469,6.39-3.469c2.512,0,4.841,1.277,6.391,3.49
                l54.227,77.349C241.519,224.417,241.813,227.166,240.622,229.454z M204.833,113.959c0.462,0.025,0.934,0.041,1.424,0.041h0
                C205.769,114,205.294,113.986,204.833,113.959z M206.257,113c-15.924,0-16.384-14.751-16.384-16.433V30.96L293.844,113H206.257z"
            />
          </svg>
          <p class="drop-zone-text">Drag your files or click to upload files</p>
        </div>
      </div>
    
      <div class="form-group column">
        <label for="video" class="col-md-6 col-form-label"
          >{{ __('Video url') }}</label
        >
    
        <div class="col-md-6">
          <input
            id="video"
            type="text"
            class="form-control @error('video') is-invalid @enderror"
            name="video"
            value="{{ old('video') }}"
            required
            autocomplete="name"
            autofocus
          />
    
          @error('video')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
      </div>
      
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
      </div>
      
      <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
          <button type="submit" class="btn btn-primary cssss">
            {{ __('Create presentation') }}
          </button>
        </div>
      </div>
    </form>

@endsection