@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        <div class="alert
                    alert-{{ $message['level'] }}
                    {{ $message['important'] ? 'alert-important' : '' }}"
                    role="alert"
        >
            @if ($message['important'])
                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-hidden="true"
                >&times;</button>
            @endif

            {!! $message['message'] !!}
        </div>
    @endif
@endforeach

@if (isset($errors) and count($errors) > 0)
    @foreach ($errors->all() as $error)
        <div style="font-size: 15px;" class="alert flash alert-danger">
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-hidden="true">&times;</button>

            {!! $error !!}
        </div>
    @endforeach
@endif


{{ session()->forget('flash_notification') }}
