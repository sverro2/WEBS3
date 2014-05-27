
<script>
$(function() {
	var ruleTags = [
		@foreach($rules as $rule)
			"{{$rule->rule}}",
		@endforeach
	];
	$(".rulecomplete").autocomplete({
	  source: ruleTags,
	  messages:{
	  	noResults: '',
	  	results: function(){}
	  }
	});
	var valueTags = [
		@foreach($rules as $rule)
			"{{$rule->value}}",
		@endforeach
	];
	$(".valuecomplete").autocomplete({
	  source: valueTags,
	  messages:{
	  	noResults: '',
	  	results: function(){}
	  }
	});

  });
</script>