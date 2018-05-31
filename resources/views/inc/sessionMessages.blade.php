{{--@if(session()->has("success"))--}}
    {{--<div class="alert alert-success alert-dismissible" id="customSuccess">--}}
        {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
        {{--<strong><i class="fas fa-check-circle"></i> Success ! </strong> {{ session("success") }}--}}
    {{--</div>--}}
{{--@elseif(session()->has("info"))--}}
    {{--<div class="alert alert-info alert-dismissible" id="customInfo">--}}
        {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
        {{--<strong><i class="fas fa-info-circle"></i> Info ! </strong> {{ session("info") }}--}}
    {{--</div>--}}
{{--@elseif(session()->has("error"))--}}
    {{--<div class="alert alert-danger alert-dismissible" id="customError">--}}
        {{--<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>--}}
        {{--<strong><i class="fas fa-exclamation-triangle"></i> Error ! </strong> {{ session("error") }}--}}
    {{--</div>--}}
{{--@endif--}}


{{-- For AJAX request use this template --}}
<div class="alert alert-success alert-dismissible" id="customSuccess" style="display: none">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong><i class="fas fa-check-circle"></i> Success ! </strong> {{ session("success") }}
</div>