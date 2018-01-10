@php($snippets = $command->getVkSnippets())

@if($snippets)

    <div class="row">
        <div class="col-xs-12">
            <hr>
            <h4>{{ trans('snippets.snippets') }}:</h4>
        </div>
    </div>

    @foreach($snippets as $snippet)
        <div class="row">
            <div class="col-xs-12 col-sm-2"><code>*{{ $snippet }}*</code></div>
            <div class="col-xs-12 col-sm-10">{{ trans("snippets.{$snippet}") }}</div>
        </div>
    @endforeach


@endif