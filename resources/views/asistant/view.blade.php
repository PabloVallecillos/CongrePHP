@extends('welcome')

@section('content')

    <div id="player"> </div>
    <div class="button">
       <form method="post" action="{{ url('pdf2',$presentation->id) }}" class="form2">
            {{csrf_field()}}
                  <button id="video" class="form-control video" type="submit"> Submit PDF</button> 
       </form>
    </div>
     <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');
    
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    
      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '360',
          width: '640',
          videoId: '{{$presentation->video}}',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }
    
      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        // event.target.playVideo();
      }
    
      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if ( event.data == YT.PlayerState.ENDED){
            document.getElementById("video").classList.remove('video');
            document.getElementById("video").classList.add('video2');
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>

@endsection