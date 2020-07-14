@extends('layouts.client')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div id="server_detail">{!! $html !!}</div>
        </div>
    </div>
</div>


@section('script')
<script src="{{asset('vendor/tableToJson/lib/jquery.tabletojson.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {

        let  Users = [];
        moment.locale("BG");
        var table = $('table').tableToJSON();
        table.forEach((item) => {
            Users.push({
                "username" :  item["потребител"],
                "name" : item["имена"],
                "address" : item["адрес"],
                "comment" : item["коментар"],
                "phone" : item["телефон"],
                "password" : item["парола"],
                "location" : item["местонахождение"],
                "payment" : item["платено до"],
            })
        });



        let styles = Array.from(document.querySelectorAll("body style"));
        styles.map(item => item.remove());
    });
</script>
@endsection
@endsection
