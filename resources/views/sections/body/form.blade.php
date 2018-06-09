<div class="footer-lockup">

    <form id="form-event" class="col-md-18 col-md-offset-1">

        <div class="form-group">
            <input id="name" name="name" class="form-control" type="text" placeholder="{{$event_your_name}}" />
        </div>

        <div class="form-group">
            <input id="email" name="email" class="form-control" type="email" placeholder="{{$event_your_email}}" spellcheck="false" />
        </div>

        <div class="form-group">
            <input id="event" name="event" class="form-control" type="text" placeholder="{{$event_name}}" />
        </div>        

        <div>
            <select id="type" name="type" class="form-control">
                @foreach($types as $type)
                    @if ( $lang == 'es' )
                        <option value="{{$type->get_id()}}">{{$type->get_nameES()}}</option>
                    @else
                         <option value="{{$type->get_id()}}">{{$type->get_nameEU()}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div>
            <textarea id="description" name="description" class="form-control"  style="margin-top: 10px;" rows="5" placeholder="{{$event_description}}" spellcheck="true"></textarea>
        </div>
        
        <div class="form-group">
            <input id="lat" name="lat" type="hidden" value="0" />
            <input id="lng" name="lng" type="hidden" value="0" />
            <div id="map" data-start-lat="{{$app_start_position_lat}}" data-start-lng="{{$app_start_position_lng}}"></div>
        </div>

        <div class="text-right">
            <button class="newsletter-btn" type="submit" value="{{$event_send}}">{{$event_send}}<i class="icon-chevron-circle-right"></i></button>
        </div>

    </form>

    <form id="success-message" action="index.php#">

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