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

                    <h3>Schools</h3>
               <table>
                   <thead>
                        <th>School</th>
                   </thead>
                   <tbody>
                        @foreach($schools as $school)
                            <tr>
                                <td><a href="/runs/{{ $school->Sch_Code }}"> {{ $school->Sch_Name }}</a></td>
                            </tr>
                        @endforeach
                   </tbody>
               </table>
            </div>
    </body>
</html>
