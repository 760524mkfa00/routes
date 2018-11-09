<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Routes</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>

        </style>

    </head>
    <body>
        <div class="container-fluid">
            <div class="content">
                <div class="row">
                    @foreach($runs as $run)
                        <div class="col-md-6" style="padding-top:20px;">
                            <hr />
                            <h6>{{ $run->Run_Desc }} <span class="float-md-right">Route: {{ $run->Rte_ID }} Bus: {{ $run->Rte_BusNumber }}</span> </h6>
                            <hr />
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                <th>Time</th>
                                <th>Stop</th>
                                </thead>
                                <tbody>

                                {{--                    {{ dd($run) }}--}}
                                @foreach($run->Stops as $runService)

                                    {{--                            {{ dd($runService) }}--}}

                                    @if($runService->RunSrv_Dh == 0)
                                        <tr>
                                            {{--                                <td>{{ date('h:i a', strtotime($runService->RunSrv_TimeAtSrv)) }}</td>--}}
                                            <td>{{ $runService->DispTimeAtStop }}</td>
                                            <td>{{ $runService->Stop_Desc }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </body>
</html>
