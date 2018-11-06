<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Routes</title>

    </head>
    <body>
            <div class="content">
                @foreach($runs as $run)
                    <h3>{{ $run->RunRoute->RunRte_Rte_ID . ' : ' . $run->Run_Desc }} <span>---Bus number: {{ $run->RunRoute->Route->Rte_BusNumber }}</span> </h3>
               <table>
                   <thead>
                        <th>Time</th>
                        <th>Stop</th>
                   </thead>
                   <tbody>
                        @foreach($run->RunService as $runService)
                            @if($runService->RunSrv_Dh == 0)
                            <tr>
                                <td>{{ $runService->RunSrv_TimeAtSrv->format('h:i a') }}</td>
                                <td>{{ $runService->StopService->Stop->Stop_Desc }}</td>
                            </tr>
                            @endif
                        @endforeach
                   </tbody>
               </table>
                @endforeach
            </div>
    </body>
</html>
