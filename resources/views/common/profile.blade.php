@extends('welcome')

@section('content')

    <div class="profile-card">
        <div class="profile-cover" style="background-color: rgba(0, 0, 0, 0.671);">
            <div class="menu-container">
                <a class="list-icon" title="Expand" href="javascript:void(0);"></a>
                <ul class="profile-actions" style="display: none;">
                    <li><a class="read-more" href="#">Upload your photo</a></li>
                  
                </ul>
            </div>
            <div class="profile-avatar">
                <div class="btns-container">
                    <div class="profile-links">
                    </div>
                </div>
                @if(empty($extension))
                    <a><img class="profile-img sizeimg" src="{{ url('view/'.$file)}}"></img></a>
                @else
                    <a><img class="profile-img sizeimg" src="{{ url('view/'.\Auth::user()->id.'.'.$extension)}}"></img></a>
                @endif
            </div>
            <div class="profile-details">
            </div>
        </div>
        <div class="profile-info" style="display: none;">
            <h1>Upload your photo</h1>
            <div class="info-area">
                <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" name="file" class="custom-file-input" id="inputGroupFile01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                     </div>
                    <input class="btn btn-light" type="submit" value="Upload">
                </form>
            </div>
            <div class="clear"></div>
        </div>
        <div class="profile-map" style="display: none;">
            <iframe width="100%" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Saveology+New+York&amp;aq=&amp;sll=37.0625,-95.677068&amp;sspn=40.052282,86.572266&amp;t=h&amp;ie=UTF8&amp;hq=Saveology&amp;hnear=New+York&amp;ll=40.552027,-74.420902&amp;spn=0.357117,0.912844&amp;iwloc=near&amp;output=embed"></iframe>
            <div class="clear"></div>
        </div>
        <div class="profile-content">
            <ul>
                <li>
                    <div class="digits">Name:</div>
                    {{\Auth::user()->name}}
                </li>
                <li>
                    <div class="digits">Role:</div>
                    {{\Auth::user()->type}}
                </li>
                <li>
                    <div class="digits">Email</div>
                    {{\Auth::user()->email}}
                </li>
            </ul>
            <div class="clear"></div>
        </div>
    </div>

@endsection