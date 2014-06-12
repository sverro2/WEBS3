{{-- Load in twitter bootstrap --}}
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
{{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css') }}
{{-- HTML::style('css/bootstrap.min.css') --}}
{{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css') }}

{{-- load in jquery --}}
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js') }}
{{ HTML::script('//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js') }}

{{-- jquery datetimepicker plugin --}}
{{ HTML::style('css/jquery.datetimepicker.css') }}
{{ HTML::script('js/jquery.datetimepicker.js') }}

{{-- this jquery needs some ui, let's load it in --}}
{{ HTML::style('css/ui-lightness/jquery-ui-1.10.4.custom.min.css')}}
{{ HTML::script('js/jquery-ui-1.10.4.custom.min.js')}}

{{-- load in facebook js api --}}
{{ HTML::script('js/facebookapi.js') }}

{{-- load in background video api --}}
{{ HTML::script('js/jquery.mb.YTPlayer.js') }}

{{-- load in maps api --}}
{{ HTML::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyASxxSOwR_whPmUsMeN_kcJrCDhjzMAxy0') }}
{{ HTML::script('https://www.google.com/jsapi') }}

{{-- load in fonts --}}
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js') }}
{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans') }}

{{-- load in custom css --}}
{{ HTML::style('css/calendarstyle.css') }}
{{ HTML::style('css/mapstyle.css') }}
{{ HTML::style('css/style.css') }}

{{-- load in custom javascripts --}}
{{ HTML::script('js/ui_config.js') }}
{{ HTML::script('js/event.js') }}
{{ HTML::script('js/search.js') }}
{{ HTML::script('js/map_config.js') }}