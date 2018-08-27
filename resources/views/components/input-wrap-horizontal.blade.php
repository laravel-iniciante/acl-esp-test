<div class="row form-group">
    <div class="col col-md-3">
        <label for="text-input" class=" form-control-label">{{$label}}</label>
    </div>
    <div class="col-12 col-md-9">
        {{$slot}}
		@if (isset($help))
		    <small>	{{$help}} </small>
		@endif
    </div>
</div>