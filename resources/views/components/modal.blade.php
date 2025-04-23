<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">{{$title}}</h4>
            </div>
            <form action="{{$route}}" method="POST">

                <div class="modal-body">
                    {{ csrf_field() }}

                    {{$slot}}

                </div>
                <div class="modal-footer">
                    {{--<button type="submit" class="btn btn-link waves-effect">Create</button>--}}
                    <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                    {{--<button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>--}}
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>

            </form>
        </div>
    </div>
</div>
