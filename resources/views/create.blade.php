@extends('layouts/simple') {{-- Load the simple layout --}}
@section('body')
<div class="footer-lockup">

    <form id="form-event" enctype="multipart/form-data" class="col-md-18 col-md-offset-1" data-wait-message="{{$wait_message}}">

        <div class="form-group">
            <input id="name" name="name" maxlength="50" class="form-control" type="text" placeholder="{{$event_your_name}}" />
        </div>

        <div class="form-group">
            <input id="email" name="email" maxlength="70" class="form-control" type="email" placeholder="{{$event_your_email}}" spellcheck="false" />
        </div>

        <div class="form-group">
            <input id="event" name="event" maxlength="50" class="form-control" type="text" placeholder="{{$event_name}}" />
        </div>        

        <div>
            <select id="type" name="type" class="form-control">
                @foreach($types as $type)
                    @if ( $lang == 'es')
                        <option value="{{$type->get_id()}}">{{$type->get_nameES()}}</option>
                    @else if ( $lang == 'eu')
                        <option value="{{$type->get_id()}}">{{$type->get_nameEU()}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div>
            <textarea id="description" name="description" maxlength="255" class="form-control"  style="margin-top: 10px;" rows="5" placeholder="{{$event_description}}" spellcheck="true"></textarea>
        </div>
        
        <div class="form-group">
            <input id="lat" name="lat" type="hidden" value="0" />
            <input id="lng" name="lng" type="hidden" value="0" />
            <div id="map" data-start-lat="{{$app_start_position_lat}}" data-start-lng="{{$app_start_position_lng}}"></div>
        </div>

        <div>
            <span class="g-recaptcha" data-sitekey="6LckLV4UAAAAAHHMtft95pF8pfRg8rzKRIBs8daL" data-callback="enableSubmit" style="width: 100%;"></span>        
       </div>

        <div class="text-right">
            <label for="file">
                <img id="image" src="" alt="" />
                <input id="file" name="file" type="file" style="display: none;" data-format-error="{{$image_format_error}}" data-size-error="{{$image_size_error}}" />
                <button id="btn-attach-image" class="newsletter-btn attachment-btn" type="button" value="{{$attach_image}}">{{$attach_image}}<i class="icon-suitcase"></i></button>  
            </label>
            <button class="newsletter-btn" disabled type="submit" title="{{$app_complete_recaptcha}}" value="{{$event_send}}">{{$event_send}}<i class="icon-chevron-circle-right"></i></button>
        </div>

    </form>

    <form id="success-message" action="{{$app_home_url}}">

        <div class="col-md-20 text-center">
            <div>{{$event_message_success_first}}</div>
            <div>{{$event_message_success_second}}</div>
            <div>{{$event_message_success_third}}</div>           
        </div>    

        <div class="col-md-20 text-right">
            <button class="newsletter-btn" type="submit" value="{{$button_continue}}">{{$button_continue}}<i class="icon-chevron-circle-right"></i></button>
        </div>

    </form>        

</div>
@stop
@section('scripts')
<script src="resources/js/create.js"></script>
<script src="resources/vendor/holdon/HoldOn.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key={{$app_google_maps_key}}"></script>
<script src="https://www.google.com/recaptcha/api.js?hl={{$lang}}"></script>
@stop